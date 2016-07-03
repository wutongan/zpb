<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>管理员管理-文章展示</title>
<link rel="stylesheet" type="text/css" href="{{URL::asset('')}}public/style/css/css.css" />
<link rel="stylesheet" type="text/css" href="{{URL::asset('')}}public/style/css/bootstrap.css" />
<script type="text/javascript" src="{{URL::asset('')}}public/style/js/jquery.min.js"></script>
<!-- <script type="text/javascript" src="js/page.js" ></script> -->
</head>

<body>
	<div id="pageAll">
		<div class="pageTop">
			<div class="page">
                <img src="{{URL::asset('')}}public/style/img/coin02.png" /><span><a href="{{url('Index/right')}}">首页</a>&nbsp;-&nbsp;<a href="{{url('Article/article')}}">文章管理</a>&nbsp;-</span>&nbsp;文章列表
			</div>
		</div>

		<div class="page">
			<!-- user页面样式 -->
			<div class="connoisseur">
				<div class="conform">
					<form action="{{url('Article/add')}}" method="post">
						<input type="hidden" name="_token" value="{{ csrf_token() }}" />
						<div class="cfD">
							<input type="submit" class="userbtn" value="添加文章" />
						</div>
					</form>
				</div>
				<!-- user 表格 显示 -->
				<div class="conShow">
					<table border="1" cellspacing="0" cellpadding="0">
						<tr>
							<td width="66px" class="tdColor tdC">序号</td>
							<td width="435px" class="tdColor">文章标题</td>
							<td width="650px" class="tdColor">文章描述</td>
							<td width="400px" class="tdColor">添加时间</td>
							<td width="400px" class="tdColor">文章作者</td>
							<td width="130px" class="tdColor">操作</td>
						</tr>
					@foreach($users as $k=>$v)
						<tr height="40px">
							<td>{{$v->art_id}}</td>
							<td>{{$v->art_title}}</td>
							<td>{{$v->art_desc}}</td>
							<td>{{$v->art_add_time}}</td>
							<td>{{$v->art_author}}</td>
							<td> <a href="{{url('Article/delt')}}?art_id={{$v->art_id}}" class="ok yes">删除</a>
								</td>
						</tr>
					@endforeach
					</table>
					<div class="paging">{{$users->render()}}</div>
				</div>
				<!-- user 表格 显示 end-->
			</div>
			<!-- user页面样式end -->
		</div>
	</div>
</body>
</html>