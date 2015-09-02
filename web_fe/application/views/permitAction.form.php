<?php require("header.html") ?>
    <div id="rightTop">
        <ul class="subnav">
            <li><a class="btn4" href="index.php?app=admin&act=permitAction"><?php echo $lang['app_list']?></a></li>
        </ul>
        <p><?php echo $lang['add_app']?></p>
    </div>
    <!--form表单开始-->
    <div class="info">
        <form method="POST" enctype="multipart/form-data" id="form">
            <table class="infoTable">
                <tr>
                    <th class="paddingT15"><?php echo $lang['belong_app']?>：</th>
                    <td class="paddingT15 wordSpacing5">
                        <select id="parent_id" name="parent_id" style="width: 150px;">
                            <option value="0">controller</option>
                            <?php echo isset($actions) ? $actions : $actions; ?>
                            <!--<option value="2">游戏展示</option>
                            <option value="3">原画展示</option>-->
                        </select>
                        <label class="field_notice"><?php echo $lang['parent_app']?></label>
                    </td>
                </tr>

                <tr>
                    <th class="paddingT15"><?php echo $lang['action_name']?>:</th>
                    <td class="paddingT15 wordSpacing5">
                        <input class="http" id="action_name"
                               type="text" name="action_name"
                               value="<?php echo isset($action_name) ? $action_name : '';?>" />
                        <label class="field_notice"><?php echo $lang['example_act_name']?></label>
                    </td>
                </tr>

                <tr>
                    <th class="paddingT15"> <?php echo $lang['act_']?>:</th>
                    <td class="paddingT15 wordSpacing5">
                        <input class="http" id="action"
                               type="text" name="action"
                               value="<?php echo isset($action) ? $action : '';?>" />
                        <label class="field_notice"><?php echo $lang['example_act']?></label>
                    </td>
                </tr>

                <tr>
                    <th class="paddingT15"> <?php echo $lang['app_']?>:</th>
                    <td class="paddingT15 wordSpacing5">
                        <input class="http" id="controller"
                               type="text" name="controller"
                               value="<?php echo isset($controller) ? $controller : '';?>" />
                        <label class="field_notice"><?php echo $lang['example_app']?></label>
                    </td>
                </tr>

                <tr>
                    <th class="paddingT15"><?php echo $lang['Act_code']?>：</th>
                    <td class="paddingT15 wordSpacing5">
                        <input class="http" id="desc"
                               type="text" name="desc"
                               value="<?php echo isset($desc) ? $desc : '';?>" />
                        <label class="field_notice"><?php echo $lang['Act_code_example']?></label>
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

            var pid = "<?php echo isset($parent_id) ? $parent_id : '';?>";
            if(pid){
                $("#parent_id").val(pid);
            }
        });

        var validateOption = {
            onkeyup:false,
            rules:{
                url:{
                    required:true,
                    url:true
                },
                image:{
                    required:true
                },
                banner_position:{
                    required:true
                },
                belong_site:{
                    required:true
                },
                sort:{
                    number:true
                },
                desc:{
                    maxlength:255
                }

            },
            messages:{
                url:{
                    required:'<?php echo $lang['please_input']?>',
                    url:'<?php echo $lang['url_check']?>'
                },
                image:{
                    required:'<?php echo $lang['select_please']?>'
                },
                banner_position:{
                    required:'<?php echo $lang['please_input']?>'
                },
                belong_site:{
                    required:'<?php echo $lang['please_input']?>'
                },
                sort:{
                    number:'<?php echo $lang['number']?>'
                },
                desc:{
                    maxlength:'<?php echo $lang['length_255']?>'
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