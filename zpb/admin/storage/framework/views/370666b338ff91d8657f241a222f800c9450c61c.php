<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>个人管理-有点</title>
<link rel="stylesheet" type="text/css" href="<?php echo e(URL::asset('')); ?>public/style/css/css.css" />
<link rel="stylesheet" type="text/css" href="<?php echo e(URL::asset('')); ?>public/style/css/manhuaDate.1.0.css">
	<script type="text/javascript" src="<?php echo e(URL::asset('')); ?>public/style/js/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo e(URL::asset('')); ?>public/style/js/manhuaDate.1.0.js"></script>
	<script type="text/javascript" src="<?php echo e(URL::asset('')); ?>public/style/js/jquery-1.7.2.min.js"></script>
	<!-- <script type="text/javascript" src="js/page.js" ></script> -->
</head>

<body>
	<div id="pageAll">
		<div class="pageTop">
			<div class="page">
				<img src="<?php echo e(URL::asset('')); ?>public/style/img/coin02.png" /><span><a href="<?php echo e(url('index/index')); ?>">首页</a>&nbsp;-</span>&nbsp;个人信息
			</div>
		</div>

		<div class="page">
			<!-- vip页面样式 -->
			<div class="vip">
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
							<input class="addUser" type="text" placeholder="输入用户名/手机号" />
							<button class="button">搜索</button>							 
						</div>
					</form>
				</div>
				<!-- vip 表格 显示 -->
				<div class="conShow">
					<table border="1" cellspacing="0" cellpadding="0">
						<tr>
							<td width="66px" class="tdColor tdC">序号</td>
							<td width="150px" class="tdColor">用户名</td>
							<td width="150px" class="tdColor">Email</td>
							<td width="150px" class="tdColor">手机号码</td>
							<td width="150px" class="tdColor">注册时间</td>
							<td width="290px" class="tdColor">头像</td>
							<td width="150px" class="tdColor">简历数量</td>
							<td width="230px" class="tdColor">操作</td>
						</tr>
						<tr>
							<td>1</td>
							<td>aacxzcc</td>
							<td>121331221@qq.com</td>
							<td>13312345678</td>
							<td>2016-06-14</td>
							<td>
								
									<img src="<?php echo e(URL::asset('')); ?>public/style/img/banimg.png">
								
							</td>
							<td>5</td>
							<td>
								<a href="" class="aColor">简历列表</a>&nbsp;&nbsp;&nbsp;&nbsp;
								<a href="" class="aColor">查看</a>&nbsp;&nbsp;&nbsp;&nbsp;
								<a href="" class="aColor">日志</a>
							</td>
						</tr>
					</table>
					<div class="paging">此处是分页</div>
				</div>
				<!-- vip 表格 显示 end-->
			</div>
			<!-- vip页面样式end -->
		</div>

	</div>


	<!-- 删除弹出框 -->
	<div class="banDel">
		<div class="delete">
			<div class="close">
				<a><img src="<?php echo e(URL::asset('')); ?>public/style/img/shanchu.png" /></a>
			</div>
			<p class="delP1">你确定要删除此条记录吗？</p>
			<p class="delP2">
				<a href="#" class="ok yes">确定</a><a class="ok no">取消</a>
			</p>
		</div>
	</div>
	<!-- 删除弹出框  end-->
</body>

<script type="text/javascript">
// 广告弹出框
$(".delban").click(function(){
  $(".banDel").show();
});
$(".close").click(function(){
  $(".banDel").hide();
});
$(".no").click(function(){
  $(".banDel").hide();
});
// 广告弹出框 end
</script>
</html>