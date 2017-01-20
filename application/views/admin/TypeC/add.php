<?php $this->load->view('admin/top');?><div class="container clearfix">
    
        <?php $this->load->view('admin/menu');?>    <div class="main-wrap">

        <div class="crumb-wrap">
            <div class="crumb-list"><i class="icon-font"></i><a href="/jscss/admin/design/">首页</a><span class="crumb-step">&gt;</span><a class="crumb-name" href="<?=site_url('admin/TypeC/lst')?>">类型管理</a><span class="crumb-step">&gt;</span><span>新增类型</span></div>
        </div>
        <div class="result-wrap">
            <div class="result-content">
                <form action="<?=site_url('admin/TypeC/add')?>" method="post" id="myform" name="myform" enctype="multipart/form-data">
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
                                <th width="10%"><i class="require-red">*</i>类型名称：</th>
                                <td>
                                    <input class="common-text required" id="type_name" name="type_name" size="50" value="<?=set_value('type_name')?>" type="text">
                                    <span style="color:red"><?=form_error('type_name')?></span>
                                </td>
                            </tr>
                            <tr>
                                <th width="10%">英文名称：</th>
                                <td>
                                    <input class="common-text required" id="elg_name" name="elg_name" size="50" value="<?=set_value('elg_name')?>" type="text">
                                    <span style="color:red"><?=form_error('elg_name')?></span>
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

