<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>表单验证</title>
</head>
<body>
	<form action="<?php echo e(url('form/form')); ?>" method="post">
		<table border="1">
			<tr>
				<td>用户名：</td>
				<td><input type="text" name="username" id="" /></td>
			</tr>
			<tr>
				<td>密码：</td>
				<td><input type="password" name="password" id="" /></td>
			</tr>
			<tr>
				<td>确认密码：</td>
				<td><input type="password" name="repwd" id="" /></td>
			</tr>
			<tr>
				<td>邮箱：</td>
				<td><input type="text" name="email" id="" /></td>
			</tr>
			<tr>
				<td>手机号</td>
				<td><input type="text" name="phone" id="" /></td>
			</tr>
			<tr>
				<td><input type="submit" value="注册" /></td>
				<td><input type="reset" value="取消" /></td>
			</tr>
		</table>
	</form>
</body>
</html>