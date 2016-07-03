<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>头部-有点</title>
<link rel="stylesheet" type="text/css" href="<?php echo e(URL::asset('')); ?>public/style/css/public.css" />
<script type="text/javascript" src="<?php echo e(URL::asset('')); ?>public/style/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo e(URL::asset('')); ?>public/style/js/public.js"></script>
</head>

<body>
	<!-- 头部 -->
	<?php session_start();?>
	<div class="head">
		<div class="headL">
			<img class="headLogo" src="<?php echo e(URL::asset('')); ?>public/style/img/headLogo.png" />
		</div>
		<div class="headR">
			<p class="p1">
				
				欢迎&nbsp;<font color="red"><?php echo $_SESSION['adm_user']?></font>&nbsp;登陆
			</p>
			
			<p class="p2">
                <a href="<?php echo e(url('System/changepwd')); ?>" target="right" class="resetPWD">重置密码</a>&nbsp;&nbsp;<a
					href="<?php echo e(url('Index/loginout')); ?>" target='_parent' class="goOut">退出</a>
			</p>
		</div>
	</div>
</body>
</html>