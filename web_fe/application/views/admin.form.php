<?php require("header.html") ?>
    <script src="/public/js/jquery.ui/jquery.ui.js"></script>
    <script src="/public/js/jquery.ui/jquery-ui-slide.min.js"></script>
    <script src="/public/js/jquery.ui/jquery-ui-timepicker-addon.js"></script>
    <script src="/public/js/jquery.ui/i18n/zh-CN.js"></script>
    <link rel="stylesheet" href="/public/js/jquery.ui/themes/smoothness/jquery.ui.css"/>
    <div id="rightTop">
        <ul class="subnav">
            <li><a class="btn4" href="index.php?app=admin"><?php echo $lang['user_list']?></a></li>
        </ul>
        <p><?php echo $lang['add_user']?></p>
    </div>
    <!--form表单开始-->
    <div class="info">
        <form method="POST" enctype="multipart/form-data" id="form">
            <table class="infoTable">
                <tr>
                    <th class="paddingT15"> <?php echo $lang['user_name']?>:</th>
                    <td class="paddingT15 wordSpacing5">
                        <input class="http" id="username" type="text"name="username"
                               value="<?php echo isset($username) ? $username : '';?>"
                            <?php echo isset($username) && !empty($username) ? "readonly" : "";?>
                            />
                        <label class="field_notice"><?php echo $lang['eg']?>: flybear</label>
                    </td>
                </tr>

                <tr>
                    <th class="paddingT15"> <?php echo $lang['nick_name']?>:</th>
                    <td class="paddingT15 wordSpacing5">
                        <input class="http" id="nickname" type="text" name="nickname"
                               value="<?php echo isset($nickname) ? $nickname : '';?>" />
                        <label class="field_notice"><?php echo $lang['username_eg']?> </label>
                    </td>
                </tr>

                <tr>
                    <th class="paddingT15"> <?php echo $lang['role']?>:</th>
                    <td class="paddingT15 wordSpacing5">
                        <select id="role_id" name="role_id" style="width: 152px;">
                            <?php if(isset($roles)) :?>
                            <?php foreach($roles as $key => $val):?>
                                <?php if(isset($role_id) && $role_id == $val['id']):?>
                                <option value="<?php echo $val['id'];?>" selected><?php echo $val['role_name'];?></option>
                                <?php else:?>
                                <option value="<?php echo $val['id'];?>"><?php echo $val['role_name'];?></option>
                                <?php endif;?>
                            <?php endforeach;?>
                            <?php endif;?>
                        </select>
                        <label class="field_notice"><?php echo $lang['role_eg']?></label>
                    </td>
                </tr>

                <tr>
                    <th class="paddingT15"> <?php echo $lang['belong_platform']?></th>
                    <td class="paddingT15 wordSpacing5">
                        <select id="platform_id" name="platform_id[]" multiple style="width: 152px;">
                            <?php foreach($platforms as $key => $val):?>
                                <option value="<?php echo $val['id'];?>"><?php echo $val['platform_name'];?></option>
                            <?php endforeach;?>
                        </select>
                        <label class="field_notice"><?php echo $lang['check_platform_allow']?></label>
                    </td>
                </tr>



                <tr>
                    <th class="paddingT15"><?php echo $lang['password']?>:</th>
                    <td class="paddingT15 wordSpacing5">
                        <input class="http" id="password" type="password" name="password" value="" />
                        <?php if($_GET['act'] == 'editAdmin'):?>
                        <label class="field_notice" style="color: red"><?php echo $lang['empty_password_not_mod']?></label>
                        <?php else:?>
                        <label class="field_notice"><?php echo $lang['password']?></label>
                        <?php endif;?>
                    </td>
                </tr>

                <tr>
                    <th class="paddingT15"><?php echo $lang['confirm_password']?>:</th>
                    <td class="paddingT15 wordSpacing5">
                        <input class="http" id="re_password" type="password" name="re_password"
                               value="" />
                        <label class="field_notice"><?php echo $lang['confirm_password']?></label>
                    </td>
                </tr>

                <tr>
                    <th class="paddingT15"><?php echo $lang['gender']?></th>
                    <td class="paddingT15 wordSpacing5">
                        <select id="sex" name="sex">
                            <option value="1"><?php echo $lang['male']?></option>
                            <option value="0"><?php echo $lang['female']?></option>
                        </select>
                        <label class="field_notice"><?php echo $lang['default_gender']?></label>
                    </td>
                </tr>

                <tr>
                    <th class="paddingT15"><?php echo $lang['status']?></th>
                    <td class="paddingT15 wordSpacing5">
                        <select id="status" name="status">
                            <option value="1"><?php echo $lang['normal']?></option>
                            <option value="0"><?php echo $lang['invalid']?></option>
                        </select>
                        <label class="field_notice"><?php echo $lang['default_normal']?></label>
                    </td>
                </tr>

                <tr>
                    <th class="paddingT15"> <?php echo $lang['phone']?>:</th>
                    <td class="paddingT15 wordSpacing5">
                        <input class="http" id="telphone" type="text" name="telphone"
                               value="<?php echo isset($telphone) ? $telphone : '';?>" />
                        <label class="field_notice"></label>
                    </td>
                </tr>

                <tr>
                    <th></th>
                    <td class="ptb20"><input class="formbtn" type="submit" value="<?php echo $lang['submit']?>" />
                        <input class="formbtn" type="reset" name="Reset" value="<?php echo $lang['reset']?>" />
                    </td>
                </tr>
            </table>
        </form>
    </div>
    <script type="text/javascript">
        //<!CDATA[
        $(document).ready(function(){

            var status = "<?php echo isset($status) ? $status : '';?>";
            if(status){
                $("#status").val(status);
            }

            var sex = "<?php echo isset($sex) ? $sex : '';?>";
            if(sex){
                $("#sex").val(sex);
            }

            var platform_id = "<?php echo isset($platform_id) ? $platform_id : '';?>";
            if(platform_id){
                var serIDs = platform_id.split(',');
                $("#platform_id").val(serIDs);

//                $("#push_to_server_id[value=" + push_to_server_id +"]").attr('selected','selected');
//                $("#push_to_server_id").val(push_to_server_id);
            };


            var type = "<?php echo isset($type) ? $type : '';?>";
            if(type){
                $("#type").val(type);
            }
        });


        jQuery.validator.addMethod("isPhone", function(value,element) {
            var length = value.length;
            var mobile = /^(((13[0-9]{1})|(15[0-9]{1}))+\d{8})$/;
            var tel = /^\d{3,4}-?\d{7,9}$/;
            return this.optional(element) || (tel.test(value) || mobile.test(value));
        }, "<?php echo $lang['phone_notice']?>");

        var validateOption = {
            onkeyup:false,
            rules:{
                username:{
                    required:true
                },
                nickname:{
                    required:true
                },
                role_id:{
                    required:true
                },
//                'platform_id[]': {
//                    required: true
//                },
                <?php if($_GET['act'] == 'editAdmin'):?>
                password:{
                    minlength:6
                },
                re_password:{
                    equalTo: '#password'
                },

                <?php else:?>
                password:{
                    required:true,
                    minlength:6
                },
                re_password:{
                    equalTo: '#password'
                },
                <?php endif;?>
                telphone:{
                    required:true,
                    isPhone : true
                }
            },
            messages:{
                username:{
                    required:'<?php echo $lang['form_submit_error']['not_empty']?>'
                },
                nickname:{
                    required:'<?php echo $lang['form_submit_error']['not_empty']?>'
                },
                role_id:{
                    required:'<?php echo $lang['form_submit_error']['need_select']?>'
                },
                'platform_id[]': {
                    required: '<?php echo $lang['form_submit_error']['need_select']?>'
                },
                <?php if($_GET['act'] == 'editAdmin'):?>
                password:{
                    minlength:'<?php echo $lang['form_submit_error']['pass_length_limit']?>'
                },
                re_password:{equalTo:'<?php echo $lang['password_inconsistent']?>'},
                <?php else:?>
                password:{
                    required:'<?php echo $lang['password_required']?>',
                    minlength:'<?php echo $lang['form_submit_error']['pass_length_limit']?>'
                },
                re_password:{equalTo:'<?php echo $lang['password_inconsistent']?>'},
                <?php endif;?>

                telphone:{
                    required:'<?php echo $lang['phone_required']?>',
                    isPhone : '<?php echo $lang['phone_notice']?>'
                }
            },
            errorPlacement: function(error, element) {
                error.appendTo(element.parent());
            }
        };
        $("form").validate(validateOption);
        //]]>
    </script>
    <!--form表单结束-->

<?php require("footer.html")?>