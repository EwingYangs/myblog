<?php $this->load->view('admin/top');?><div class="container clearfix">
    
        <?php $this->load->view('admin/menu');?>    <div class="main-wrap">

        <div class="crumb-wrap">
            <div class="crumb-list"><i class="icon-font"></i><a href="/jscss/admin/design/">首页</a><span class="crumb-step">&gt;</span><a class="crumb-name" href="/jscss/admin/design/">作品管理</a><span class="crumb-step">&gt;</span><span>新增作品</span></div>
        </div>
        <div class="result-wrap">
            <div class="result-content">
                <form action="<?=site_url('admin/AdminC/add')?>" method="post" id="myform" name="myform" enctype="multipart/form-data">
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
                                <th width="10%"><i class="require-red">*</i>用户名：</th>
                                <td>
                                    <input class="common-text required" id="username" name="username" size="50" value="<?=set_value('username')?>" type="text">
                                    <span style="color:red"><?=form_error('username')?></span>
                                </td>
                            </tr>
                                                    <tr>
                                <th width="10%"><i class="require-red">*</i>密码：</th>
                                <td>
                                    <input class="common-text required" id="password" name="password" size="50" value="<?=set_value('password')?>" type="text">
                                    <span style="color:red"><?=form_error('password')?></span>
                                </td>
                            </tr>
                                                    <tr>
                                <th width="10%">邮箱：</th>
                                <td>
                                    <input class="common-text required" id="email" name="email" size="50" value="<?=set_value('email')?>" type="text">
                                    <span style="color:red"><?=form_error('email')?></span>
                                </td>
                            </tr>
                                                    <tr>
                                <th width="10%"><i class="require-red">*</i>电话：</th>
                                <td>
                                    <input class="common-text required" id="tel" name="tel" size="50" value="<?=set_value('tel')?>" type="text">
                                    <span style="color:red"><?=form_error('tel')?></span>
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

