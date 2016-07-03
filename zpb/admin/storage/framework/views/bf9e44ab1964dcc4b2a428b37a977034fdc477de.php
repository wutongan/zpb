<html>
<meta charset="utf-8">
<head>
	<title>投票管理</title>
</head>
<body>
<form action="<?php echo e(url('toupiao/index')); ?>" method="post">
	<table>
		<tr>
			<td>投票信息</td>
			<td><input type="text" name="message" id=""></td>
		</tr>
		<tr>
			<td>开始时间</td>
			<td><input type="text" name="start_time" id=""></td>
		</tr>
		<tr>
			<td>结束时间</td>
			<td><input type="text" name="end_time" id=""></td>
		</tr>
		<tr>
			<td>投票类型</td>
			<td>
				<input type="radio" name="stat" value="Y">单选
				<input type="radio" name="stat" value="N">多选
			</td>
		</tr>
		<tr>
			<td>投票选项</td>
			<td>
				<p><a href="javascript:;" onclick="jiayi(this)">+</a><input type="text" name="xuan[]" id=""></p>
				
			</td>
		</tr>
		<tr>
			<td><input type="submit" value="提交"></td>
			<td><input type="reset" value="重置"></td>
		</tr>


	</table>
</form>

</body>
<script type="text/javascript" src="<?php echo e(URL::asset('js/jquery.js')); ?>"></script>
<script type="text/javascript">
function jiayi(ts)
{
	var a = $(ts).html();
	if(a=='+')
	{
		var obj = $(ts).parent().clone();
		obj.find('a').html('-');
		$(ts).parent().parent().append(obj);
	}
	else
	{
		$(ts).parent().remove();
	}
	
}
</script>
</html>