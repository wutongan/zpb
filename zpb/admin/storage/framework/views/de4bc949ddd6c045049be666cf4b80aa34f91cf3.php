<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>广告-有点</title>
<link rel="stylesheet" type="text/css" href="<?php echo e(URL::asset('')); ?>public/style/css/css.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo e(URL::asset('')); ?>public/style/css/bootstrap.css" />
<script type="text/javascript" src="<?php echo e(URL::asset('')); ?>public/style/js/jquery.min.js"></script>
<!-- <script type="text/javascript" src="js/page.js" ></script> -->
    <script>
        var no="<?php echo e(URL::asset('')); ?>public/style/img/no.png";
        var yes="<?php echo e(URL::asset('')); ?>public/style/img/ok.png";
        var adv_url="<?php echo e(url('Advert/adv_show')); ?>";
    </script>
</head>

<body>
	<div id="pageAll">
		<div class="pageTop">
			<div class="page">
				<img src="<?php echo e(URL::asset('')); ?>public/style/img/coin02.png" /><span><a href="<?php echo e(url('Index/right')); ?>">首页</a>&nbsp;-&nbsp;<a
					href="<?php echo e(url('Advert/advert')); ?>">广告管理</a>&nbsp;-</span>&nbsp;广告列表
			</div>
		</div>
		<div class="page">
			<!-- banner页面样式 -->
			<div class="banner">
				<div class="add">
					<a class="addA" href="<?php echo e(url('Advert/advertadd')); ?>">上传广告&nbsp;&nbsp;+</a>
				</div>
				<!-- banner 表格 显示 -->
				<div class="banShow">
					<table border="1" cellspacing="0" cellpadding="0">
						<tr>
							<td width="66px" class="tdColor tdC">序号</td>
							<td width="315px" class="tdColor">图片</td>
							<td width="308px" class="tdColor">公司名称</td>
							<td width="215px" class="tdColor">是否显示</td>
							<td width="180px" class="tdColor">添加时间</td>
							<td width="125px" class="tdColor">操作</td>
						</tr>
                        <?php foreach($list as $v): ?>
                        <tr>
							<td><?php echo e($v->adv_id); ?></td>
							<td><div style="height: 110px;">
                                    <a href="<?php echo e(URL::asset('')); ?>public/style/img/advert/<?php echo e($v->adv_img); ?>"><img src="<?php echo e(URL::asset('')); ?>public/style/img/advert/<?php echo e($v->adv_img); ?>" style="width: 290px; height: 100px; margin-top: 5px;"></a>
								</div></td>
							<td><?php echo e($v->firm_name); ?></td>
							<td>
                                <?php if($v->adv_show == 1): ?>
                                    <img src="<?php echo e(URL::asset('')); ?>public/style/img/ok.png" name="g_ud"/>
                                <?php else: ?>
                                    <img src="<?php echo e(URL::asset('')); ?>public/style/img/no.png" name="g_ud"/>
                                <?php endif; ?>
                            </td>
							<td><?php echo e(date('Y-m-d H:i:s',$v->adv_time)); ?></td>
							<td><a href="<?php echo e(url('Advert/update')); ?>?id=<?php echo e($v->adv_id); ?>" class="aColor">修改</a>&nbsp;&nbsp;&nbsp;&nbsp;
                                <a href="javascript:;" id="<?php echo e($v->adv_id); ?>" class="aColor1">删除</a>&nbsp;&nbsp;&nbsp;&nbsp;
                            </td>
						</tr>
                        <?php endforeach; ?>
					</table>
					<div class="paging"><?php echo $list->render(); ?></div>
				</div>
				<!-- banner 表格 显示 end-->
			</div>
			<!-- banner页面样式end -->
		</div>

	</div>

</body>

<script type="text/javascript">
    //删除
    $('.aColor1').click(function(){
        var id=$(this).attr('id');
        $.get('<?php echo e('delete'); ?>',{id:id},function(msg){
            if(msg==1){
                $('#'+id).remove();
            }
        })
    })

    //广告修改显示状态
    $(document).on('click','img[name=g_ud]',function(){
    var tis = $(this);
    var src = $(this).attr('src');
    var adv_id = $(this).parents('tr').find('td').eq(0).html();
    if(src == no){
        $.ajax({
            type : 'GET',
            url : adv_url,
            data : {
                adv_show: 1,
                adv_id : adv_id
            },
            success:function(e){
                if (e == 1) {
                    tis.attr('src',yes);
                }else{
                    alert('修改失败');
                }
            }
        })
    }else{
        $.ajax({
            type : 'GET',
            url : adv_url,
            data : {
                adv_show: 0,
                adv_id : adv_id
            },
            success:function(e){
                if (e == 1) {
                    tis.attr('src',no)
                }else{
                    alert('修改失败');
                }
            }
        })
    }
})
</script>
</html>