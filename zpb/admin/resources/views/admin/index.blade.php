<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>首页-招聘吧</title>
</head>
<frameset rows="100,*" cols="*" scrolling="No" framespacing="0" frameborder="no" border="0"> 
<!-- 引用头部 -->
<frame src="{{url('Index/head')}}" name="head" id="mainFrame" title="mainFrame">
<!-- 引用左边和主体部分 --> 
<frameset rows="100*" cols="220,*" scrolling="No" framespacing="0" frameborder="no" border="0">
<frame src="{{url('Index/left')}}" name="left" id="mainFrame" title="mainFrame">
<frame src="{{url('Index/right')}}" name="right" scrolling="yes" noresize="noresize" id="rightFrame" title="rightFrame">
</frameset>
</frameset>
</html>