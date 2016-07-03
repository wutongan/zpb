<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<title>后台登录</title>
<meta name="author" content="DeathGhost" />
<link rel="stylesheet" type="text/css" href="<?php echo e(URL::asset('')); ?>public/style/css/style.css" />
<style>
body{height:100%;background:#16a085;overflow:hidden;}
canvas{z-index:-1;position:absolute;}
</style>
<script src="<?php echo e(URL::asset('')); ?>public/style/js/jquery.js"></script>
<script src="<?php echo e(URL::asset('')); ?>public/style/js/verificationNumbers.js"></script>
<script src="<?php echo e(URL::asset('')); ?>public/style/js/Particleground.js"></script>
<script>
$(document).ready(function() {
  //粒子背景特效
  $('body').particleground({
    dotColor: '#5cbdaa',
    lineColor: '#5cbdaa'
  });
  //验证码
  createCode();
});
</script>
</head>
<body>
<dl class="admin_login">
  <dt> <strong>招聘吧后台管理系统</strong> <em>Management System</em> </dt>
  <dd class="user_icon">
    <input type="text" placeholder="账号" name="adm_user" id="adm_user" class="login_txtbx"/>
  </dd>
  <dd class="pwd_icon">
    <input type="password" placeholder="密码" name="adm_pwd" id="adm_pwd" class="login_txtbx"/>
  </dd>
  <dd class="val_icon">
    <div class="checkcode">
      <input type="text" id="J_codetext" placeholder="验证码" maxlength="4" class="login_txtbx">
      <canvas class="J_codeimg" id="myCanvas" onclick="createCode()">对不起，您的浏览器不支持canvas，请下载最新版浏览器!</canvas>
    </div>
    <input type="button" value="验证码核验" class="ver_btn" onClick="validate();">
  </dd>
  <dd id="err"></dd>
  <dd>
    <input type="button" value="立即登陆" class="submit_btn"/>
  </dd>
  <dd>
    <p>© 2016-2017 zhaopinba 版权所有</p>
    <p>陕B2-20080224-1</p>
  </dd>
</dl>
</body>
</html>
<script>
$('.submit_btn').click(function(){

	if(validate()==false)
	{
		$('#err').html('<font color="red">验证码错误</font>');
	}
	else
	{
		$('#err').html('');
		var user = $('#adm_user').val();
		var pwd = $('#adm_pwd').val();
		$.ajax({
			type:'post',
			url:"<?php echo e(url('Login/index')); ?>",
			data:'user='+user+'&pwd='+pwd,
			success:function(e)
			{
				var data = eval("("+e+")");
				if(data.status==1)
				{
					$('#err').html('');
					location.href="<?php echo e(url('Index/index')); ?>";
				}
				else
				{
					$('#err').html('<font color="red" >'+data.msg+'</font>');
				}
			}
		})
	}
})
</script>
