<?php $this->load->view('home/top');?>
<div class="banner">
  <section class="box">
    <ul class="texts">
      <p>一个好的程序员是那种过单行线马路都要往两边看的人。</p>
      <p>工作进度上越早落后，你就会有越充足的时间赶上。</p>
      <p>如果没能一次成功，那就叫它1.0版吧。</p>
    </ul>
    <div class="avatar"><a href="#"><span>杨嘉颖</span></a> </div>
  </section>
</div>
<div class="template">
  <div class="box">
    <h3>
      <p><span>个人项目</span>展示 project</p>
    </h3>
    <ul>
      <?php foreach($project as $k=>$v){?>
      <li><a href="<?=$v['project_url']?>"  target="_blank"><img src="<?=__BLOG__.$v['project_pic_thumb']?>"></a><span><?=$v['project_name']?></span></li>
      <?php }?>
    </ul>
  </div>
</div>
<article>
  <h2 class="title_tj">
    <p>文章<span>推荐</span></p>
  </h2>
  <div class="bloglist left">
    <?php foreach($blogs as $k=>$v){
      if($k<7){
      ?>
    <h3><?=$v['title']?></h3>
    <figure><img src="<?=__BLOG__.$v['mid_logo']?>"></figure>
    <ul>
      <p><?=mb_substr(preg_replace( "@<(.*?)>@is", "", $v['content'] ), 0,200,'UTF-8').'.........'?></p>
      <a title="/" href="<?=site_url('indexC/blog/'.$v['id'])?>" target="_blank" class="readmore">阅读全文>></a>
    </ul>
    <p class="dateview"><span><?=$v['addtime']?></span><span>作者：<?=$v['author']?></span><span>程序人生：<a href="<?=site_url('indexC/type_list/'.$v['type_id'].'/page')?>">[<?=$v['type_name']?>]</a></span></p>
      <?php }}?>
  </div>
  <aside class="right">
    <div class="weather"><iframe width="250" scrolling="no" height="60" frameborder="0" allowtransparency="true" src="http://i.tianqi.com/index.php?c=code&id=12&color=%23&icon=1&py=guangzhou&num=5"></iframe></div>
    <div class="news">
      <?php $this->load->view('home/box');?>
    <h3 class="links">
      <p>友情<span>链接</span></p>
    </h3>
    <ul class="website">
      <?php foreach($link as $k=>$v){?>
      <li><a href="<?=$v['link_url']?>" target="brank"><?=$v['link_name']?></a></li>
      <?php }?>
    </ul> 
    </div>  
    <!-- Baidu Button BEGIN -->
    <div id="bdshare" class="bdshare_t bds_tools_32 get-codes-bdshare"><a class="bds_tsina"></a><a class="bds_qzone"></a><a class="bds_tqq"></a><a class="bds_renren"></a><span class="bds_more"></span><a class="shareCount"></a></div>
    <script type="text/javascript" id="bdshare_js" data="type=tools&amp;uid=6574585" ></script> 
    <script type="text/javascript" id="bdshell_js"></script> 
    <script type="text/javascript">
document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000)
</script> 
    <!-- Baidu Button END -->   
    <a href="/" class="weixin"> </a></aside>
</article>
<footer>
  <p>Design by DanceSmile <a href="http://www.mycodes.net/" title="源码之家" target="_blank">源码之家</a> <a href="/">网站统计</a></p>
</footer>
<script src="<?=__PUBLIC__?>home/js/silder.js"></script>
</body>
</html>