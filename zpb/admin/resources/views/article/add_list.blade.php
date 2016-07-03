<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>管理员管理-文章展示</title>
<link rel="stylesheet" type="text/css" href="{{URL::asset('')}}public/style/css/css.css" />
<script type="text/javascript" src="{{URL::asset('')}}public/style/js/jquery.min.js"></script>
<!-- <script type="text/javascript" src="js/page.js" ></script> -->
</head>

<body>
	<div id="pageAll">
		<div class="pageTop">
			<div class="page">
                <img src="{{URL::asset('')}}public/style/img/coin02.png" /><span><a href="{{url('Index/right')}}">首页</a>&nbsp;-&nbsp;<a href="{{url('Article/article')}}">文章管理</a>&nbsp;-</span>&nbsp;添加文章
			</div>
		</div>

		<div class="page">
			<!-- user页面样式 -->
			<div class="connoisseur">
				<div class="conform">
					<form action="{{url('Article/article')}}" method="post">
						<input type="hidden" name="_token" value="{{ csrf_token() }}" />
						<div class="cfD">
							<input type="submit" class="userbtn" value="返回文章列表" />
						</div>
					</form>
				</div>
				<!-- user 表格 显示 -->
	<form action="{{url('Article/add_list')}}" method="post" onsubmit="return ck_all()">
	<input type="hidden" name="_token" value="{{ csrf_token() }}" />
				<div class="conShow">

                        <table border="1" cellspacing="0" cellpadding="0">
                            <tr>

                                <div class="bbD">
                                    &nbsp;&nbsp;&nbsp;&nbsp;文章标题：&nbsp;&nbsp;<input type="text" class="input3"  name="art_title" id="department" placeholder="请输入文章标题" onblur="ck_title()"/>&nbsp;&nbsp;<span id="s_title"></span>
                                </div>
                                <div class="bbD">
                                    &nbsp;&nbsp;&nbsp;&nbsp;文章作者：&nbsp;&nbsp;<input type="text" class="input3"   name="art_author" id="department" placeholder="请输入文章作者" onblur="ck_author()"/>&nbsp;&nbsp;<span id="s_author"></span>
                                </div>
                                <div class="bbD">
                                    &nbsp;&nbsp;&nbsp;&nbsp;文章描述:<div class="btext2">
                                    <textarea class="text2" name="art_desc" id="department" onblur="ck_desc()"></textarea>&nbsp;&nbsp;<span id="s_desc"></span>
                                    </div>
                                </div>
                                <div class="bbD">
                                    <p class="bbDP">
                                        <input class="btn_ok btn_yes" type="submit" value="添加" />
                                        <input class="btn_ok btn_no" type="reset" value="取消" />
                                    </p>
                                </div>
                        </table>
                    </div>

			</form>
				<!-- user 表格 显示 end-->
			</div>
			<!-- user页面样式end -->
		</div>

	</div>

</body>

<script type="text/javascript">
//验证非空
 function  ck_title(){
     var title=$('input[name=art_title]').val();
     if(title){
         document.getElementById('s_title').innerHTML="<font color='red'>√</font>";
         return true;
     }else{
         document.getElementById('s_title').innerHTML="<font color='red'>不能为空</font>";
         return false;
     }
 }

function  ck_author(){
    var author=$('input[name=art_author]').val();
    if(author){
        document.getElementById('s_author').innerHTML="<font color='red'>√</font>";
        return true;
    }else{
        document.getElementById('s_author').innerHTML="<font color='red'>不能为空</font>";
        return false;
    }
}


function  ck_desc(){
    var desc=$('textarea[name=art_desc]').val();
    if(desc){
        document.getElementById('s_desc').innerHTML="<font color='red'>√</font>";
        return true;
    }else{
        document.getElementById('s_desc').innerHTML="<font color='red'>不能为空</font>";
        return false;
    }
}

    function ck_all(){
        if(ck_title() && ck_author() && ck_desc()){
            return true;
        }else{
            return false;
        }
    }
</script>
</html>