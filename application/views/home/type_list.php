<?php $this->load->view('home/top');?>
<link href="<?=__PUBLIC__?>home/css/learn.css" rel="stylesheet">

<article class="blogs">
<h1 class="t_nav"><span>我们长路漫漫，只因学无止境。 </span><a href="/" class="n1">网站首页</a><a href="/" class="n2"><?=$type_name;?></a></h1>

<div class="newblog left">
    <?php foreach($type_blogs['data'] as $k=>$v){?>
   <h2><?=$v['title']?></h2>
   <p class="dateview">&nbsp;<span>发布时间：<?=$v['addtime']?></span><span>作者：<?=$v['author']?></span><span>分类：[<a href="<?=site_url('indexC/type_list/'.$v['type_id'])?>"><?=$type_name?></a>]</span></p>
    <figure><img src="<?=__BLOG__.$v['mid_logo']?>"></figure>
    <ul class="nlist">
      <p><?=mb_substr(preg_replace( "@<(.*?)>@is", "", $v['content'] ), 0,200,'UTF-8').'.........'?></p>
      <a title="/" href="<?=site_url('indexC/blog/'.$v['id'])?>" target="_blank" class="readmore">详细信息>></a>
    </ul>
    <div class="line"></div>
    <?php }?>
    <div class="blank"></div>
    <div class="ad">  
    <img src="<?=__PUBLIC__?>home/images/ad.png">
    </div>
    <div class="list-page"><?=$type_blogs['page']?></div>

</div>
<aside class="right">
   <div class="rnav">
      <h2>栏目导航</h2>
      <ul>
       <li><a href="http://www.internetke.com/effects/css3/" target="_blank">CSS3|Html5</a></li>
       <li><a href="http://www.cnblogs.com/superdo/p/4808189.html" target="_blank">推荐工具</a></li>
       <li><a href="https://github.com/" target="_blank">Github</a></li>
       <li><a href="http://ip.chinaz.com/" target="_blank">IP查询</a></li>
<li><a href="http://js.alixixi.com/c/example_1.shtml" target="_blank">JS经典实例</a></li>
<li><a href="http://sc.chinaz.com/moban/" target="_blank">网站模板</a></li>
     </ul>      
    </div>
<div class="news">
<?php $this->load->view('home/box');?>
    </div>
    <div class="visitors">
      <h3><p>最近访客</p></h3>
      <ul>

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
</aside>
</article>

<footer>
  <p>Design by DanceSmile <a href="http://www.mycodes.net/" title="源码之家" target="_blank">源码之家</a> <a href="/">网站统计</a></p>
</footer>
<script src="js/silder.js"></script>
</body>
</html>
<style>
  
.list-page{padding:20px 0;text-align:center;}
.list-page a{margin:0 5px;padding:2px 7px;border:1px solid #ccc;background:#f3f3f3;color:blue;}
.list-page a:hover{background:#e4e4e4;border:1px solid #908f8f;}
.list-page .current{margin:0 5px;padding:2px 7px;background:#f60;border:1px solid #fe8101;color:#fff;}
</style>