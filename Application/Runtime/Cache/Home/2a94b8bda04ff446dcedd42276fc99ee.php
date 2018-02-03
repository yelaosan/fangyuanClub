<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>方圆俱羽毛球俱乐部</title>
<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
    <script  type="text/javascript" src="/sae/fangyuanclub/1/Public/js/Home/zepto.js"></script>
    <link href="/sae/fangyuanclub/1/Public/css/Home/common.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="popWindow hide">
	<h3>温馨提示<span>关闭</span></h3>
    <div class="content"><br ><br ><br ><br >报名成功~</div>
</div>
<div class="webcar">
<div  class="bgstyle indexnotice p_re">  
    时间：<?php echo (date('Y-m-d H:i:s',$data["over_time"])); ?>(截止)<br>
    地点：<?php echo ($data["place"]); ?><br>
    人数：<span><?php echo (intval($data["ed"]["num"])); ?></span>/<?php echo ($data["limit"]["num"]); ?><br>
    活动：<?php echo ($data["remark"]); ?><br>
</div>
<div  class="bgstyle indexnotice p_re">  
    <div id="playerlist">
	<?php if(is_array($data["list"])): $i = 0; $__LIST__ = $data["list"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; echo ($vo["nickname"]); ?>        <?php echo ($vo["num"]); ?>人<br><?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
</div>
</div>
    
<form action="#" method="post" id="submit">
 <div class="imagetext clear martop10">
  <div class="texttitle radius5">
	<ul>
	  <li class="this"><a href="#evaluation" title="" >个人信息</a></li>
	</ul>
  </div>
  <div class="bgstyle textcontent evaluation">
	  <div class="evalinput clearfix clear">
		<dl>
		  <dt>姓名：</dt>
		  <dd>
			<input name="nc" type="text" class="a1 radius5" maxlength="10" placeholder="请输入您的姓名~"/>
		  </dd>
		</dl>
	  </div>
  </div>
</div>
<div class="bgstyle buyadd">
	  <input class="buying" type="submit" value="马上报名" />
	  <input class="buying" type="submit" value="取消报名" />
</div>
</form>

    
    

<script type="text/javascript">
$(function(){
	var oBtn = $('.buying');
	var popWindow = $('.popWindow');
	var oClose = $('.popWindow h3 span');
	var browserWidth = $(window).width();
	var browserHeight = $(window).height();
	var browserScrollTop = $(window).scrollTop();
	var browserScrollLeft = $(window).scrollLeft();
	var positionLeft = browserWidth/2-300/2+browserScrollLeft;
	var positionTop = browserHeight/2-300/2+browserScrollTop;
	var oMask = '<div class="mask"></div>'
	var maskWidth = $('body').width();
	var maskHeight = $('body').height();	
	var un,xhr,num=1; 
	function func(){
		un = $.trim($('.a1').val());
		if(un==''){
			return false;
		}
		xhr = createXHR();
        xhr.open('POST', '/sae/fangyuanclub/1/index.php/Home/Index/insert/', true);
        xhr.onreadystatechange = function ()
        {
            if (this.readyState == 4)
            {
                if (this.responseText)
                {
                    $('#playerlist').append(un+"<br />");
                    $('.content').html('<br><br><br><br>操作成功!'+this.responseText);
                }
                else {
                    $('.content').html('<br><br><br><br>操作失败，请重试~'+this.responseText);
                }
				popWindow.show().animate({'left' : positionLeft + 'px', 'top' : positionTop + 'px'}, 500);
				$('body').append(oMask);
				$('.mask').width(maskWidth).height(maskHeight);
            }
        }
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.send('username=' + un + '&num=' + num);
	}
	$('.buying').eq(0).click(function(){
		num=1;
		func();
		return false;
	});
	$('.buying').eq(1).click(function(){
		num=0;
		func();
		return false;
	});
    function createXHR()
    {
        if (window.XMLHttpRequest) {
            xhr = new XMLHttpRequest();
        }
        else {
            xhr = new ActiveXObject('Microsoft.XMLHTTP');
        }
        return xhr;
    }
	oClose.click(function(){
		popWindow.hide();
		$('.mask').remove();
	});
});	
</script>
</body>
</html>