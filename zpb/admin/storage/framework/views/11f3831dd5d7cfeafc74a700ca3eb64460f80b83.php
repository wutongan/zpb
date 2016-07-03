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
				<img src="<?php echo e(URL::asset('')); ?>public/style/img/coin02.png" /><span><a href="#">首页</a>&nbsp;-</span>&nbsp;用户信息
			</div>
		</div>
		<div class="page ">
			<!-- 上传广告页面样式 -->
			<div class="banneradd bor">
				<div class="baTopNo">
					<span>用户信息</span>
				</div>
				<div class="baBody">
					<div class="bbD">
						头像：
						<div class="vipHead">
							<img src="<?php echo e(URL::asset('')); ?>public/style/img/userPICS.png" />
						</div>
					</div>
					<div class="bbD">
						账号：&nbsp;&nbsp;&nbsp;&nbsp;<?php echo e($arr->m_user); ?>

					</div>
					<div class="bbD">
						邮箱：&nbsp;&nbsp;&nbsp;&nbsp;<?php echo e($arr->m_email); ?>

					</div>
					<div class="bbD">
						电话：&nbsp;&nbsp;&nbsp;&nbsp;<?php echo e($arr->m_phone); ?>

						</div>
					<div class="bbD">
						所在城市：&nbsp;&nbsp;<?php echo e($arr->pre_address); ?>

					</div>
					<div class="bbD">
						学历：&nbsp;&nbsp;&nbsp;&nbsp;<?php echo e($arr->stu_name); ?>

					</div>
					<div class="bbD">
						工作经验：&nbsp;&nbsp;<?php echo e($arr->suf_name); ?>

					</div>
					<div class="bbD">
						<p class="bbDP">
							<a class="btn_ok btn_yes" href="<?php echo e(url('Preson/preson')); ?>">返回</a>
						</p>
					</div>
				</div>
			</div>

			<!-- 上传广告页面样式end -->
		</div>
	</div>
</body>
</html>