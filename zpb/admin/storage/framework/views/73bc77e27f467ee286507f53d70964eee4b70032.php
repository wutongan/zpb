<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>管理员管理-有点</title>
<link rel="stylesheet" type="text/css" href="<?php echo e(URL::asset('')); ?>public/style/css/css.css" />
<script type="text/javascript" src="<?php echo e(URL::asset('')); ?>public/style/js/jquery.min.js"></script>
<!-- <script type="text/javascript" src="js/page.js" ></script> -->
</head>

<body>
	<div id="pageAll">
		<div class="pageTop">
			<div class="page">
				<img src="<?php echo e(URL::asset('')); ?>public/style/img/coin02.png" /><span><a href="<?php echo e(url('index/index')); ?>">首页</a>-</span>&nbsp;修改职位
			</div>
		</div>

		<div class="page">
			<!-- user页面样式 -->
			<div class="connoisseur">
				<!-- 职位分类表单 -->
				<div class="cfD">
					<form action="<?php echo e(url('Type/type')); ?>" method="post">
						<div class="page ">
			<div class="bacen">
				<div class="bbD">
					&nbsp;&nbsp;分类名称：<input type="text" class="input3" name="type_name" id="" value="<?=$arr->type_name?>" />
				</div>
				<div class="bbD">
					&nbsp;&nbsp;父级分类：
					<select class="userinput" name="type_pid" id="">
						<option value="0">顶级分类</option>
						<?php foreach($data as $v) { ?>
						<option value="<?php echo $v['type_id'] ?>"><?php echo $v['type_name'] ?></option>
						<?php foreach($v['child'] as $val): ?>
						<option value="<?php echo e($val->type_id); ?>"> &nbsp; &nbsp;|--<?php echo e($val->type_name); ?></option>
						<?php endforeach; ?>
					<?php } ?>
					</select>
				</div>
				<div class="bbD">
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;简介：
					<div class="btext">
						<textarea class="text2" name="type_desc" ></textarea>
					</div>
				</div>
				<div class="bbD">
					<p class="bbDP">
						<input class="btn_ok btn_yes" type="submit" value="添加" />
						<input class="btn_ok btn_no" type="reset" value="取消" />
					</p>
				</div>
			</div>
		</div>
					</form>
				</div>
				<!-- 职位分类表单 end-->
			</div>
			<!-- user页面样式end -->
		</div>
	</div>
</body>
</html>