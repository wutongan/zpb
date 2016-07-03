<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>表单</title>
</head>
<body>
	<center>
		<form action="<?php echo e(url('zhoukao2/index')); ?>" method="post">
			<table>
				<tr>
					<td>登陆邮箱:</td>
					<td><input type="text" name="email" id="" /></td>
				</tr>
				<tr>
					<td>登陆密码:</td>
					<td><input type="password" name="password" id="" /></td>
				</tr>
				<tr>
					<td>确认密码:</td>
					<td><input type="password" name="repwd" id="" /></td>
				</tr>
				<tr>
					<td>昵称:</td>
					<td><input type="text" name="name" id="" /></td>
				</tr>
				<tr>
					<td>性别:</td>
					<td>
						<input type="radio" name="sex" id="" value="男" />男
						<input type="radio" name="sex" id="" value="女" />女
					</td>
				</tr>
				<tr>
					<td>地区:</td>
					<td>
						<select name="sheng" id="sheng">
							<option value="">请选择</option>
							<?php foreach($region as $v): ?>
								<option value="<?php echo e($v->region_id); ?>"><?php echo e($v->region_name); ?></option>
							<?php endforeach; ?>
						</select>
						<select name="shi" id="shi">
							<option value="">请选择</option>
						</select>
						<select name="qu" id="qu">
							<option value="">请选择</option>
						</select>
					</td>
				</tr>
				<tr>
					<td><input type="submit" value="注册" /></td>
					<td><input type="reset" value="重置" /></td>
				</tr>
			</table>
		</form>
	</center>
</body>
<script type="text/javascript" src="<?php echo e(URL::asset('js/jquery.js')); ?>"></script>
<script type="text/javascript">
	$('#sheng').change(function(){
		var sheng = $('#sheng').val();
		$.get("<?php echo e(url('zhoukao2/region')); ?>",{sheng:sheng},function(msg){
			$('#shi').empty();
			for(var i=0;i<msg.length;i++)
			{
				var option = $("<option>").text(msg[i].region_name).val(msg[i].region_id);
    			$('#shi').append(option);
			}
		},'json');
	});

	$('#shi').change(function(){
		var sheng = $('#shi').val();
		$.get("<?php echo e(url('zhoukao2/region')); ?>",{sheng:sheng},function(msg){
			$('#qu').empty();
			for(var i=0;i<msg.length;i++)
			{
				var option = $("<option>").text(msg[i].region_name).val(msg[i].region_id);
    			$('#qu').append(option);
			}
		},'json');
	});

</script>
</html>