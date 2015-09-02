<?php require("header.html") ?>
    <script src="/public/js/jquery.ui/jquery.ui.js"></script>
    <script src="/public/js/jquery.ui/jquery-ui-slide.min.js"></script>
    <script src="/public/js/jquery.ui/jquery-ui-timepicker-addon.js"></script>
    <script src="/public/js/jquery.ui/i18n/zh-CN.js"></script>
    <link rel="stylesheet" href="/public/js/jquery.ui/themes/smoothness/jquery.ui.css"/>

    <div id="rightTop">
        <ul class="subnav">
            <li><a class="btn4" href="index.php?app=server&act=platform"><?php echo $lang['platform_list']?></a></li>
        </ul>
        <p><?php echo $lang['add_platform']?></p>
    </div>
    <!--form表单开始-->
    <div class="info">
        <form method="POST" enctype="multipart/form-data" id="form">
            <table class="infoTable">
                <tr>
                    <th class="paddingT15"> <?php echo $lang['platformID']?>:</th>
                    <td class="paddingT15 wordSpacing5">
                        <input class="http" id="platform_id" type="text" name="platform_id"
                               value="<?php echo isset($platform_id) ? $platform_id : '';?>" />
                        <label class="field_notice"><?php echo $lang['eg']?>: 12033</label>
                    </td>
                </tr>

                <tr>
                    <th class="paddingT15"> <?php echo $lang['platform_name']?>:</th>
                    <td class="paddingT15 wordSpacing5">
                        <input class="http" id="platform_name" type="text"name="platform_name"
                               value="<?php echo isset($platform_name) ? $platform_name : '';?>" />
                        <label class="field_notice"><?php echo $lang['platform_eg']?></label>
                    </td>
                </tr>

                <tr>
                    <th class="paddingT15"><?php echo $lang['official_site']?>:</th>
                    <td class="paddingT15 wordSpacing5">
                        <input class="http" id="official_site" type="text"name="official_site"
                               value="<?php echo isset($official_site) ? $official_site : '';?>" />
                        <label class="field_notice"><?php echo $lang['eg']?>: http://www.baidu.com/</label>
                    </td>
                </tr>

                <tr>
                    <th class="paddingT15"><?php echo $lang['desc']?>：</th>
                    <td class="paddingT15 wordSpacing5">
                        <textarea name="desc" style="width: 390px;" ><?php echo isset($desc) ? $desc : '';?></textarea>
                    </td>
                </tr>

                <tr>
                    <th class="paddingT15"><?php echo $lang['status']?></th>
                    <td class="paddingT15 wordSpacing5">
                        <select id="status" name="status">
                            <option value="1"><?php echo $lang['normal']?></option>
                            <option value="0"><?php echo $lang['expired']?></option>
                        </select>
                        <label class="field_notice"><?php echo $lang['default_normal']?></label>
                    </td>
                </tr>

                <tr>
                    <th class="paddingT15"> <?php echo $lang['order']?>:</th>
                    <td class="paddingT15 wordSpacing5">
                        <input id="sort" size="6px" type="text"name="sort"  value="<?php echo isset($sort) ? $sort : '';?>" />
                        <label class="field_notice"><?php echo $lang['order_notice']?></label>
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

            var type = "<?php echo isset($type) ? $type : '';?>";
            if(type){
                $("#type").val(type);
            }
        });

        var validateOption = {
            onkeyup:false,
            rules:{
                platform_id:{
                    required:true,
                    number:true
                },
                name:{
                    required:true
                },
                game_operator:{
                    required:true
                },
                site_url:{
                    required:true,
                    url:true
                },
                percentage:{
                    required:true,
                    number:true,
                    max:0.999999,
                    min:0.000001
                },
                desc:{
                    maxlength:255
                },
                sort:{
                    number:true,
                    max:255
                }

            },
            messages:{
                platform_id:{
                    required:'<?php echo $lang['please_input']?>',
                    number:'<?php echo $lang['please_input'].$lang['number']?>'
                },
                game_operator:{
                    required:'<?php echo $lang['please_input']?>'
                },
                name:{
                    required:'<?php echo $lang['please_input']?>'
                },
                site_url:{
                    required:'<?php echo $lang['please_input']?>',
                    url:'<?php echo $lang['url_notice']?>'
                },
                percentage:{
                    required:'<?php echo $lang['please_input']?>',
                    number:'<?php echo $lang['integer']?>',
                    max:'<?php echo $lang['integer']?>',
                    min:'<?php echo $lang['integer']?>'
                },
                desc:{
                    maxlength:'<?php echo $lang['max_num']?>'
                },
                sort:{
                    number:'<?php echo $lang['number']?>',
                    max:'<?php echo $lang['max_num']?>'
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