<?php $this->load->view('admin/top');?>
<div class="container clearfix">
    
        <?php $this->load->view('admin/menu');?>
    <div class="main-wrap">

        <div class="crumb-wrap">
            <div class="crumb-list"><i class="icon-font"></i><a href="/jscss/admin/design/">首页</a><span class="crumb-step">&gt;</span><a class="crumb-name" href="<?=site_url('admin/BlogC/lst')?>">作品管理</a><span class="crumb-step">&gt;</span><span>新增作品</span></div>
        </div>
        <div class="result-wrap">
            <div class="result-content">
                <form action="<?=site_url('admin/BlogC/add')?>" method="post" id="myform" name="myform" enctype="multipart/form-data">
                    <table class="insert-tab" width="100%">
                        <tbody>
                         <!--   
                        <tr>
                            <th width="120"><i class="require-red">*</i>分类：</th>
                            <td>
                                <select name="colId" id="catid" class="required">
                                    <option value="">请选择</option>
                                    <option value="19">精品界面</option><option value="20">推荐界面</option>
                                </select>
                            </td>
                        </tr>
                        -->
                            <tr>
                                <th width="10%"><i class="require-red">*</i>标题：</th>
                                <td>
                                    <input class="common-text required" id="title" name="title" size="50" value="<?=set_value('title')?>" type="text">
                                    <span style="color:red"><?=form_error('title')?></span>
                                </td>
                            </tr>
                            <tr>
                                <th width="10%"><i class="require-red">*</i>类型：</th>
                                <td>

                                    <select name="type_id">

                                        <option value="">请选择...</option>
                                        <?php foreach($type['data'] as $k=>$v){?>
                                        <option value="<?=$v->id?>" <?php if(set_value('type_id') == $v->id){echo 'selected=selected';}?>><?=$v->type_name?></option>
                                        <?php }?>
                                    </select>
                                    <span style="color:red"><?=form_error('type_id')?></span>
                                </td>
                            </tr>
                            <tr>
                                <th>作者：</th>
                                <td><input class="common-text" name="author" size="50" value="admin" type="text">
                                <span style="color:gray">（如果为空就显示匿名）</span>
                                <span style="color:red"><?=form_error('author')?></span>
                                </td>
                            </tr>
                            <tr>
                                <th>文章logo：</th>
                                <td><input name="logo" id="" type="file"><span style="color:red"><?php if(isset($error)){echo $error;}?></span>
                                </td>
                            </tr>

                            <tr>
                                <th><i class="require-red">*</i>内容：</th>
                                <td><textarea name="content" class="common-textarea" id="content" cols="30" style="width: 98%;" rows="10"><?=set_value('content')?></textarea>
                                <span style="color:red"><?=form_error('content')?></span>
                                </td>
                            </tr>
                            <tr>
                                <th>是否显示：</th>
                                <td>
                                    <input  name="is_show" value="是" type="radio" checked="checked">是
                                    <input  name="is_show" value="否" type="radio">否
                                </td>
                            </tr>
                            <tr>
                                <th>是否推荐：</th>
                                <td>
                                    <input  name="is_res" value="是" type="radio" checked="checked">是
                                    <input  name="is_res" value="否" type="radio">否
                                </td>
                            </tr>
                            <tr>
                                <th></th>
                                <td>
                                    <input class="btn btn-primary btn6 mr10" value="提交" type="submit">
                                    <input class="btn btn6" onclick="history.go(-1)" value="返回" type="button">
                                </td>
                            </tr>
                             
                        </tbody></table>
                </form>
            </div>
        </div>

    </div>
    <!--/main-->
</div>
</body>
</html>

<!--导入在线编辑器 -->
<link href="<?=__PUBLIC__?>/umeditor1_2_2-utf8-php/themes/default/css/umeditor.css" type="text/css" rel="stylesheet">
<script type="text/javascript" src="<?=__PUBLIC__?>/umeditor1_2_2-utf8-php/third-party/jquery.min.js"></script>
<script type="text/javascript" charset="utf-8" src="<?=__PUBLIC__?>/umeditor1_2_2-utf8-php/umeditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="<?=__PUBLIC__?>/umeditor1_2_2-utf8-php/umeditor.min.js"></script>
<script type="text/javascript" src="<?=__PUBLIC__?>/umeditor1_2_2-utf8-php/lang/zh-cn/zh-cn.js"></script>

<script>
UM.getEditor('content', {
    initialFrameWidth : "90%",
    initialFrameHeight : 350
});
</script>