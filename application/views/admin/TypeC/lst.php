<?php $this->load->view('admin/top');?><div class="container clearfix">
    
        <?php $this->load->view('admin/menu');?>    <div class="main-wrap">

        <div class="crumb-wrap">
            <div class="crumb-list"><i class="icon-font"></i><a href="/jscss/admin">首页</a><span class="crumb-step">&gt;</span><span class="crumb-name">作品管理</span></div>
        </div>
        <div class="search-wrap">
            
        </div>
        <div class="result-wrap">
            <form name="myform" id="myform" method="post">
                <div class="result-title">
                    <div class="result-list">
                        <a href="<?=site_url('admin/TypeC/add')?>"><i class="icon-font"></i>新增类型</a>
                    </div>
                </div>
                <div class="result-content">
                    <table class="result-tab" width="100%">
                        <tr>
                            <th class="tc" width="5%"><input class="allChoose" name="" type="checkbox"></th>
                            <th>编号</th>
                            <th>类型ID</th>
                            <th>类型名称</th> 
                            <th>英文名称</th>                           
                            <th>操作</th>
                        </tr>
                        <?php 
                        foreach($data as $k=>$v){?>                        
                        <tr>
                            <td class="tc"><input name="id[]" value="<?=$v->id?>" type="checkbox"></td>
                            <td>
                                <input name="ids[]" value="<?=$v->id?>" type="hidden">
                                <?=$k+1?>                            
                            </td>
                            <td><?=$v->id?></td>
                            <td><?=$v->type_name?></td>
                            <td><?=$v->egl_name?></td>
                            <td>
                                <a class="link-update"  href="<?=site_url('admin/TypeC/save').'/'.$v->id?>">修改</a>
                                <a class="link-del" onclick="return confirm('你确定要删除吗？')" href="<?=site_url('admin/TypeC/delete').'/'.$v->id?>">删除</a>
                            </td>
                        </tr>
                        <?php }?>                        
                    </table>
                    
                </div>
            </form>
        </div>
    </div>
    <!--/main-->
</div>
</body>
</html>