<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>登陆</title>
</head>
<body>
<center>
<h1>用户登录界面</h1>
	<form action="<?php echo e(url('zhoukao/login')); ?>" method="post">
		<table >
			<tr>
				<td>用户名:</td>
				<td><input type="text" name="username" id="" /></td>
			</tr>
			<tr>
				<td>密码:</td>
				<td><input type="password" name="password" id="" /></td>
			</tr>
			<tr>
				<td colspan="2"><input type="checkbox" name="check" id="check" value="1" />记住密码</td>
			</tr>
			<tr>
			<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" />
				<td><input type="submit" value="登录" /></td>
				<td><input type="reset" value="重置" /></td>
			</tr>
		</table>
	</form>
</center>
</body>
</html>