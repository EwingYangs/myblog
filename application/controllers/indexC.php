<?php

class indexC extends MY_Controller{
	public function index(){
		//分配全部类型的数据
		$data['type'] = $this->types;
		//分配博客的全部推荐
		$this->load->model('BlogM');
		$blogs = $this->BlogM->getRecBlog();
		$data['blogs'] = $blogs;
		//分配最新的文章
		//$new = $this->BlogM->getNewBlog();
		$data['new'] = $this->new;
		//分配友情连接
		$this->load->model('LinkM');
		$link = $this->LinkM->getLink();
		$data['link'] = $link;
		//点击排行
		//$orders = $this->BlogM->getOrder();
		$data['order'] = $this->orders;
		//项目展示
		$this->load->model('ProjectM');
		$projects = $this->ProjectM->getProject();
		$data['project'] = $projects;
		$this->load->view('home/index',$data);

	}

	public function blog($id){

		$data['type'] = $this->types;
		//根据ID获取博客的详情
		$this->load->model('BlogM');
		$info = $this->BlogM->find($id);
		$data['info'] = $info;
		//该id的click值加1
		$this->BlogM->addOne($id);
		//获取上一篇还有下一篇的标题和id
		$next_title = $this->BlogM->getNext($id);
		$prev_title = $this->BlogM->getPrev($id);
		$data['next_title'] = $next_title;
		$data['prev_title'] = $prev_title;
		//获取类型的名称
		$this->load->model('TypeM');
		$type = $this->TypeM->find($info->type_id);
		$data['type_name'] = $type->type_name;
		//获取该类型的所有文章
		$type_blogs = $this->BlogM->getBlog($info->type_id);
		$data['type_blogs'] = $type_blogs;
		//分配最新的文章
		$data['new'] = $this->new;
		//排行
		$data['order'] = $this->orders;
		$this->load->view('home/new',$data);
	}

	public function type_list($type_id){
		$data['type'] = $this->types;
		$data['type_id'] = $type_id;
		//获取类型的名称
		$this->load->model('TypeM');
		$type = $this->TypeM->find($type_id);
		$data['type_name'] = $type->type_name;
		//获取该类型的所有文章
		$this->load->model('BlogM');
		$type_blogs = $this->BlogM->getBlogByType($type_id);
		$data['type_blogs'] = $type_blogs;
		//分配最新的文章
		$data['new'] = $this->new;
		//排行
		$data['order'] = $this->orders;
		$this->load->view('home/type_list',$data);
	}
}