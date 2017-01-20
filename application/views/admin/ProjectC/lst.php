<?php $this->load->view('admin/top');?><div class="container clearfix">
    
        <?php $this->load->view('admin/menu');?>    <div class="main-wrap">

        <div class="crumb-wrap">
            <div class="crumb-list"><i class="icon-font"></i><a href="<?=site_url('admin')?>">首页</a><span class="crumb-step">&gt;</span><span class="crumb-name">作品管理</span></div>
        </div>
        <div class="search-wrap">
            <div class="search-content">
                <form action="<?=site_url('admin/ProjectC/lst')?>" method="get" id="form">
                    <table class="search-tab">
                        <tr>
                            <!--<th width="120">选择分类:</th>
                            <td>
                                <select name="search-sort" id="">
                                    <option value="">全部</option>
                                    <option value="19">精品界面</option><option value="20">推荐界面</option>
                                </select>
                            </td>
                            -->
                                                             <th width="80">项目名称:</th>
                                 <td><input class="common-text" placeholder="请输入项目名称" name="project_name" value="<?=$this->input->get('project_name')?>" id="" type="text"></td>
                                                            
                                                        <td><input class="btn btn-primary btn2" name="sub" value="查询" type="submit"></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
        <div class="result-wrap">
            <form name="myform" id="myform" method="post">
                <div class="result-title">
                    <div class="result-list">
                        <a href="<?=site_url('admin/ProjectC/add')?>"><i class="icon-font"></i>新增项目</a>
                    </div>
                </div>
                <div class="result-content">
                    <table class="result-tab" width="100%">
                        <tr>
                            <th class="tc" width="5%"><input class="allChoose" name="" type="checkbox"></th>
                            <th>编号</th>
                            <th>ID</th><th>项目名称</th><th>项目连接</th>                            <th>操作</th>
                        </tr>
                        <?php 
                        foreach($data as $k=>$v){?>                        <tr>
                            <td class="tc"><input name="id[]" value="<?=$v->id?>" type="checkbox"></td>
                            <td>
                                <input name="ids[]" value="<?=$v->id?>" type="hidden">
                                <?=$k+1?>                            </td>
                                                        <td><?=$v->id?></td>
                                                        <td><?=$v->project_name?></td>
                                                        <td><?=$v->project_url?></td>
                                                        <td>
                                <a class="link-update"  href="<?=site_url('admin/ProjectC/save').'/'.$v->id?>">修改</a>
                                <a class="link-del" onclick="return confirm('你确定要删除吗？')" href="<?=site_url('admin/ProjectC/delete').'/'.$v->id?>">删除</a>
                            </td>
                        </tr>
                        <?php }?>                        
                    </table>
                    <div class="list-page"><?=$page;?></div>
                </div>
            </form>
        </div>
    </div>
    <!--/main-->
</div>
</body>
</html>