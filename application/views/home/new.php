<?php $this->load->view('home/top');?>
<link href="<?=__PUBLIC__?>home/css/new.css" rel="stylesheet">
<article class="blogs">
  <h1 class="t_nav"><span>您当前的位置：<a href="<?=__BLOG__?>">首页</a>&nbsp;&gt;&nbsp;<a href="/news/s/"><?=$type_name?></a>&nbsp;&gt;&nbsp;<a href="/news/s/">博客</a></span><a href="/" class="n1">网站首页</a><a href="/" class="n2">博客</a></h1>
  <div class="index_about">
    <h2 class="c_titile"><?=$info->title?></h2>
    <p class="box_c"><span class="d_time">发布时间：<?=$info->addtime?></span><span>编辑：<?=$info->author?></span><span>互动QQ群：<a href="http://wp.qq.com/wpa/qunwpa?idkey=d4d4a26952d46d564ee5bf7782743a70d5a8c405f4f9a33a60b0eec380743c64">280998807</a></span></p>
    <ul class="infos">
      <?=$info->content?>
    </ul>
    <!--PC版-->
<div id="SOHUCS" sid="请将此处替换为配置SourceID的语句"></div>
<script charset="utf-8" type="text/javascript" src="http://changyan.sohu.com/upload/changyan.js" ></script>
<script type="text/javascript">
window.changyan.api.config({
appid: 'cysK0c34e',
conf: 'prod_efe78aec32ddee841744ed357132c220'
});
</script>
    <div class="keybq">
    <p><span>关键字词</span>：<?php echo implode(',',getKeywords($info->title,$info->content));
     ;?></p>
    
    </div>
    <div class="ad"> </div>
    <div class="nextinfo">
      <?php if(!empty($prev_title)){?>
      <p>上一篇：<a href="<?=site_url('indexC/blog/'.$prev_title[0]['id']);?>"><?=$prev_title[0]['title']?></a></p>
      <?php }?>
      <?php if(!empty($next_title)){?>
      <p>下一篇：<a href="<?=site_url('indexC/blog/'.$next_title[0]['id']);?>"><?=$next_title[0]['title']?></a></p>
      <?php }?>
    </div>
    <div class="otherlink">
      <h2>相关文章</h2>
      <ul>
        <?php foreach($type_blogs as $k=>$v){?>
        <li><a href="<?=site_url('indexC/blog/'.$v['id']);?>" title="<?=$v['title']?>"><?=$v['title']?></a></li>
        <?php }?>
      </ul>
    </div>
  </div>
  <aside class="right">
    <!-- Baidu Button BEGIN -->
    <div id="bdshare" class="bdshare_t bds_tools_32 get-codes-bdshare"><a class="bds_tsina"></a><a class="bds_qzone"></a><a class="bds_tqq"></a><a class="bds_renren"></a><span class="bds_more"></span><a class="shareCount"></a></div>
    <script type="text/javascript" id="bdshare_js" data="type=tools&amp;uid=6574585" ></script> 
    <script type="text/javascript" id="bdshell_js"></script> 
    <script type="text/javascript">
document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000)
</script> 
    <!-- Baidu Button END -->
    <div class="blank"></div>
    <div class="news">
      <?php $this->load->view('home/box');?>
    </div>
    <div class="visitors">
      <h3>
        <p>最近访客</p>
      </h3>
      <ul>
      </ul>
    </div>
  </aside>
</article>
<footer>
  <p>Design by DanceSmile <a href="http://www.mycodes.net/" title="源码之家" target="_blank">源码之家</a> <a href="/">网站统计</a></p>
</footer>
<script src="<?=__PUBLIC__?>home/js/silder.js"></script>
</body>
</html>