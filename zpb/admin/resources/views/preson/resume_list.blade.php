<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>会员编辑-有点</title>
<link rel="stylesheet" type="text/css" href="{{URL::asset('')}}public/style/css/css.css" />
<script type="text/javascript" src="{{URL::asset('')}}public/style/js/jquery.min.js"></script>
</head>
<body>
	<div id="pageAll">
		<div class="pageTop">
			<div class="page">
				<img src="{{URL::asset('')}}public/style/img/coin02.png" /><span><a href="#">首页</a>&nbsp;-</span>&nbsp;用户信息
			</div>
		</div>
		<div class="page ">
			<!-- 上传广告页面样式 -->
			<div class="banneradd bor">
				<div class="baTopNo">
					<span>简历信息</span>
				</div>
				<div class="baBody">
					<div class="bbD">
						2寸照片：
						<div class="vipHead">
							<img src="{{URL::asset('')}}public/style/img/userPICS.png" />
						</div>
					</div>
					<div class="bbD">
						账号：&nbsp;&nbsp;&nbsp;&nbsp;{{$arr->m_user}}
					</div>
					<div class="bbD">
						邮箱：&nbsp;&nbsp;&nbsp;&nbsp;{{$arr->m_email}}
					</div>
					<div class="bbD">
						电话：&nbsp;&nbsp;&nbsp;&nbsp;{{$arr->m_phone}}
						</div>
					<div class="bbD">
						所在城市：&nbsp;&nbsp;{{$arr->pre_address}}
					</div>
					<div class="bbD">
						学历：&nbsp;&nbsp;&nbsp;&nbsp;{{$arr->stu_name}}
					</div>
					<div class="bbD">
						工作经验：&nbsp;&nbsp;{{$arr->suf_name}}
					</div>
					<div class="bbD">
						<p class="bbDP">
							<a class="btn_ok btn_yes" href="{{url('Preson/preson')}}">返回</a>
							<a class="btn_ok btn_yes" href="{{url('Preson/preson')}}">通过</a>
							<a class="btn_ok btn_yes" href="{{url('Preson/preson')}}">不通过</a>
						</p>
					</div>
				</div>
			</div>

			<!-- 上传广告页面样式end -->
		</div>
	</div>
</body>
</html>