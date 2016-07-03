<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>投票列表</title>
</head>
<body>
	<div>
		<?php foreach($lists as $v): ?>
			<h2><?php echo e($v->message); ?></h2>

			<?php foreach(unserialize($v->xuan) as $val): ?>
				<?php if($v->stat == 'Y'): ?>
				<input type="radio" name="dan_<?php echo e($v->id); ?>" id="" />
				<?php else: ?>
				<input type="checkbox" name="dan_<?php echo e($v->id); ?>[]" id="" />
				<?php endif; ?>
				<?php echo e($val); ?>

			<?php endforeach; ?>
		<?php endforeach; ?>
	</div>
</body>
</html>