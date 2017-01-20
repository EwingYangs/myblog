<?php
class MY_Model extends CI_Model{

	//定义三个属性
	protected $table_name;
	protected $_insertFields;
	protected $_updateFields;



	public function delete($id){
		//删除前的钩子函数
		if(method_exists($this, '_before_delete')){
			if($this->_before_delete($id) === false){
				return false;
			}
		}
		$this->db->where('id', $id);
		$this->db->delete($this->table_name);
	}

	public function add(){
		//接收表单
		$data = array();
		//循环放进data里面
		foreach($this->_insertFields as $k=>$v){
			$data[$v] = $this->input->post($v,true);
		}
		//添加前钩子函数
		if(method_exists($this,'_before_insert')){
			if($this->_before_insert($data) === false){
					return false;
			}
		}
		$res = $this->db->insert($this->table_name,$data);
		//返回id
		$data['id'] = $this->db->insert_id();

		//添加后钩子函数
		if(method_exists($this,'_after_insert')){
			$this->_after_insert($data);
		}
		return $data['id'];
	}


	public function find($id){
		$this->db->where('id', $id);
		$data = $this->db->get($this->table_name);
		//转换为数组
		$data = $data->result();
		return $data[0];
	}


	public function save($id){
		
		//接收表单
		$data = array();
		//循环放进data里面
		foreach($this->_updateFields as $k=>$v){
			$data[$v] = $this->input->post($v,true);
		}
		//添加前钩子函数
		if(method_exists($this,'_before_update')){
			if($this->_before_update($data,$this->input->post('id')) === false){
					return false;
			}
		}
		$this->db->where('id',$id);
		$res = $this->db->update($this->table_name,$data);
		$data['id'] = $id;
		//修改后钩子函数
		if(method_exists($this,'_after_update')){
			$this->_after_update($data);
		}
		return $res;
	}
}