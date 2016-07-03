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
                <img src="<?php echo e(URL::asset('')); ?>public/style/img/coin02.png" /><span><a href="<?php echo e(url('Index/right')); ?>">首页</a>&nbsp;-&nbsp;<a href="<?php echo e(url('Firm/liebiao')); ?>">企业管理</a>&nbsp;-</span>&nbsp;企业列表
			</div>
		</div>

		<div class="page">
			<!-- user页面样式 -->
			<div class="connoisseur">
				<div class="conform">
					<form>
						<div class="cfD">
							 认证状态：
							 <label><input type="radio" name="aaa" id="wsh" value="1" onclick="checkwsh()"/>&nbsp;未审核</label> &nbsp;&nbsp;&nbsp;&nbsp;
							 <label><input type="radio" name="aaa" id="yrz" value="2" onclick="checkyrz()"/>&nbsp;已认证</label>&nbsp;&nbsp; &nbsp;&nbsp;
							 <label><input type="radio" name="aaa" id="wtg" value="0" onclick="checkwtg()"/>&nbsp;未通过</label>&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<input class="addUser" type="text"  name="firm_name" id="firm_name" placeholder="输入公司名" />
							<input class="button" type="button" onclick="checksearch()" value="搜索">
						</div>
					</form>
				</div>
				<!-- user 表格 显示 -->
				<div class="conShow">
					<table border="1" cellspacing="0" cellpadding="0">
						<tr>
							<td width="60px" class="tdColor tdC">序号</td>
							<td width="150px" class="tdColor">公司名称</td>
							<td width="150px" class="tdColor">所属会员</td>
							<td width="200px" class="tdColor">公司LOGO</td>
							<td width="150px" class="tdColor">创建时间</td>
							<td width="75px" class="tdColor">认证状态</td>

							<td width="230px" class="tdColor">操作</td>
						</tr>
                        <?php foreach($posts as $val){?>
						<tr height="40px">
							<td>
                                <?php if($val->firm_lock==1){?>
                                <input type="checkbox" name="all" id="all" value="<?php echo $val->firm_id?>">
                                    <?php }?>
                                <?php echo $val->firm_id?>
                            </td>
							<td><?php echo $val->firm_name?></td>
							<td><?php echo $val->m_email?></td>
							<td><img src="../../<?php echo $val->firm_logo?>" width="100" height="100"/></td>
							<td><?php echo $val->m_add_time?></td>
							<td>
                                <?php if($val->firm_lock==0) { ?>
                                <?php echo "<font color='red'>未通过</font>"?>
                                <?php }else if($val->firm_lock==1){?>
                                <?php echo "<font color='black'>未审核</font>"?>
                                <?php }else{ ?>
                                <?php echo "<font color='green'>已认证</font>"?>
                                <?php }?>
                            </td>
							<td>
							<a href="<?php echo e(url('Firm/show')); ?>?m_id=<?php echo $val->m_id?>" class="aColor">职位列表</a>&nbsp;&nbsp;&nbsp;&nbsp;
							<a href="<?php echo e(url('Firm/firm')); ?>?m_id=<?php echo $val->m_id?>" class="aColor">查看</a>&nbsp;&nbsp;&nbsp;&nbsp;
							<a href="" class="aColor">日志</a>
							</td>
						</tr>
                        <?php }?>
					</table>
					<div class="cfD">
						<button class="button" onclick="checkrz()">通过</button>
						<button class="button" onclick="checkfj()">不通过</button>
                    </div>
					<div class="paging" style="">
                        <?php echo $posts->render(); ?>

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
    function checkrz(){
//        alert(1);
        var all = document.getElementsByName('all');
        var str="";
        for(var i=0;i<all.length;i++){
            if(all[i].checked==true){
                str+=','+all[i].value;
            }
        }
        var f_id=str.substr(1);
//        alert(f_id);
        //创建ajax
        var ajax=new XMLHttpRequest();
        //打开
        ajax.open('get',"<?php echo e(url('Firm/rz')); ?>?f_id="+f_id);
        //发送
        ajax.send(null);
        //设置回调函数，接收返回值
        ajax.onreadystatechange=function(){
            if(ajax.readyState==4&&ajax.status==200){
                if(ajax.responseText==0){
                    alert("请选择一条数据");
                }else{
                    location.href="<?php echo e(url('Firm/liebiao')); ?>";
                }
            }
        }
    }
    function checkfj(){
//        alert(1);
        var all = document.getElementsByName('all');
        var str="";
        for(var i=0;i<all.length;i++){
            if(all[i].checked==true){
                str+=','+all[i].value;
            }
        }
        var f_id=str.substr(1);
//        alert(f_id);
        //创建ajax
        var ajax=new XMLHttpRequest();
        //打开
        ajax.open('get',"<?php echo e(url('Firm/fj')); ?>?f_id="+f_id);
        //发送
        ajax.send(null);
        //设置回调函数，接收返回值
        ajax.onreadystatechange=function(){
            if(ajax.readyState==4&&ajax.status==200){
                if(ajax.responseText==0){
                    alert("请选择一条数据");
                }else{
                    location.href="<?php echo e(url('Firm/liebiao')); ?>";
                }
            }
        }
    }
function checksearch(){
    var firm_name = document.getElementById('firm_name').value;
//    alert(firm_name);
    var ajax=new XMLHttpRequest();
    //打开
    ajax.open('get',"<?php echo e(url('Firm/search')); ?>?firm_name="+firm_name);
    //发送
    ajax.send(null);
    //设置回调函数，接收返回值
    ajax.onreadystatechange=function(){
        if(ajax.readyState==4&&ajax.status==200){

                $(document).find('html').html(ajax.responseText);
        }
    }
}
    function checkwsh(){
        var wsh = document.getElementById('wsh').value;
//        alert(wsh);
        var ajax=new XMLHttpRequest();
        //打开
        ajax.open('get',"<?php echo e(url('Firm/wsh')); ?>?wsh="+wsh);
        //发送
        ajax.send(null);
        //设置回调函数，接收返回值
        ajax.onreadystatechange=function(){
            if(ajax.readyState==4&&ajax.status==200){
                $(document).find('html').html(ajax.responseText);
                $('#wsh').attr('checked','true');
            }
        }
    }
    function checkyrz(){
        var yrz = document.getElementById('yrz').value;
        var ajax=new XMLHttpRequest();
        //打开
        ajax.open('get',"<?php echo e(url('Firm/yrz')); ?>?yrz="+yrz);
        //发送
        ajax.send(null);
        //设置回调函数，接收返回值
        ajax.onreadystatechange=function(){
            if(ajax.readyState==4&&ajax.status==200){
                $(document).find('html').html(ajax.responseText);
                $('#yrz').attr('checked','true');
            }
        }
    }
    function checkwtg(){
        var wtg = document.getElementById('wtg').value;
        var ajax=new XMLHttpRequest();
        //打开
        ajax.open('get',"<?php echo e(url('Firm/wtg')); ?>?wtg="+wtg);
        //发送
        ajax.send(null);
        //设置回调函数，接收返回值
        ajax.onreadystatechange=function(){
            if(ajax.readyState==4&&ajax.status==200){
                $(document).find('html').html(ajax.responseText);
                $('#wtg').attr('checked','true');
            }
        }
    }
</script>