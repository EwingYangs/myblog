<?php
class LinkC extends CI_Controller{
	public function add(){
		//**********表单的验证**************
		//加载表单验证类
		$this->load->library('form_validation');
		//设置表单验证规则
		$this->form_validation->set_rules('link_name', '连接名称', 'required');		//表单验证错误就显示页面
		$this->form_validation->set_rules('link_url', '连接名称', 'required');	
		if($this->form_validation->run() === false){
			$this->load->view('admin/LinkC/add');
		}else{
			//表单验证成功就生成模型，数据入库，成功后跳转到列表页
			$this->load->model('LinkM');
			$this->LinkM->add();
			redirect(site_url('admin/LinkC/lst'));
		}
	}
	public function lst(){
		//获取数据显示列表
		$this->load->model('LinkM');
		$data = $this->LinkM->search();
		$this->load->view('admin/LinkC/lst',$data);
	}


	public function delete($id){
		$this->load->model('LinkM');
		$this->LinkM->delete($id);
		redirect(site_url('admin/LinkC/lst'));
	}


	public function save($id){
		//**********表单的验证**************
		$this->load->model('LinkM');
		$data = $this->LinkM->find($id);
		//加载表单验证类
		$this->load->library('form_validation');
		//设置表单验证规则
		$this->form_validation->set_rules('link_name', '连接名称', 'required');		//表单验证错误就显示页面
		if($this->form_validation->run() === false){
			$this->load->view('admin/LinkC/save',$data);
		}else{
			//表单验证成功就生成模型，修改数据库，成功后跳转到列表页
			$this->LinkM->save($id);
			redirect(site_url('admin/LinkC/lst'));
		}
	}
}