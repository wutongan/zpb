<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>修改热词-拉钩</title>
    <link rel="stylesheet" type="text/css" href="<?php echo e(URL::asset('')); ?>public/style/css/css.css" />
    <script type="text/javascript" src="<?php echo e(URL::asset('')); ?>public/style/js/jquery.min.js"></script>
</head>
<body>
<div id="pageAll">
    <div class="pageTop">
        <div class="page">
            <img src="<?php echo e(URL::asset('')); ?>public/style/img/coin02.png" /><span><a href="<?php echo e(url('Index/right')); ?>">首页</a>&nbsp;-&nbsp;<a href="<?php echo e(url('Search/search')); ?>">热词管理</a>&nbsp;-</span>&nbsp;修改热词
        </div>
    </div>
    <div class="page ">
        <!-- 会员注册页面样式 -->
        <div class="banneradd bor">
            <div class="baTopNo">
                <span>修改</span>
            </div>
            <div class="baBody">
                <div class="bbD">
                    <input type="hidden" id="idd" value="<?php echo e($list->sea_id); ?>"/>
                    &nbsp;&nbsp;&nbsp;关键字：<input type="text" class="input3" id="sea_name" value="<?php echo e($list->sea_name); ?>" />&nbsp;&nbsp;&nbsp;<span id="s_name"></span>
                </div>

                <div class="bbD">
                    显示次数：<input type="text" class="input3" id="sea_num" value="<?php echo e($list->sea_num); ?>"/>&nbsp;&nbsp;&nbsp;<span id="s_num"></span>
                </div>
                <div class="bbD">
                    <p class="bbDP">
                        <button class="btn_ok btn_yes" href="#">确认修改</button>
                        <a class="btn_ok btn_no" href="#">取消</a>
                    </p>
                </div>
            </div>
        </div>
        <!-- 会员注册页面样式end -->
    </div>
</div>
</body>
</html>

<script>
    //点击确认修改
    $('.btn_yes').click(function(){
        var sea_id=$('#idd').val();
        var sea_name=$('#sea_name').val();
        var sea_num=$('#sea_num').val();
        if(sea_name==''){
            document.getElementById('s_name').innerHTML="<font color='red'>关键字不能为空</font>";return;
        }
        if(sea_num==''){
            document.getElementById('s_num').innerHTML="<font color='red'>显示次数不能为空</font>";return;
        }
            $.get("<?php echo e('e_update'); ?>",{sea_name:sea_name,sea_num:sea_num,sea_id:sea_id},function(msg){
                if(msg==1){
                    location.href="<?php echo e('search'); ?>";
                }else{
                    location.href="<?php echo e('search'); ?>";
                }
            })

    })

    //点击取消
    $('.btn_no').click(function(){
        location.href="<?php echo e('search'); ?>";
    })
</script>