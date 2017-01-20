<?php
class AdminC extends CI_Controller{
	public function add(){
		//**********表单的验证**************
		//加载表单验证类
		$this->load->library('form_validation');
		//设置表单验证规则
		$this->form_validation->set_rules('username', '用户名', 'required');
		$this->form_validation->set_rules('password', '密码', 'required');
		$this->form_validation->set_rules('tel', '电话', 'required');		//表单验证错误就显示页面
		if($this->form_validation->run() === false){
			$this->load->view('admin/AdminC/add');
		}else{
			//表单验证成功就生成模型，数据入库，成功后跳转到列表页
			$this->load->model('AdminM');
			$this->AdminM->add();
			redirect(site_url('admin/AdminC/lst'));
		}
	}
	public function lst(){
		//获取数据显示列表
		$this->load->model('AdminM');
		$data = $this->AdminM->search();
		$this->load->view('admin/AdminC/lst',$data);
	}


	public function delete($id){
		$this->load->model('AdminM');
		$this->AdminM->delete($id);
		redirect(site_url('admin/AdminC/lst'));
	}


	public function save($id){
		//**********表单的验证**************
		$this->load->model('AdminM');
		$data = $this->AdminM->find($id);
		//加载表单验证类
		$this->load->library('form_validation');
		//设置表单验证规则
		$this->form_validation->set_rules('username', '用户名', 'required');
		$this->form_validation->set_rules('password', '密码', 'required');
		$this->form_validation->set_rules('tel', '电话', 'required');		//表单验证错误就显示页面
		if($this->form_validation->run() === false){
			$this->load->view('admin/AdminC/save',$data);
		}else{
			//表单验证成功就生成模型，修改数据库，成功后跳转到列表页
			$this->AdminM->save($id);
			redirect(site_url('admin/AdminC/lst'));
		}
	}
}