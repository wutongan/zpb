<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title><?php echo e($row->tie); ?></title>
</head>
<body>
<div>
	<span><img src="<?php echo e(isset($row->img) ? $row->img : URL::asset('images/tou.png')); ?>" alt="" />
	<?php echo e($row->username); ?>

	</span>
	<h3><?php echo e($row->tie); ?></h3>
	<p><?php echo e($row->content); ?></p>
	<p><?php echo e(date('y-m-d',$row->addtime)); ?></p>
</div>


<div>
	<form action="">
		<textarea name="hui" id="hui" cols="30" rows="10"></textarea>

		<input type="submit" value="发表" />
	</form>


</div>


</body>
</html>