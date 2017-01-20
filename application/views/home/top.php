<!doctype html>
<html>
<head>
<meta charset="gb2312">
<title>杨嘉颖个人博客</title>
<meta name="keywords" content="杨嘉颖个人博客" />
<meta name="description" content="杨嘉颖个人博客，php,mysql,linux" />
<link href="<?=__PUBLIC__?>home/css/base.css" rel="stylesheet">
<link href="<?=__PUBLIC__?>home/css/index.css" rel="stylesheet">
<!--[if lt IE 9]>
<script src="js/modernizr.js"></script>
<![endif]-->
</head>
<body>
<header>
  <div id="logo"><a href="/"></a></div>
  <nav class="topnav" id="topnav"><a href="<?=__BLOG__?>"><span>首页</span>
  	<span class="en">Protal</span></a>
	<?php foreach($type['data'] as $k=>$v){
		if($k<6){
	?>
  	<a href="<?=site_url('indexC/type_list/'.$v->id.'/page')?>" 
  		<?php if(isset($type_id)){
  			if($type_id == $v->id){
  				echo 'style="color:#cc0000"';
  			}
  		}
  	?>}?><span><?=$v->type_name?></span><span class="en"><?=$v->egl_name?></span></a>
  	<?php }}?>

  </nav>
</header>