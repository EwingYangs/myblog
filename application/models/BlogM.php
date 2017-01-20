<?php 
class BlogM extends MY_Model{
	protected $table_name = 'b39_blog';
	protected $_insertFields = array('title','content','is_show','author','type_id','is_res');
	protected $_updateFields = array('title','content','is_show','author','type_id','is_res');
	

	protected function _before_insert(&$data){
		//过滤掉编辑器中的XSS
		$data['content'] = removeXXS($this->input->post('content'));
		//添加前添加时间
		$data['addtime'] = date('Y-m-d H:i:s');
		//修改前判断作者是否为空
		if(empty($data['author'])){
			$data['author'] = '匿名';
		}
		if($_FILES['logo']['error'] == 0){
			//处理图片，上传图片
			$config['upload_path'] = 'uploads/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['file_name'] = time().'.jpg';
			$this->load->library('upload', $config);

			// Alternately you can set preferences by calling the ``initialize()`` method. Useful if you auto-load the class:
			$this->upload->initialize($config);
			$field_name = "logo";
			if ( ! $this->upload->do_upload($field_name))
	        {
	            $error = array('error' => $this->upload->display_errors());
	            $this->error = $error['error'];
	            return false;
	        }
	        else
	        {
	            $res = array('upload_data' => $this->upload->data());
	            //放进数组$data中
	            $data['logo'] = 'uploads/'.$res['upload_data']['file_name'];
	            //**********生成缩略图**********
	            
	            $config['image_library'] = 'gd2';
				$config['source_image'] = __WEB__.$data['logo'];
				$config['create_thumb'] = TRUE;
				$config['maintain_ratio'] = TRUE;
				$config['width']     = 175;
				$config['height']   = 117;
				//生成缩略图
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();
				$data['mid_logo'] = 'uploads/'.$res['upload_data']['raw_name'].'_thumb'.$res['upload_data']['file_ext'];
	        	
	        }
		}
		
	}
	protected function _before_update(&$data,$id){
		//过滤掉编辑器中的XSS
		$data['content'] = removeXXS($this->input->post('content'));
		//修改前判断作者是否为空
		if(empty($data['author'])){
			$data['author'] = '匿名';
		}

		if($_FILES['logo']['error'] == 0){
			
			//先删除原图
			$this->db->select('logo,mid_logo');
			$file_path = $this->db->get($this->table_name,$id);
			$file_path = $file_path->result('array');
			//定义图片的地址
			$mid_path = __WEB__.$file_path[0]['mid_logo'];
			$file_path = __WEB__.$file_path[0]['logo'];
			
			unlink($file_path);//删除文件
			unlink($mid_path);//删除缩略图


			//处理图片，上传图片
			$config['upload_path'] = 'uploads/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['file_name'] = time().'.jpg';

			$this->load->library('upload', $config);

			// Alternately you can set preferences by calling the ``initialize()`` method. Useful if you auto-load the class:
			$this->upload->initialize($config);
			$field_name = "logo";
			if ( ! $this->upload->do_upload($field_name))
	        {
	            $error = array('error' => $this->upload->display_errors());
	            $this->error = $error['error'];
	            return false;
	        }
	        else
	        {
	            $res = array('upload_data' => $this->upload->data());
	            //放进数组$data中
	            $data['logo'] = 'uploads/'.$res['upload_data']['file_name'];
	            // //**********生成缩略图**********
	            
	            $config['image_library'] = 'gd2';
				$config['source_image'] = __WEB__.$data['logo'];
				$config['create_thumb'] = TRUE;
				$config['maintain_ratio'] = TRUE;
				$config['width']     = 175;
				$config['height']   = 117;
				//生成缩略图
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();
				$data['mid_logo'] = 'uploads/'.$res['upload_data']['raw_name'].'_thumb'.$res['upload_data']['file_ext'];
	        }
		}
	}

	protected function _before_delete($id){
			//删除图片
			$this->db->select('logo,mid_logo');
			$file_path = $this->db->get($this->table_name,$id);
			$file_path = $file_path->result('array');
			//定义图片的地址
			$mid_path = __WEB__.$file_path[0]['mid_logo'];
			$file_path = __WEB__.$file_path[0]['logo'];
			
			unlink($file_path);//删除文件
			unlink($mid_path);//删除缩略图
	}
	//*************搜索，排序，分页，取数据***************
	public function search($perpage=5){
		$this->db->from('b39_blog');
		//**************搜索*******************
		//标题
		$title = $this->input->get('title');
		if($title){
			$this->db->like('title',$title);
		}
		//是否显示
		$is_show = $this->input->get('is_show');
		if($is_show == '是'){
			$this->db->where('is_show','是');
		}else if($is_show == '否'){
			$this->db->where('is_show','否');
		}
		//**************排序********************
		//默认是id排序
		$this->db->order_by('id','desc');
		//**************翻页********************		
		//计算总行数
		$count = $this->db->count_all_results('',false);//false表示计算行数的时候不清除where条件
		$this->load->library('pagination');
		//配置分页信息
		$config['base_url'] = site_url('admin/BlogC/lst');
		$config['total_rows'] = $count;
		$config['per_page'] = $perpage;
		// 翻页时其他的变量继续传
		$config['reuse_query_string'] = TRUE; 
		$config['first_link'] = '首页';
		$config['last_link'] = '尾页';
		$config['next_link'] = '下一页';
		$config['prev_link'] = '上一页';

		$this->pagination->initialize($config);
		$pageList = $this->pagination->create_links();
		//计算偏移量
		$offset = (max(1,$this->pagination->cur_page)-1)*$perpage;
		//**************取出数据*****************
		$data = $this->db->get('',$perpage,$offset);
		//转换为数组
		$data = $data->result();

		//分配数据
		return array(
				'data' => $data,
				'page' => $pageList,
			);
		
	}
	//获取推荐的博客
	public function getRecBlog(){
		$this->db->select('b39_blog.*,b39_type.type_name');
		//设置条件
		$this->db->where('is_res','是');
		$this->db->join('b39_type','b39_blog.type_id = b39_type.id');
		//获取全部数据
		$data = $this->db->get($this->table_name);

		//转换为数组
		$data = $data->result('array');
		
		return $data;
	}
	//获取最新的博客(8篇)
	public function getNewBlog(){
		$this->db->select('id,title');

		$this->db->where('is_show','是');
		$this->db->order_by('id', 'DESC');
		//获取全部数据8条
		$data = $this->db->get($this->table_name,0,8);

		//转换为数组
		$data = $data->result('array');
		return $data;
	}
	//获取上一篇和下一篇的标题和id
	public function getNext($id){
		$this->db->select('id,title');
		$this->db->where('id >',$id);
		//获取两条数据
		$data = $this->db->get($this->table_name,0,1);
		//转换为数组
		$data = $data->result('array');
		return $data;
	}
	//获取上一篇和下一篇的标题和id
	public function getPrev($id){
		$this->db->select('id,title');
		$this->db->where('id <',$id);
		$this->db->order_by('id', 'DESC');
		//获取两条数据
		$data = $this->db->get($this->table_name,0,1);
		//转换为数组
		$data = $data->result('array');
		return $data;
	}

	//根据类型获取类型中的所有文章
	public function getBlogByType($type_id,$perpage=3){
		$this->db->from('b39_blog');
		$this->db->where('type_id',$type_id);
		//分页
		//计算总行数
		$count = $this->db->count_all_results('',false);//false表示计算行数的时候不清除where条件
		$this->load->library('pagination');
		//配置分页信息
		$config['base_url'] = site_url('indexC/type_list/'.$type_id.'/page');
		$config['total_rows'] = $count;
		$config['per_page'] = $perpage;
		// 翻页时其他的变量继续传
		$config['reuse_query_string'] = TRUE; 
		$config['first_link'] = '首页';
		$config['last_link'] = '尾页';
		$config['next_link'] = '下一页';
		$config['prev_link'] = '上一页';

		$this->pagination->initialize($config);
		$pageList = $this->pagination->create_links();
		//计算偏移量
		$offset = (max(1,$this->pagination->cur_page)-1)*$perpage;
		//**************取出数据*****************
		$data = $this->db->get('',$perpage,$offset);
		//转换为数组
		$data = $data->result('array');
		return array(
				'data' => $data,
				'page' => $pageList,
			);
	}

	public function getBlog($type_id){
		$this->db->where('type_id',$type_id);
		$data = $this->db->get($this->table_name);
		//转换为数组
		$data = $data->result('array');
		return $data;
	}

	//clink加1
	public function addOne($id){
		$this->db->query("update $this->table_name set click=click+1 where id=$id");
	}

	//获取点击排名
	public function getOrder(){
		$this->db->order_by('click','desc');
		$data = $this->db->get($this->table_name,0,5);
		//转换为数组
		$data = $data->result('array');
		return $data;
	}
}