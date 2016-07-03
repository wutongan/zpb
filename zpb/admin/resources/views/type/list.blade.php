<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>管理员管理-有点</title>
<link rel="stylesheet" type="text/css" href="{{URL::asset('')}}public/style/css/css.css" />
<link rel="stylesheet" type="text/css" href="{{URL::asset('')}}public/style/css/bootstrap.css">
<script type="text/javascript" src="{{URL::asset('')}}public/style/js/jquery.min.js"></script>
<!-- <script type="text/javascript" src="js/page.js" ></script> -->
</head>

<body>
	<div id="pageAll">
		<div class="pageTop">
			<div class="page">
				<img src="{{URL::asset('')}}public/style/img/coin02.png" /><span><a href="{{url('index/index')}}">首页</a>&nbsp;-&nbsp;-</span>&nbsp;职位列表
			</div>
		</div>

		<div class="page">
		<!-- user页面样式 -->
			<div class="connoisseur">
				<div class="conform">
					<form>
						<div class="cfD">
							<input class="userinput" type="text"  placeholder="输入关键字" value="{{$arr->a}}" id="sou"/>
							<input type="button" class="userbtn" id="button" value="搜索" >
							<a class="addA addA1" href="{{url('Type/type')}}">添加分类</a>
						</div>
					</form>
				</div>
				<!-- user 表格 显示 -->
				<div class="conShow">
					<table border="1" cellspacing="0" cellpadding="0" id="ad">
						<tr>
							<td width="66px" class="tdColor tdC">序号</td>
							<td width="435px" class="tdColor">分类名称</td>
							<td width="400px" class="tdColor">父级分类</td>
							<td width="400px" class="tdColor">添加时间</td>
							<td width="130px" class="tdColor">操作</td>
						</tr>
						@foreach($arr as $v)
						<tr height="40px">
							<td>{{$v->type_id}}</td>
							<td>{{$v->type_name}}</td>
							<td>{{$v->pid_name}}</td>
							<td>{{date('Y-m-d H:i:s',$v->type_add_time)}}</td>
							<td>
							<a href="del_type?id={{$v->type_id}}">删除</a>
							</td>
						</tr>
						@endforeach
					</table>
					<div class="paging">{{$arr->render()}}</div>
				</div>
				<!-- user 表格 显示 end-->
			</div>
			<!-- user页面样式end -->
		</div>

	</div>


	<!-- 删除弹出框 -->
	<div class="banDel">
		<div class="delete">
			<div class="close">
				<a><img src="{{URL::asset('')}}public/style/img/shanchu.png" /></a>
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
//搜索
$('#button').click(function(){
	var zhi = $('#sou').val();
	var data={'zhi':zhi};
	var url="{{url('Type/lists')}}";
	$.post(url,data,function(msg){
		$(document).find('html').html(msg);
	});
});
</script>
</html>