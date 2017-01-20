<?php
class ProjectC extends CI_Controller{
	public function add(){
		//**********表单的验证**************
		//加载表单验证类
		$this->load->library('form_validation');
		//设置表单验证规则
		$this->form_validation->set_rules('project_name', '项目名字', 'required');
		$this->form_validation->set_rules('project_url', '项目连接', 'required');		//表单验证错误就显示页面
		if($this->form_validation->run() === false){
			$this->load->view('admin/ProjectC/add');
		}else{
			//表单验证成功就生成模型，数据入库，成功后跳转到列表页
			$this->load->model('ProjectM');
			$this->ProjectM->add();
			redirect(site_url('admin/ProjectC/lst'));
		}
	}
	public function lst(){
		//获取数据显示列表
		$this->load->model('ProjectM');
		$data = $this->ProjectM->search();
		$this->load->view('admin/ProjectC/lst',$data);
	}


	public function delete($id){
		$this->load->model('ProjectM');
		$this->ProjectM->delete($id);
		redirect(site_url('admin/ProjectC/lst'));
	}


	public function save($id){
		//**********表单的验证**************
		$this->load->model('ProjectM');
		$data = $this->ProjectM->find($id);
		//加载表单验证类
		$this->load->library('form_validation');
		//设置表单验证规则
		$this->form_validation->set_rules('project_name', '项目名字', 'required');
		$this->form_validation->set_rules('project_url', '项目连接', 'required');	//表单验证错误就显示页面
		if($this->form_validation->run() === false){
			$this->load->view('admin/ProjectC/save',$data);
		}else{
			//表单验证成功就生成模型，修改数据库，成功后跳转到列表页
			$this->ProjectM->save($id);
			redirect(site_url('admin/ProjectC/lst'));
		}
	}
}