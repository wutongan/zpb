<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>头部-有点</title>
    <link rel="stylesheet" type="text/css" href="{{URL::asset('')}}public/style/css/css.css" />
    <link rel="stylesheet" type="text/css" href="{{URL::asset('')}}public/style/css/manhuaDate.1.0.css" />
    <script type="text/javascript" src="{{URL::asset('')}}public/style/js/jquery.min.js"></script>
    <script type="text/javascript" src="{{URL::asset('')}}public/style/js/manhuaDate.1.0.js"></script>
    <script type="text/javascript" src="{{URL::asset('')}}public/style/js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript">
        $(function (){
            $("input.mh_date").manhuaDate({
                Event : "click",//可选
                Left : 0,//弹出时间停靠的左边位置
                Top : -16,//弹出时间停靠的顶部边位置
                fuhao : "-",//日期连接符默认为-
                isTime : false,//是否开启时间值默认为false
                beginY : 1949,//年份的开始默认为1949
                endY :2100//年份的结束默认为2049
            });
        });
    </script>
</head>
<body>
<div id="pageAll">
    <div class="pageTop">
        <div class="page">
            <img src="{{URL::asset('')}}public/style/img/coin02.png" /><span><a href="{{url('Index/right')}}">首页</a>&nbsp;-&nbsp;<a
                        href="{{url('Advert/advert')}}">广告管理</a>&nbsp;-</span>&nbsp;广告修改
        </div>
    </div>
    <!-- 上传广告页面样式 -->
    <div class="banneradd bor">
        <form action="{{url('Advert/up_update')}}" method="post" enctype="multipart/form-data" onsubmit="return su_submit()">
            <div class="baBody">
                <div class="bbD">
                    <input type="hidden" name="adv_id" value="{{$list->adv_id}}"/>
                    公司名称：<input type="text" class="input1"  name="firm_name" onblur="su_firm()" value="{{$list->firm_name}}"/>
                    <span id="show_firm"></span>
                </div>
                <div class="bbD">
                    上传图片：<input type="file" name="adv_img"/><input type="hidden" name="img" value="{{$list->adv_img}}"/>
                </div>
                <div class="bbD">
                    是否显示：
                            @if($list->adv_show ==1 )
                    <label><input type="radio" checked="checked"  name="adv_show" value="1"/>是</label> <label><input
                                type="radio" name="adv_show" value="0"/>否</label>
                            @else
                        <label><input type="radio" name="adv_show" value="1"/>是</label> <label><input
                                    type="radio" checked="checked" name="adv_show" value="0"/>否</label>
                            @endif
                </div>
                <div class="bbD">
                    <p class="bbDP">
                        <button class="btn_ok btn_yes" href="#">提交</button>
                        <a class="btn_ok btn_no" href="{{'advert'}}">取消</a>
                    </p>
                </div>
            </div>
        </form>
    </div>
    <!-- 上传广告页面样式end -->
</div>

</body>
</html>

<script>
    var flag=false;
    function su_firm(){
        var firm_name=$('.input1').val();
        $.get("{{'firm_name'}}",{firm_name:firm_name},function(msg){
            if(msg==1){
                document.getElementById('show_firm').innerHTML="<img src=\"{{URL::asset('')}}public/style/img/ok.png\" />";
                flag=true;
            }else{
                document.getElementById('show_firm').innerHTML="<font color='red'>&nbsp;&nbsp;公司名称不存在</font>";
                flag=false;
            }
        })
        return flag;
    }

    function su_submit(){
        if(su_firm()){
            return true;
        }else{
            return false;
        }
    }
</script>