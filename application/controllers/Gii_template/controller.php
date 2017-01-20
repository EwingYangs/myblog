class <?=$cName?> extends CI_Controller{
	public function add(){
		//**********表单的验证**************
		//加载表单验证类
		$this->load->library('form_validation');
		//设置表单验证规则
<?php if($rules){?>
		<?php echo implode("\r\n\t\t", $rules);?>
<?php }?>
		//表单验证错误就显示页面
		if($this->form_validation->run() === false){
			$this->load->view('admin/<?=$cName?>/add');
		}else{
			//表单验证成功就生成模型，数据入库，成功后跳转到列表页
			$this->load->model('<?=$mName?>');
			$this-><?=$mName?>->add();
			redirect(site_url('admin/<?=$cName?>/lst'));
		}
	}
	public function lst(){
		//获取数据显示列表
		$this->load->model('<?=$mName?>');
		$data = $this-><?=$mName?>->search();
		$this->load->view('admin/<?=$cName?>/lst',$data);
	}


	public function delete($id){
		$this->load->model('<?=$mName?>');
		$this-><?=$mName?>->delete($id);
		redirect(site_url('admin/<?=$cName?>/lst'));
	}


	public function save($id){
		//**********表单的验证**************
		$this->load->model('<?=$mName?>');
		$data = $this-><?=$mName?>->find($id);
		//加载表单验证类
		$this->load->library('form_validation');
		//设置表单验证规则
<?php if($rules){?>
		<?php echo implode("\r\n\t\t", $rules);?>
<?php }?>
		//表单验证错误就显示页面
		if($this->form_validation->run() === false){
			$this->load->view('admin/<?=$cName?>/save',$data);
		}else{
			//表单验证成功就生成模型，修改数据库，成功后跳转到列表页
			$this-><?=$mName?>->save($id);
			redirect(site_url('admin/<?=$cName?>/lst'));
		}
	}
}