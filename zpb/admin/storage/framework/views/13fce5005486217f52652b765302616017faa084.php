<html>
    <head>
        <title>Login</title>
    </head>
    <body>
	
        <div class="container">
			<h1>用户登录</h1>
			<form action="<?php echo e(url('admin/login')); ?>" method="post">
			<table>
			<tr>
				<td>用户名:</td>
				<td>
				<input type="text" name="username" id="">
				</td>
			</tr>
			<tr>
				<td>密码:</td>
				<td>
				<input type="password" name="password" id="">
				</td>
			</tr>
			<tr>
				<td colspan="2">
				<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
				<input type="submit" value="登录">
				<input type="reset" value="重置">
				</td>
			</tr>
			</table>
			</form>

        </div>
    </body>
</html>