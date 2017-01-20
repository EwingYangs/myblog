<?php $this->load->view('admin/top');?>
<div class="container clearfix">
    
        <?php $this->load->view('admin/menu');?>
    <div class="main-wrap">

        <div class="crumb-wrap">
            <div class="crumb-list"><i class="icon-font"></i><a href="/jscss/admin">首页</a><span class="crumb-step">&gt;</span><span class="crumb-name">作品管理</span></div>
        </div>
        <div class="search-wrap">
            <div class="search-content">
                <form action="<?=site_url('admin/BlogC/lst')?>" method="get" id="form">
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
                            <th width="70">标题:</th>
                            <td><input class="common-text" placeholder="请输入标题" name="title" value="<?=$this->input->get('title')?>" id="" type="text"></td>
                            <td><input class="btn btn-primary btn2" name="sub" value="查询" type="submit"></td>
                             <th width="70">是否显示:</th>
                            <td><input onclick="document.getElementById('form').submit();" name="is_show" value="" type="radio" checked="checked">全部</td>
                            <td><input onclick="document.getElementById('form').submit();" name="is_show" value="是" type="radio" <?php if($this->input->get('is_show') == '是'){echo 'checked=checked';}?>>是</td>
                            <td><input onclick="document.getElementById('form').submit();" name="is_show" value="否" type="radio" <?php if($this->input->get('is_show') == '否'){echo 'checked=checked';}?>>否</td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
        <div class="result-wrap">
            <form name="myform" id="myform" method="post">
                <div class="result-title">
                    <div class="result-list">
                        <a href="<?=site_url('admin/BlogC/add')?>"><i class="icon-font"></i>新增作品</a>

                    </div>
                </div>
                <div class="result-content">
                    <table class="result-tab" width="100%">
                        <tr>
                            <th class="tc" width="5%"><input class="allChoose" name="" type="checkbox"></th>
                            <th>编号</th>
                            <th>ID</th>
                            <th>标题</th>
                            <th>发布人</th>
                            <th>类型ID</th>
                            <th>显示</th>
                            <th>发布时间</th>
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
                            <td title="<?=$v->title?>"><a target="_blank" href="#" title="<?=$v->title?>"><?=$v->title?></a> …
                            </td>
                            <td><?=$v->author?></td>
                            <td><?=$v->type_id?></td>
                            <td><?=$v->is_show?></td>
                            <td><?=$v->addtime?></td>
                            <td>
                                <a class="link-update"  href="<?=site_url('admin/BlogC/save').'/'.$v->id?>">修改</a>
                                <a class="link-del" onclick="return confirm('你确定要删除吗？')" href="<?=site_url('admin/BlogC/delete').'/'.$v->id?>">删除</a>
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