<?php
class MY_Controller extends CI_Controller{
	protected $types;
	public function __construct()
		{
			parent::__construct();
			$this->types = $this->loadType();
			$this->new = $this->loadNew();
			$this->orders = $this->loadOrder();

		}
	private function loadType(){
		//加载全部类型
		$this->load->model('TypeM');
		$types = $this->TypeM->search();
		return $types;
	}
	private function loadNew(){
		$this->load->model('BlogM');
		$new = $this->BlogM->getNewBlog();
		return $new;
	}
	private function loadOrder(){
		$this->load->model('BlogM');
		$orders = $this->BlogM->getOrder();
		return $orders;
	}
}