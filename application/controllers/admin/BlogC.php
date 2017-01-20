<?php
class BlogC extends CI_Controller{
	public function add(){
		//**********表单的验证**************
		//加载表单验证类
		$this->load->library('form_validation');
		//设置表单验证规则
		$this->form_validation->set_rules('title', '标题', 'required|max_length[150]');
		$this->form_validation->set_rules('content', '内容', 'required');
		$this->form_validation->set_rules('type_id', '类型', 'required');
		$this->form_validation->set_rules('author', '作者', 'max_length[45]');
		//取出所有的分类，分配到添加的视图中
		$this->load->model('TypeM');
		$type = $this->TypeM->search();
		//表单验证错误就显示页面
		if($this->form_validation->run() === false){
			$data['type'] = $type;
			$this->load->view('admin/BlogC/add',$data);
		}else{
			//表单验证成功就生成模型，数据入库，成功后跳转到列表页
			$this->load->model('BlogM');
			if($this->BlogM->add() === false ){
				//获取文件上传的错误信息
				$error_info = $this->BlogM->error;
				$data['type'] = $type;
				$data['error'] = $error_info;
				$this->load->view('admin/BlogC/add',$data);
			}else{
				redirect(site_url('admin/BlogC/lst'));
			}	
		}
	}
	public function lst(){
		//获取数据显示列表
		$this->load->model('BlogM');
		$data = $this->BlogM->search();
		$this->load->view('admin/BlogC/lst',$data);
	}


	public function delete($id){
		$this->load->model('BlogM');
		$this->BlogM->delete($id);
		redirect(site_url('admin/BlogC/lst'));
	}


	public function save($id){
		//**********表单的验证**************
		$this->load->model('BlogM');
		$data = $this->BlogM->find($id);
		//加载表单验证类
		$this->load->library('form_validation');
		//设置表单验证规则
		$this->form_validation->set_rules('title', '标题', 'required|max_length[150]');
		$this->form_validation->set_rules('content', '内容', 'required');
		$this->form_validation->set_rules('type_id', '类型', 'required');
		$this->form_validation->set_rules('author', '作者', 'max_length[45]');
		//取出所有的分类，分配到添加的视图中
		$this->load->model('TypeM');
		$type = $this->TypeM->search();
		//表单验证错误就显示页面
		if($this->form_validation->run() === false){
			//分配数据
			$data->type = $type;
			$this->load->view('admin/BlogC/save',$data);
		}else{
			if($this->BlogM->save($id) === false ){
				//获取文件上传的错误信息
				$error_info = $this->BlogM->error;
				$data->type = $type;
				$data->error = $error_info;	
				$this->load->view('admin/BlogC/add',$data);
			}else{
				redirect(site_url('admin/BlogC/lst'));
			}
		}
	}
}