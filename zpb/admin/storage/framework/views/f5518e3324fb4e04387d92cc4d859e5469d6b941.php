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
				<img src="<?php echo e(URL::asset('')); ?>public/style/img/coin02.png" /><span><a href="<?php echo e(url('index/index')); ?>">首页</a>&nbsp;-</span>&nbsp;企业管理
			</div>
		</div>

		<div class="page">
			<!-- user页面样式 -->
			<div class="connoisseur">
				<div class="conform">
					<form>
						<div class="cfD">
							 认证状态：
							 <label><input type="radio" checked="checked" name="styleshoice1" />&nbsp;不限</label>
							 &nbsp;&nbsp;&nbsp;&nbsp;
							 <label><input type="radio" name="styleshoice1" />&nbsp;通过</label> &nbsp;&nbsp;&nbsp;&nbsp;
							 <label><input type="radio" name="styleshoice1" />&nbsp;未审核</label>&nbsp;&nbsp; &nbsp;&nbsp;
							 <label><input type="radio" name="styleshoice1" />&nbsp;未通过</label>&nbsp;&nbsp;&nbsp;&nbsp; 
							 <label><input type="radio" name="styleshoice1" />&nbsp;已完成</label>
							 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<input class="addUser" type="text" placeholder="输入公司名" />
							<button class="button">搜索</button>
						</div>
					</form>
				</div>
				<!-- user 表格 显示 -->
				<div class="conShow">
					<table border="1" cellspacing="0" cellpadding="0">
						<tr>
							<td width="60px" class="tdColor tdC">序号</td>
							<td width="150px" class="tdColor">公司名称</td>
							<td width="150px" class="tdColor">所属会员</td>
							<td width="200px" class="tdColor">公司LOGO</td>
							<td width="150px" class="tdColor">创建时间</td>
							<td width="75px" class="tdColor">认证状态</td>
							<td width="75px" class="tdColor">收到简历</td>
							<td width="230px" class="tdColor">操作</td>
						</tr>
						<tr height="40px">
							<td><input type="checkbox">1</td>
							<td>腾讯</td>
							<td>95445455555@qq.com</td>
							<td>未上传</td>
							<td>2016-06-14</td>
							<td>未通过</td>
							<td>20</td>
							<td>
							<a href="" class="aColor">职位列表</a>&nbsp;&nbsp;&nbsp;&nbsp;
							<a href="" class="aColor">查看</a>&nbsp;&nbsp;&nbsp;&nbsp;
							<a href="" class="aColor">日志</a>
							</td>
						</tr>
					</table>
					<div class="cfD">
						<button class="button">认证企业</button>
						<button class="button">刷新</button>
					</div>
					<div class="paging">此处是分页</div>
				</div>
				<!-- user 表格 显示 end-->
			</div>
			<!-- user页面样式end -->
		</div>

	</div>
</body>
</html>