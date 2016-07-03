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
            <img src="<?php echo e(URL::asset('')); ?>public/style/img/coin02.png" /><span><a href="<?php echo e(url('index/index')); ?>">首页</a>&nbsp;-</span>&nbsp;企业管理
        </div>
    </div>

    <div class="page">
        <!-- user页面样式 -->
        <div class="connoisseur">
            <div class="conform">
                <form>
                    <div class="cfD">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input class="addUser" type="text"  name="rec_title" id="rec_title" placeholder="输入标题" value="<?php echo e($re->a); ?>" />
                        <input class="button" type="button" id="button" value="搜索">
                    </div>
                </form>
            </div>
            <!-- user 表格 显示 -->
            <div class="conShow" id="list">
                <table border="1" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="60px" class="tdColor">序号</td>
                        <td width="100px" class="tdColor">职位性质</td>
                        <td width="100px" class="tdColor">标题</td>
                        <td width="100px" class="tdColor">学历要求</td>
                        <td width="100px" class="tdColor">经验要求</td>
                        <td width="150px" class="tdColor">薪资</td>
                        <td width="150px" class="tdColor">是否上线</td>
                        <td width="200px" class="tdColor">发布时间</td>
                        <td width="230px" class="tdColor">操作</td>
                    </tr>
                    <?php foreach($re as $val) { ?>
					<input type="hidden" id="m_id" name="m_id" value="<?php echo e($val->m_id); ?>"  />
                    <tr height="40px">
                        <td>
                            <?php echo $val->rec_id?>
                        </td>
                        <td><?php echo $val->rec_nature?></td>
                        <td><?php echo $val->rec_title?></td>
                        <td><?php echo $val->stu_name?></td>
                        <td><?php echo $val->suf_name?></td>
                        <td><?php echo $val->rec_moneymin?>--<?php echo $val->rec_moneymax?></td>
						<td>
						<?php if($val->sta_id==1){?>
							<font color="red">已下线</font>
						<?php }else{?>
							<font color="green">已上线</font>
						<?php }?>
						</td>
                        <td><?php echo date('Y-m-d H:i:s',$val->rec_time);?></td>
                        <td><a href="<?php echo e(url('Firm/recruit')); ?>?rec_id=<?=$val->rec_id?>" >查看</a></td>
                    </tr>
                    <?php }?>
                </table>
                <div class="paging">

                </div>

            </div>
            <!-- user 表格 显示 end-->
        </div>
        <!-- user页面样式end -->
    </div>

</div>
</body>
</html>
<script type="text/javascript">
$('#button').click(function(){
	var title = $('#rec_title').val();
	var id = $('#m_id').val();
	$.ajax({
		type:'post',
		url:"<?php echo e(url('Firm/ss')); ?>",
		data:'title='+title+'&id='+id,
		success:function(msg)
		{
			$(document).find('html').html(msg);
		}
	})
})
</script>