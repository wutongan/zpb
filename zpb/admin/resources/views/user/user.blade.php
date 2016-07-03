<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>管理员管理-有点</title>
<link rel="stylesheet" type="text/css" href="{{URL::asset('')}}public/style/css/css.css" />
<link rel="stylesheet" type="text/css" href="{{URL::asset('')}}public/style/css/css.css" />
<script type="text/javascript" src="{{URL::asset('')}}public/style/js/jquery.min.js"></script>
<!-- <script type="text/javascript" src="js/page.js" ></script> -->
</head>

<body>
	<div id="pageAll">
		<div class="pageTop">
			<div class="page">
                <img src="{{URL::asset('')}}public/style/img/coin02.png" /><span><a href="{{url('Index/right')}}">首页</a>&nbsp;-&nbsp;<a href="{{url('User/user')}}">管理员管理</a>&nbsp;-</span>&nbsp;管理员列表
			</div>
		</div>

		<div class="page">
			<!-- user页面样式 -->
			<div class="connoisseur">
				<!-- user 表格 显示 -->
				<div class="conShow">
					<table border="1" cellspacing="0" cellpadding="0">
						<tr>
							<td width="66px" class="tdColor tdC">序号</td>
							<td width="260px" class="tdColor">用户名</td>
							<td width="260px" class="tdColor">添加时间</td>
							<td width="260px" class="tdColor">最后一次登录时间</td>
							<td width="260px" class="tdColor">最后一次登录IP</td>
						</tr>
						@foreach($arr as $k=>$v)
						<tr height="40px">
							<td>{{$v->adm_id}}</td>
							<td>{{$v->adm_user}}</td>
							<td>{{date('Y-m-d H:i:s',$v->adm_add_time)}}</td>
							<td>{{date('Y-m-d H:i:s',$v->adm_last_time)}}</td>
							<td>{{$v->adm_last_ip}}</td>
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
</body>
</html>