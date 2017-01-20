<?php
class ProjectM extends MY_Model{
	protected $table_name = 'b39_project';

	protected $_insertFields = array('project_name','project_url');
	protected $_updateFields = array('project_name','project_url');

	protected function _before_insert(&$data){
		if($_FILES['project_pic']['error'] == 0){
			//处理图片，上传图片
			$config['upload_path'] = 'uploads/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['file_name'] = time().'.jpg';
			$this->load->library('upload', $config);

			// Alternately you can set preferences by calling the ``initialize()`` method. Useful if you auto-load the class:
			$this->upload->initialize($config);
			$field_name = "project_pic";
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
	            $data['project_pic'] = 'uploads/'.$res['upload_data']['file_name'];
	            //**********生成缩略图**********
	            
	            $config['image_library'] = 'gd2';
				$config['source_image'] = __WEB__.$data['project_pic'];
				$config['create_thumb'] = TRUE;
				$config['maintain_ratio'] = TRUE;
				$config['width']     = 175;
				$config['height']   = 117;
				//生成缩略图
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();
				$data['project_pic_thumb'] = 'uploads/'.$res['upload_data']['raw_name'].'_thumb'.$res['upload_data']['file_ext'];
	        }
		}
	}
	protected function _before_update(&$data,$id){
		if($_FILES['project_pic']['error'] == 0){
			
			//先删除原图
			$this->db->select('project_pic,project_pic_thumb');
			$file_path = $this->db->get($this->table_name,$id);
			$file_path = $file_path->result('array');
			//定义图片的地址
			$mid_path = __WEB__.$file_path[0]['project_pic'];
			$file_path = __WEB__.$file_path[0]['project_pic_thumb'];
			
			unlink($file_path);//删除文件
			unlink($mid_path);//删除缩略图


			//处理图片，上传图片
			$config['upload_path'] = 'uploads/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['file_name'] = time().'.jpg';

			$this->load->library('upload', $config);

			// Alternately you can set preferences by calling the ``initialize()`` method. Useful if you auto-load the class:
			$this->upload->initialize($config);
			$field_name = "project_pic";
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
	            $data['project_pic'] = 'uploads/'.$res['upload_data']['file_name'];
	            // //**********生成缩略图**********
	            
	            $config['image_library'] = 'gd2';
				$config['source_image'] = __WEB__.$data['project_pic'];
				$config['create_thumb'] = TRUE;
				$config['maintain_ratio'] = TRUE;
				$config['width']     = 175;
				$config['height']   = 117;
				//生成缩略图
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();
				$data['project_pic_thumb'] = 'uploads/'.$res['upload_data']['raw_name'].'_thumb'.$res['upload_data']['file_ext'];
	        }
		}
	}
	protected function _before_delete($id){

	}
	//*************搜索，排序，分页，取数据***************
	public function search($perpage=5){
		$this->db->from($this->table_name);
		//**************搜索*******************
		//标题

		$project_name = $this->input->get("project_name");
		if($project_name){
		$this->db->where("project_name",$project_name); 
		}
		$project_pic = $this->input->get("project_pic");
		if($project_pic){
		$this->db->where("project_pic",$project_pic); 
		}
		$project_url = $this->input->get("project_url");
		if($project_url){
		$this->db->where("project_url",$project_url); 
		}		
		
		//**************排序********************
		//默认是id排序
		$this->db->order_by('id','desc');
		//**************翻页********************		
		//计算总行数
		$count = $this->db->count_all_results('',false);//false表示计算行数的时候不清除where条件
		$this->load->library('pagination');
		//配置分页信息
		$config['base_url'] = site_url('admin/ProjectC/lst');
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


	//获取6个项目
	public function  getProject(){

		$data = $this->db->get($this->table_name,0,6);
		$data = $data->result('array');
		return $data;
	}
}