<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>个人管理-有点</title>
<link rel="stylesheet" type="text/css" href="{{URL::asset('')}}public/style/css/css.css" />
<link rel="stylesheet" type="text/css" href="{{URL::asset('')}}public/style/css/manhuaDate.1.0.css">
<link rel="stylesheet" type="text/css" href="{{URL::asset('')}}public/style/css/bootstrap.css">
	<script type="text/javascript" src="{{URL::asset('')}}public/style/js/jquery.min.js"></script>
	<script type="text/javascript" src="{{URL::asset('')}}public/style/js/manhuaDate.1.0.js"></script>
	<script type="text/javascript" src="{{URL::asset('')}}public/style/js/jquery-1.7.2.min.js"></script>
</head>

<body>
	<div id="pageAll">
		<div class="pageTop">
			<div class="page">
                <img src="{{URL::asset('')}}public/style/img/coin02.png" /><span><a href="{{url('Index/right')}}">首页</a>&nbsp;-&nbsp;<a href="{{url('Preson/preson')}}">个人管理</a>&nbsp;-</span>&nbsp;个人信息
			</div>
		</div>

		<div class="page">
			<!-- vip页面样式 -->
			<div class="vip">
				<div class="conform">
					<form>
						<div class="cfD">
							<input class="addUser" type="text" placeholder="输入用户名/手机号/Email" value="{{$users->a}}" />
							<input type="button" class="button" value="搜索">							 
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
							<td width="170px" class="tdColor">注册时间</td>
							<td width="270px" class="tdColor">头像</td>
							<td width="230px" class="tdColor">操作</td>
						</tr>
						@foreach($users as $k=>$v)
						<tr>
							<td>{{$v->m_id}}</td>
							<td>{{$v->m_user}}</td>
							<td>{{$v->m_email}}</td>
							<td>{{$v->m_phone}}</td>
							<td>{{$v->m_add_time}}</td>
							<td>
								<img src="{{$v->pre_head}}">
							</td>
							<td>
								<a href="resume_list?id={{$v->m_id}}" class="aColor">查看简历</a>&nbsp;&nbsp;&nbsp;&nbsp;
								<a href="see?id={{$v->m_id}}" class="aColor">查看信息</a>&nbsp;&nbsp;&nbsp;&nbsp;
							</td>
						</tr>
						@endforeach
					</table>
					<div class="paging">{{$users->render()}}</div>
				</div>
				<!-- vip 表格 显示 end-->
			</div>
			<!-- vip页面样式end -->
		</div>
	</div>
</body>
</html>
<script>
$('.button').click(function(){
	var abc = $('.addUser').val();
	$.ajax({
		type:'post',
		url:"{{url('Preson/preson')}}",
		data:'abc='+abc,
		success:function(msg)
		{
			$(document).find("html").html(msg);
		}
	})
})
</script>