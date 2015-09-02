<?php require("header.html") ?>
    <style>
        .formtb {
            background: #AACBEE;
            width: 100%;
            margin-top: 8px;
            margin-bottom: 8px
        }

        .formtb th {
            background: #F6F9FE;
            color: #000;
            padding: 7px 56px;
            border: 1px solid #FFF;
            text-align: left;
            padding: 5px 56px;
            font-size: 12px;
            padding-left: 21%;
        }

        .formtb td {
            font-size: 12px;
        }

        .formtb .td_left {
            width: 12%;
            background: #F6F9FE;
            text-align: right;
            padding: 3px;
        }

        .formtb .td_right {
            padding: 3px;
            padding-left: 7px;
            background: #FFF;
            text-align: left;
        }

        .formtb .I_Content {
            background: #fff;
            padding: 5px;
            text-align: left
        }
    </style>
    <script src="/public/js/jquery.ui/jquery.ui.js"></script>
    <script src="/public/js/jquery.ui/jquery-ui-slide.min.js"></script>
    <script src="/public/js/jquery.ui/jquery-ui-timepicker-addon.js"></script>
    <script src="/public/js/jquery.ui/i18n/zh-CN.js"></script>
    <link rel="stylesheet" href="/public/js/jquery.ui/themes/smoothness/jquery.ui.css"/>
    <div id="rightTop">
        <ul class="subnav">
            <li><a class="btn4" href="index.php?app=admin&act=role"><?php echo $lang['role_list']?></a></li>
        </ul>
        <p><?php echo $lang['add_role']?></p>
    </div>
    <!--form表单开始-->
    <div class="info">
    <form method="POST" enctype="multipart/form-data" id="form">
    <table class="infoTable">
    <tr>
        <th class="paddingT15"> <?php echo $lang['role_name']?>:</th>
        <td class="paddingT15 wordSpacing5">
            <input class="http" id="role_name" type="text" name="role_name"
                   value="<?php echo isset($role_name) ? $role_name : ''; ?>"/>
            <label class="field_notice"><?php echo $lang['role_name_eg']?></label>
        </td>
    </tr>
<!---->
<!--    <tr>-->
<!--        <th class="paddingT15"> --><?php //echo $lang['belong_platform']?><!--</th>-->
<!--        <td class="paddingT15 wordSpacing5">-->
<!--            <select id="platform_id" name="platform_id[]" multiple style="width: 152px;">-->
<!--                --><?php //foreach($platforms as $key => $val):?>
<!--                    <option value="--><?php //echo $val['id'];?><!--">--><?php //echo $val['name'];?><!--</option>-->
<!--                --><?php //endforeach;?>
<!--            </select>-->
<!--            <label class="field_notice">--><?php //echo $lang['check_platform_allow']?><!--</label>-->
<!--        </td>-->
<!--    </tr>-->
<!---->

    <tr>
        <th class="paddingT15"><?php echo $lang['role_belong']?></th>
        <td class="paddingT15 wordSpacing5">
            <select id="role_source" name="role_source" style="width: 152px;">
                <option value="0"><?php echo $lang['managers']?></option>
                <option value="1"><?php echo $lang['partner']?></option>
            </select>
            <label class="field_notice"><?php echo $lang['default_managers']?></label>
        </td>
    </tr>

    <tr>
        <th class="paddingT15"> <?php echo $lang['role_desc']?>:</th>
        <td class="paddingT15 wordSpacing5">
            <input class="http" id="desc" type="text" name="desc"
                   value="<?php echo isset($desc) ? $desc : ''; ?>"/>
            <label class="field_notice"><?php echo $lang['role_desc_notice']?></label>
        </td>
    </tr>

    <tr>
    <th class="paddingT15"> <?php echo $lang['role_has_right']?>:</th>
    <td>
        <table class="formtb" border="0" cellpadding="0" cellspacing="1" id="actions">
            <tbody>
                <?php if(count($actions )> 0):?>
                <?php foreach($actions as $key => $val):?>
                        <tr>
                            <td class="td_left" style="text-align:left" rel_data="action">
                                <input type="checkbox" value="<?php echo $val['id'];?>" name="action">
                                <?php echo $val['action_name'];?>
                            </td>

                            <td class="td_right" rel_data="action_detail">
                                <?php foreach($val['childActions'] as $k => $v):?>
                                    <input type="checkbox" value="<?php echo $v['id'];?>" name="action_detail[]" action_id="<?php echo $v['id'];?>">
                                    <?php echo $v['action_name'];?>
                                <?php endforeach;?>
                            </td>

                        </tr>
                <?php endforeach;?>
                <?php endif;?>
            </tbody>
        </table>
    </td>
    </tr>

        <tr>
            <th class="paddingT15"><?php echo $lang['approve_right']?>:</th>
            <td class="paddingT15 wordSpacing5">
                <input type="checkbox" id="approve_right" name="approve_right" value="1" />
                <!--                        <textarea name="content" style="width: 390px;" >--><!--</textarea>-->
                <label class="field_notice"></label>
            </td>
        </tr>


        <tr>
            <th></th>
            <td class="ptb20"><input class="formbtn" type="submit" value="<?php echo $lang['submit']?>"/>
                <input class="formbtn" type="reset" name="Reset" value="<?php echo $lang['reset']?>"/>
            </td>
        </tr>
    </table>
    </form>
    </div>
    <script type="text/javascript">
        //<!CDATA[
        $(document).ready(function () {

            $("#actions").find("td[rel_data='action']").each(function(){

                $(this).find("input[name='action']").change(function(){

                    if(typeof $(this).attr("checked") === 'undefined'){
                        $(this).parent().parent()
                            .find("td[rel_data='action_detail']")
                            .find("input[name='action_detail[]']")
                            .attr("checked",false);
                    }else{
                        $(this).parent().parent()
                            .find("td[rel_data='action_detail']")
                            .find("input[name='action_detail[]']")
                            .attr("checked",$(this).attr("checked"));
                    };
                });
            });

            var role_source = "<?php echo isset($role_source) ? $role_source : '';?>";
            if (role_source) {
                $("#role_source").val(role_source);
            };

            var type = "<?php echo isset($type) ? $type : '';?>";
            if (type) {
                $("#type").val(type);
            };

            var platform_id = "<?php echo isset($platform_id) ? $platform_id : '';?>";
            if(platform_id){
                var serIDs = platform_id.split(',');
                $("#platform_id").val(serIDs);

//                $("#push_to_server_id[value=" + push_to_server_id +"]").attr('selected','selected');
//                $("#push_to_server_id").val(push_to_server_id);
            };

            var options = <?php echo isset($action_detail) && count($action_detail) > 0 ? json_encode($action_detail) : '[]';?>;

            for(var key in options){
                $("input[action_id='" + options[key].action_id + "']").attr('checked',true);
            }

            var approve_right = "<?php echo isset($approve_right) ? $approve_right : 0;?>";;
            console.log($("#change_to_url"));
            console.log(approve_right);

            if(parseInt(approve_right) > 0){
                $("input[name='approve_right'][value='1']").attr('checked','true');
            }





        });

        var validateOption = {
            onkeyup: false,
            rules: {
                role_name: {
                    required: true
                },
                'platform_id[]': {
                    required: true
                },
                role_source: {
                    required: true
                }
            },
            messages: {
                role_name: {
                    required: '<?php echo $lang['please_input']?>'
                },
                'platform_id[]': {
                    required: '<?php echo $lang['please_input']?>'
                },
                role_source: {
                    required: '<?php echo $lang['please_input']?>'
                }
            },
            errorPlacement: function (error, element) {
                error.appendTo(element.parent());
            }
        };
        $("form").validate(validateOption);
        //]]>
    </script>
    <!--form表单结束-->
<?php require("footer.html") ?>