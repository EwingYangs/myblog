
    <h3>
      <p>最新<span>文章</span></p>
    </h3>
    <ul class="rank">
      <?php foreach($new as $k=>$v){
        if($k < 8){
        ?>
      <li>
        <a href="<?=site_url('indexC/blog/'.$v['id'])?>" title="<?=$v['title']?>" target="_blank">
          <?=$v['title']?>
        </a>
      </li>
      <?php }}?>
    </ul>
    <h3 class="ph">
      <p>点击<span>排行</span></p>
    </h3>
    <ul class="paih">
      <?php foreach($order as $k=>$v){
        if($k < 5){
        ?>
      <li><a href="<?=site_url('indexC/blog/'.$v['id'])?>" title="<?=$v['title']?>" target="_blank"><?=$v['title']?></a></li>
      <?php }}?>
    </ul>