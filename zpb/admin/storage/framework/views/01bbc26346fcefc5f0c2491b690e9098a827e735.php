<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>会员编辑-有点</title>
<link rel="stylesheet" type="text/css" href="<?php echo e(URL::asset('')); ?>public/style/css/css.css" />
<script type="text/javascript" src="<?php echo e(URL::asset('')); ?>public/style/js/jquery.min.js"></script>
</head>
<body>
	<div id="pageAll">
		<div class="pageTop">
			<div class="page">
				<img src="<?php echo e(URL::asset('')); ?>public/style/img/coin02.png" /><span><a href="#">首页</a>&nbsp;-</span>&nbsp;公司信息
			</div>
		</div>
		<div class="page ">
			<!-- 上传广告页面样式 -->
			<div class="banneradd bor">
				<div class="baTopNo">
					<span>公司信息</span>
				</div>
				<div class="baBody">
					<div class="bbD">
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<img src="../../<?php echo e($arr->firm_logo); ?>" width="70px" height="70px" />
					</div>
					<div class="bbD">
						公司名称：&nbsp;&nbsp;&nbsp;&nbsp;<?php echo e($arr->firm_name); ?>

					</div>
					<div class="bbD">
						公司规模：&nbsp;&nbsp;&nbsp;&nbsp;<?php echo e($arr->firm_sca); ?>

					</div>
					<div class="bbD">
						公司领域：&nbsp;&nbsp;&nbsp;&nbsp;<?php echo e($arr->field_name); ?>

						</div>
					<div class="bbD">
						所在城市：&nbsp;&nbsp;&nbsp;&nbsp;<?php echo e($arr->firm_address); ?>

					</div>
					<div class="bbD">
						公司福利：&nbsp;&nbsp;&nbsp;&nbsp;<?php echo e($arr->firm_xy); ?>

					</div>
					<div class="bbD">
						融资规模：&nbsp;&nbsp;&nbsp;&nbsp;<?php echo e($arr->firm_stage); ?>

					</div>
					<div class="bbD">
						创始人：&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo e($arr->firm_founder); ?>

					</div>
					<div class="bbD">
						公司介绍：&nbsp;&nbsp;&nbsp;&nbsp;<?php echo e($arr->firm_desc); ?>

					</div>
					<div class="bbD">
						<p class="bbDP">
							<a class="btn_ok btn_yes" href="<?php echo e(url('Firm/liebiao')); ?>">返回</a>
						</p>
					</div>
				</div>
			</div>

			<!-- 上传广告页面样式end -->
		</div>
	</div>
</body>
</html>