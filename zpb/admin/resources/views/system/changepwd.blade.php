<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>修改密码-有点</title>
<link rel="stylesheet" type="text/css" href="{{URL::asset('')}}public/style/css/css.css" />
<script type="text/javascript" src="{{URL::asset('')}}public/style/js/jquery.min.js"></script>
</head>
<body>
	<div id="pageAll">
		<div class="pageTop">
			<div class="page">
				<img src="{{URL::asset('')}}public/style/img/coin02.png" /><span><a href="{{url('index/index')}}">首页</a>&nbsp;-&nbsp;<a
					href="{{url('System/changepwd')}}">系统管理</a>&nbsp;-</span>&nbsp;修改密码
			</div>
		</div>
		<div class="page ">
			<!-- 修改密码页面样式 -->
			<div class="bacen">
				<div class="bbD">
					<input type="hidden" id="id" value="{{$arr->adm_id}}" >
				</div>
				<div class="bbD">管理员用户名：&nbsp;&nbsp;&nbsp;&nbsp;{{$arr->adm_user}}
				</div>
				<div class="bbD">
					&nbsp;&nbsp;&nbsp;&nbsp;输入旧密码：<input type="password" class="input3"
						onblur="checkpwd1()" id="pwd1" /> <img class="imga"
						src="{{URL::asset('')}}public/style/img/ok.png" /><img class="imgb" src="{{URL::asset('')}}public/style/img/no.png" />
				</div>
				<div class="bbD">
					&nbsp;&nbsp;&nbsp;&nbsp;输入新密码：<input type="password" class="input3"
						onblur="checkpwd2()" id="pwd2" /> <img class="imga"
						src="{{URL::asset('')}}public/style/img/ok.png" /><img class="imgb" src="{{URL::asset('')}}public/style/img/no.png" />
				</div>
				<div class="bbD">
					再次确认密码：<input type="password" class="input3" onblur="checkpwd3()"
						id="pwd3" /> <img class="imga" src="{{URL::asset('')}}public/style/img/ok.png" /><img
						class="imgb" src="{{URL::asset('')}}public/style/img/no.png" />
				</div>
				<div class="bbD">
					<p class="bbDP">
						<input type="button" class="btn_ok btn_yes" value="提交">
						<a class="btn_ok btn_no" href="#">取消</a>
					</p>
				</div>
			</div>

			<!-- 修改密码页面样式end -->
		</div>
	</div>
</body>
<script type="text/javascript">
sgin1=1;
sgin2=1;
sgin3=1;
function checkpwd1(){
var user = document.getElementById('pwd1').value.trim();
 if (user.length >= 1 && user.length <= 12) {
  var id = $('#id').val();
  var pwd = $('#pwd1').val();
  $.ajax({
	  type:'post',
	  url:"{{url('System/getpwd')}}",
	  data:'id='+id+'&pwd='+pwd,
	  success:function(e)
	  {
		  if(e==1)
		  {
			$("#pwd1").parent().find(".imga").show();
			$("#pwd1").parent().find(".imgb").hide(); 
			sgin1=0;
		  }
		  else
		  {
			$("#pwd1").parent().find(".imgb").show();
			$("#pwd1").parent().find(".imga").hide();
			sgin1=1;
		  }
	  }
  })
 }else{
	 $("#pwd1").parent().find(".imga").hide();
	 $("#pwd1").parent().find(".imgb").show();
	 sgin1=1;
 };
}
function checkpwd2(){
var user = document.getElementById('pwd2').value.trim();
 if (user.length >= 1 && user.length <= 12) {
  $("#pwd2").parent().find(".imga").show();
  $("#pwd2").parent().find(".imgb").hide();
  sgin2=0;
 }else{
  $("#pwd2").parent().find(".imgb").show();
  $("#pwd2").parent().find(".imga").hide();
  sgin2=1;
 };
}
function checkpwd3(){
var user = document.getElementById('pwd3').value.trim();
var pwd = document.getElementById('pwd2').value.trim();
 if (user.length >= 1 && user.length <= 12 && user == pwd) {
  $("#pwd3").parent().find(".imga").show();
  $("#pwd3").parent().find(".imgb").hide();
  sgin3=0;
 }else{
   $("#pwd3").parent().find(".imgb").show();
   $("#pwd3").parent().find(".imga").hide();
  sgin3=1;
 };
}
$('.btn_yes').click(function(){
	if(sgin1!=1&&sgin2!=1&&sgin3!=1)
	{
		var id = $('#id').val();
		var pwd = $('#pwd2').val();
		$.ajax({
			type:'post',
			url:"{{url('System/pwd')}}",
			data:'id='+id+'&pwd='+pwd,
			success:function(e)
			{
				if(e==1)
				{
					alert('密码重置成功');
				}
				else
				{
					alert('密码重置失败');
				}
			}
		})
	}
})
</script>
</html>