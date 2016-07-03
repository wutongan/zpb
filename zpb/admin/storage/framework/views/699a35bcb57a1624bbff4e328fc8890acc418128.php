<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>管理员管理-有点</title>
<link rel="stylesheet" type="text/css" href="<?php echo e(URL::asset('')); ?>public/style/css/css.css" />
<link rel="stylesheet" type="text/css" href="<?php echo e(URL::asset('')); ?>public/style/css/bootstrap.css" />
<script type="text/javascript" src="<?php echo e(URL::asset('')); ?>public/style/js/jquery.min.js"></script>
<!-- <script type="text/javascript" src="js/page.js" ></script> -->
</head>

<body>
	<div id="pageAll">
		<div class="pageTop">
			<div class="page">
                <img src="<?php echo e(URL::asset('')); ?>public/style/img/coin02.png" /><span><a href="<?php echo e(url('Index/right')); ?>">首页</a>&nbsp;-&nbsp;<a href="<?php echo e(url('Sort/sort')); ?>">文章管理</a>&nbsp;-</span>&nbsp;分类列表			</div>
		</div>

		<div class="page">
			<!-- user页面样式 -->
			<div class="connoisseur">
				<div class="conform">
					<form action="<?php echo e(url('Sort/add')); ?>" method="post">
						<div class="cfD">
							<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" />
							<input type="submit" class="userbtn" value="添加分类" />
						
						</div>
					</form>
				</div>
				<!-- user 表格 显示 -->
				<div class="conShow">
					<table border="1" cellspacing="0" cellpadding="0">
						<tr>
							<td width="66px" class="tdColor tdC">序号</td>
							<td width="1435px" class="tdColor">分类名称</td>
							<td width="900px" class="tdColor">添加时间</td>
							<td width="230px" class="tdColor">操作</td>
						</tr>
			<?php foreach($users as $k=>$v): ?>
						<tr height="40px">
							<td><?php echo e($v->sort_id); ?></td>
							<td>
							<span onclick="dianji(<?php echo e($v->sort_id); ?>)" id="td_<?php echo e($v->sort_id); ?>" ><?php echo e($v->sort_name); ?></span>
							<span id="span_<?php echo e($v->sort_id); ?>" style="display:none;" >
							<input type="text" name="sort_name" id="input_<?php echo e($v->sort_id); ?>" onblur="cuncun(<?php echo e($v->sort_id); ?>)" value="<?php echo e($v->sort_name); ?>" />
							</span>
							</td>
							<td><?php echo e($v->sort_add_time); ?></td>
							<td>
								<a href="<?php echo e(url('Sort/delt')); ?>?sort_id=<?php echo e($v->sort_id); ?>" class="aColor">删除</a>&nbsp;&nbsp;&nbsp;&nbsp;
							</td>
						</tr>
			<?php endforeach; ?>
					</table>
					<div class="paging"><?php echo e($users->render()); ?></div>
				</div>
				<!-- user 表格 显示 end-->
			</div>
			<!-- user页面样式end -->
		</div>
	</div>
</body>
</html>
<script>

	function cuncun(id)
	{
		var val=$('#input_'+id).val();
		if(val!="")
		{
			$.get("<?php echo e('up'); ?>",{id:id,val:val},function(e){
				if(e==1)
				{
					$('#td_'+id).html(val);
					$('#span_'+id).hide();
					$('#td_'+id).show(); 
				}
				else
				{
					$('#span_'+id).show();
					$('#td_'+id).hide(); 
				}
			})
		}
		else
		{
			alert('名称不为空');
		}
	}
	function dianji(id)
	{
		$('#span_'+id).show();
		$('#td_'+id).hide(); 
	}
</script>