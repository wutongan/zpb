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
				<img src="<?php echo e(URL::asset('')); ?>public/style/img/coin02.png" /><span><a href="#">首页</a>&nbsp;-</span>&nbsp;招聘信息
			</div>
		</div>
		<div class="page ">
			<!-- 上传广告页面样式 -->
			<div class="banneradd bor">
				<div class="baTopNo">
					<span>招聘信息</span>
				</div>
				<div class="baBody">
					<div class="bbD">
						招聘岗位：&nbsp;&nbsp;&nbsp;&nbsp;<?php echo e($arr->rec_title); ?>

					</div>
					<div class="bbD">
						所属部门：&nbsp;&nbsp;&nbsp;&nbsp;<?php echo e($arr->rec_branch); ?>

					</div>
					<div class="bbD">
						岗位性质：&nbsp;&nbsp;&nbsp;&nbsp;<?php echo e($arr->rec_nature); ?>

					</div>
					<div class="bbD">
						岗位亮点：&nbsp;&nbsp;&nbsp;&nbsp;<?php echo e($arr->rec_sport); ?>

						</div>
					<div class="bbD">
						所在城市：&nbsp;&nbsp;&nbsp;&nbsp;<?php echo e($arr->rec_city); ?>

					</div>
					<div class="bbD">
						学历：&nbsp;&nbsp;&nbsp;&nbsp;<?php echo e($arr->stu_name); ?>

					</div>
					<div class="bbD">
						工作经验：&nbsp;&nbsp;&nbsp;&nbsp;<?php echo e($arr->suf_name); ?>

					</div>
					<div class="bbD">
						薪资：&nbsp;&nbsp;&nbsp;&nbsp;<?php echo e($arr->rec_moneymin); ?>--<?php echo e($arr->rec_moneymax); ?>

					</div>
					<div class="bbD">
						接收邮箱：&nbsp;&nbsp;&nbsp;&nbsp;<?php echo e($arr->rec_email); ?>

					</div>
					<div class="bbD">
						岗位描述：&nbsp;&nbsp;&nbsp;&nbsp;<?php echo e($arr->rec_desc); ?>

					</div>
					<div class="bbD">
						<p class="bbDP">
							<a class="btn_ok btn_yes" href="<?php echo e(url('Firm/show')); ?>?m_id=<?php echo e($arr->m_id); ?>">返回</a>
						</p>
					</div>
				</div>
			</div>

			<!-- 上传广告页面样式end -->
		</div>
	</div>
</body>
</html>