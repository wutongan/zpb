<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>我的贴吧</title>
</head>
<body>
	贴吧
	<div class="content">
		<?php foreach($data as $v): ?>
		<ul>
			<li><a href="<?php echo e(url('tieba/my_tie?id=').$v->tid); ?>"><?php echo e($v->tie); ?></a></li>
			<li><?php echo e($v->username); ?></li>
			<li><?php echo e($v->content); ?></li>
			<li><?php echo e($v->addtime); ?></li>
		</ul>
		<?php endforeach; ?>
	</div>
	<div>
		<form action="<?php echo e(url('tieba/insert')); ?>" method="post" enctype="multipart/form-data">
			<table>
				<tr>
					<td>标题</td>
					<td><input type="text" name="tie" id="" /></td>
				</tr>
				<tr>
					<td>图片</td>
					<td><input type="file" name="file" id="" /></td>
				</tr>
				<tr>
					<td>内容</td>
					<td><textarea name="content" id="" cols="30" rows="10"></textarea></td>
				</tr>
				<tr>
				<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" />
					<td><input type="submit" value="提交" /></td>
					<td><input type="reset" value="重置" /></td>
				</tr>
			</table>
		</form>


	</div>
</body>
<script type="text/javascript" src="<?php echo e(URL::asset('js/jquery.js')); ?>"></script>
</html>