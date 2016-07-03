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
				<img src="<?php echo e(URL::asset('')); ?>public/style/img/coin02.png" /><span><a href="<?php echo e(url('index/index')); ?>">首页</a>&nbsp;-&nbsp;-</span>&nbsp;热词列表
			</div>
		</div>

		<div class="page">
			<!-- user页面样式 -->
			<div class="connoisseur">
				<div class="conform">
					<form>
						<div class="cfD">
							<input class="userinput" type="text" placeholder="输入关键字" />
							<button class="userbtn">搜索</button>
						</div>
					</form>
				</div>
				<!-- user 表格 显示 -->
				<div class="conShow">
					<table border="1" cellspacing="0" cellpadding="0">
						<tr>
							<td width="66px" class="tdColor tdC">序号</td>
							<td width="1435px" class="tdColor">关键字</td>
							<td width="900px" class="tdColor">搜索次数</td>
							<td width="230px" class="tdColor">操作</td>
						</tr>
						<tr height="40px">
							<td>1</td>
							<td>运营专员</td>
							<td>9000</td>
							<td>
								<a href="" class="aColor">修改</a>&nbsp;&nbsp;&nbsp;&nbsp;
								<a href="" class="aColor">删除</a>&nbsp;&nbsp;&nbsp;&nbsp;
							</td>
						</tr>
					</table>
					<div class="paging">此处是分页</div>
				</div>
				<!-- user 表格 显示 end-->
			</div>
			<!-- user页面样式end -->
		</div>
	</div>
</body>
</html>