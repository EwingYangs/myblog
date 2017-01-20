<?php
class LinkM extends MY_Model{
	protected $table_name = 'b39_link';

	protected $_insertFields = array('link_url','link_name');
	protected $_updateFields = array('link_url','link_name');

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

		$link_url = $this->input->get("link_url");
		if($link_url){
		$this->db->where("link_url",$link_url); 
		}
		$link_name = $this->input->get("link_name");
		if($link_name){
		$this->db->where("link_name",$link_name); 
		}		
		
		//**************排序********************
		//默认是id排序
		$this->db->order_by('id','desc');
		//**************翻页********************		
		//计算总行数
		$count = $this->db->count_all_results('',false);//false表示计算行数的时候不清除where条件
		$this->load->library('pagination');
		//配置分页信息
		$config['base_url'] = site_url('admin/LinkC/lst');
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
	//获取全部连接
	public function getLink(){
		$data = $this->db->get($this->table_name);
		$data = $data->result('array');
		return $data;
	}
}