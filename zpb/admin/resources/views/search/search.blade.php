<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>管理员管理-有点</title>
<link rel="stylesheet" type="text/css" href="{{URL::asset('')}}public/style/css/css.css" />
<link rel="stylesheet" type="text/css" href="{{URL::asset('')}}public/style/css/bootstrap.css" />
<script type="text/javascript" src="{{URL::asset('')}}public/style/js/jquery.min.js"></script>
<!-- <script type="text/javascript" src="js/page.js" ></script> -->
</head>
<style>
    li{
        list-style:none;
    }
</style>
<body>
	<div id="pageAll">
		<div class="pageTop">
			<div class="page">
                <img src="{{URL::asset('')}}public/style/img/coin02.png" /><span><a href="{{url('Index/right')}}">首页</a>&nbsp;-&nbsp;<a href="{{url('Search/search')}}">热词管理</a>&nbsp;-</span>&nbsp;热词列表
			</div>
		</div>

		<div class="page">
			<!-- user页面样式 -->
			<div class="connoisseur">
				<div class="conform">
						<div class="cfD">
							<input class="userinput" type="text" placeholder="输入关键字" value="{{$list->search}}" />
							<button class="userbtn">搜索</button>
						</div>
				</div>
				<!-- user 表格 显示 -->
				<div class="conShow">
					<table border="1" cellspacing="0" cellpadding="0">
						<tr>
							<td width="66px" class="tdColor tdC">序号</td>
							<td width="1435px" class="tdColor">关键字</td>
							<td width="900px" class="tdColor">搜索次数</td>
							<td width="230px" class="tdColor">操作</td>
						</tr>
                        @foreach ($list as $v)
						<tr height="40px" id="{{$v->sea_id}}">
							<td>{{$v->sea_id}}</td>
							<td>{{$v->sea_name}}</td>
							<td>{{$v->sea_num}}</td>
							<td>
								<a href="{{url('Search/update')}}?id={{$v->sea_id}}" class="aColor">修改</a>&nbsp;&nbsp;&nbsp;&nbsp;
								<a href="javascript:;" id="{{$v->sea_id}}" class="aColor1">删除</a>&nbsp;&nbsp;&nbsp;&nbsp;
							</td>
						</tr>
                        @endforeach
					</table>
					<div class="paging"><?php echo $list->render();?></div>
				</div>
				<!-- user 表格 显示 end-->
			</div>
			<!-- user页面样式end -->
		</div>

	</div>

</body>

<script type="text/javascript">
// 搜索
$(".userbtn").click(function(){
    var userinput=$('.userinput').val();
    $.get("{{'search'}}",{userinput:userinput},function(msg){
       $(document).find('html').html(msg);
    })
});
// 搜索 end

//删除
$('.aColor1').click(function(){
    var last_id=$('tr').last().attr('id');  //tr最后一条id
    var id=$(this).attr('id');
    $.get("delete",{id:id,last_id:last_id},function(msg){
        if(msg==1){
            $('#'+id).remove();
        }
            /*var data=eval("("+msg+")");
            var str="";
            for(var i=0;i<data.length;i++){
                str+="<tr height='40px' id='"+data[i].sea_id+"'>";
                str+="<td>"+data[i].sea_id+"</td>";
                str+="<td>"+data[i].sea_name+"</td>";
                str+="<td>"+data[i].sea_num+"</td>";
                str+="<td>";
                str+="<a href=\"+{{url('Search/update')}}?id='"+data[i].sea_id+"' class='aColor'>修改</a>&nbsp;&nbsp;&nbsp;&nbsp;";
                str+="<a href=\"javascript:;\" id='"+data[i].sea_id+"' class='aColor1'>删除</a>&nbsp;&nbsp;&nbsp;&nbsp;";
                str+="</td>";
                str+="</tr>";
            }
        alert(str);return;
        $("#"+last_id).after(str);*/    })
})
</script>
</html>