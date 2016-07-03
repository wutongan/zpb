<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>添加图片</title>
</head>
<body>
	<form action="<?php echo e(url('img/add')); ?>" method="post" enctype="multipart/form-data">
		<table>
			<tr>
				<td>图片标题</td>
				<td><input type="text" name="title" id="" /></td>
			</tr>
			<tr>
				<td>图片</td>
				<td><input type="file" name="file" id="" /></td>
			</tr>
			<tr>
				<td>排序</td>
				<td><input type="text" name="sort" value="10" /></td>
			</tr>
			<tr>
				<td><input type="submit" value="添加" /></td>
				<td><input type="reset" value="重置" /></td>
			</tr>
		</table>
	</form>

	<div>
	<table>
		<tr>
			<th>id</th>
			<th>标题</th>
			<th>图片</th>
			<th>排序</th>
		</tr>
		<?php foreach($data as $v): ?>
		<tr>
			<td><?php echo e($v->mid); ?></td>
			<td><?php echo e($v->title); ?></td>
			<td><img src="<?php echo e(URL::asset('images/'.$v->img)); ?>" alt="" width="40" height="40" /></td>
			<td><?php echo e($v->sort); ?></td>
		</tr>
		<?php endforeach; ?>
	</table>
	</div>
</body>
</html>