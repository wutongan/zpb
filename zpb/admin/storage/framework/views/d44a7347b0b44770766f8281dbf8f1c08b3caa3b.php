<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>Document</title>
</head>
<body>
	
	<table>
		<tr>
			<th>序号</th>
			<th>名称</th>
			<th>url</th>
			<th>内容</th>
		</tr>

		<?php foreach($data as $v): ?>
		<tr>
			<td><input type="text" tid='<?php echo e($v->id); ?>' name="sort" value="<?php echo e($v->sort); ?>" onblur="cuncun(this)" /></td>
			<td><input type="text" tid='<?php echo e($v->id); ?>' name="name" value="<?php echo e($v->name); ?>" onblur="cuncun(this)" /></td>
			<td><input type="text" tid='<?php echo e($v->id); ?>' name="url" value="<?php echo e($v->url); ?>" onblur="cuncun(this)" /></td>
			<td><input type="text" tid='<?php echo e($v->id); ?>' name="content" value="<?php echo e($v->content); ?>" onblur="cuncun(this)" /></td>
		</tr>
		<?php endforeach; ?>
		
	</table>
	<form action="<?php echo e(url('admin/add')); ?>" method="post" name="form">
		<table>
	
		<tr>
			<td>
				<input type="button" value="+" id='bt'/>
			</td>
		</tr>
	
		</table>
	<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
	<input type="submit" value="保存" />
	</form>

</body>
<script type="text/javascript" src='../../public/js/jquery.js'></script>
<script type="text/javascript">
function cuncun(ts)
{
	var id = $(ts).attr('tid');
	var name = $(ts).attr('name');
	var val = $(ts).val();
	$.get("<?php echo e(url('admin/update')); ?>",{id:id,name:name,val:val});
}
$('#bt').click(function(){
	str = "<tr>";
	str += "<td><input type='button' value='-' onclick='jianjian(this)'/><input type='text' name='sort[]' /></td>";
	str += "<td><input type='text' name='name[]'  /></td>";
	str += "<td><input type='text' name='url[]' /></td>";
	str += "<td><input type='text' name='content[]'/></td>";
	str += "</tr>";
	$(this).parent().parent().parent().append(str);
});

function jianjian(ts)
{
	$(ts).parent().parent().remove();
}

</script>
</html>