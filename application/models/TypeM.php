<?php
class TypeM extends MY_Model{
	protected $table_name = 'b39_type';

	protected $_insertFields = array('type_name','egl_name');
	protected $_updateFields = array('type_name','egl_name');

	protected function _before_insert(&$data){
		
	}
	protected function _before_update(&$data,$id){
		
	}
	protected function _before_delete($id){

	}
	//*************搜索，排序，分页，取数据***************
	public function search($perpage=5){
		$this->db->from($this->table_name);
		//**************搜索*******************
		//标题

		/*$type_id = $this->input->get("type_id");
		if($type_id){
		$this->db->where("type_id",$type_id); 
		}
		$type_name = $this->input->get("type_name");
		if($type_name){
		$this->db->where("type_name",$type_name); 
		}*/		
		
		//**************排序********************
		//默认是id排序
		/*$this->db->order_by('id','desc');*/
		//**************翻页********************		
		//计算总行数
		/*$count = $this->db->count_all_results('',false);//false表示计算行数的时候不清除where条件
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
		$offset = (max(1,$this->pagination->cur_page)-1)*$perpage;*/
		//**************取出数据*****************
		$data = $this->db->get();
		//转换为数组
		$data = $data->result();

		//分配数据
		return array(
				'data' => $data,
			);
		
	}
}