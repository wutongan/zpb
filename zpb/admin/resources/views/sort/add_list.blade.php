<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>管理员管理-文章展示</title>
<link rel="stylesheet" type="text/css" href="{{URL::asset('')}}public/style/css/css.css" />
<script type="text/javascript" src="{{URL::asset('')}}public/style/js/jquery.min.js"></script>
<!-- <script type="text/javascript" src="js/page.js" ></script> -->
</head>

<body>
	<div id="pageAll">
		<div class="pageTop">
			<div class="page">

                <img src="{{URL::asset('')}}public/style/img/coin02.png" /><span><a href="{{url('Index/right')}}">首页</a>&nbsp;-&nbsp;<a href="{{url('Sort/sort')}}">文章管理</a>&nbsp;-</span>&nbsp;添加分类
			</div>
		</div>

		<div class="page">
			<!-- user页面样式 -->
			<div class="connoisseur">
				<div class="conform">
					<form action="{{url('Sort/sort')}}" method="post">
						<input type="hidden" name="_token" value="{{ csrf_token() }}" />
						<div class="cfD">
							<input type="submit" class="userbtn" value="返回分类列表" />
						</div>
					</form>
				</div>
				<!-- user 表格 显示 -->
	<form action="{{url('Sort/add_list')}}" method="post">
	<input type="hidden" name="_token" value="{{ csrf_token() }}" />
				<div class="conShow">
		<div class="bacen">
					<table border="1" cellspacing="0" cellpadding="0">
                            <tr>

                                <div class="bbD">
					&nbsp;&nbsp;&nbsp;&nbsp;分类名称：<input type="text" class="input3" name="sort_name" id="" />
								</div>
                                <div class="bbD">
					&nbsp;&nbsp;&nbsp;&nbsp;分类名称：<select class="input3" name="sort_id" id="">
										<option value="0">顶级分类</option>

										<?php
										 foreach ($data as $key=>$v) {
										?>
										<option value="{{$v->sort_id}}">{{$v->sort_name}}</option>
									@foreach($v->demo as $k=>$val)
									<option value="{{$val->sort_id}}">&nbsp; &nbsp;|--{{$val->sort_name}}</option>		
									@endforeach
									<?php
									}
									?>
									</select>
							</div>
                            <div class="bbD">
					<p class="bbDP">
						<input class="btn_ok btn_yes" type="submit" value="添加" />
						<input class="btn_ok btn_no" type="reset" value="取消" />
					</p>
				</div>
					</table>
</div>
				</div>
			</form>
				<!-- user 表格 显示 end-->
			</div>
			<!-- user页面样式end -->
		</div>

	</div>

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