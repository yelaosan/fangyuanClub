<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>{%$title%}</title>
<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
       <link href="/sae/bibisai/1/Public/css/Admin/Game/style.css" rel="stylesheet" type="text/css" />
</head>
<body>  
<form action="../insert" method="post">
 <div class="imagetext martop10">
  <div class="texttitle radius5">
	<ul>
	  <li class="this">新增</li>
	</ul>
  </div>
  <div class="bgstyle textcontent evaluation">
	  <div class="evalinput">
	  	<dl>
		  <dt>类 型:</dt>
		  <dd>
			<input type="radio" name="name" checked="checked" value="temporary" hidden="true"/> 
			<input type="radio" name="title" checked="checked" value="临时活动"/> 临时活动
		  </dd>
		</dl>
		<dl>
		  <dt>开 始:</dt>
		  <dd>
			<input name="create_time" type="text" class="a1 radius5" maxlength="19" value="<?php echo date('Y-m-d H:i:s')?>"  />
		  </dd>
		</dl>
		<dl>
		  <dt>结 束:</dt>
		  <dd><input name="over_time" type="text" class="a1 radius5" maxlength="19" value="<?php echo date('Y-m')?>-" placeholder="格式如上" /></dd>
		</dl>
		<dl>
		  <dt>地 点:</dt>
		  <dd>
			<input name="place" type="text" value="体育馆" class="a1 radius5" maxlength="20" />
		  </dd>
		</dl>
		<dl>
		  <dt>限 制:</dt>
		  <dd>
			<select name="0" >
			  <option  value ="0" selected="true">总人数</option>
			  <?php $__FOR_START_17561__=1;$__FOR_END_17561__=101;for($i=$__FOR_START_17561__;$i < $__FOR_END_17561__;$i+=1){ ?><option value ="<?php echo ($i); ?>"><?php echo ($i); ?></option><?php } ?>
			</select>
			<?php if(is_array($role)): $i = 0; $__LIST__ = $role;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><select name="<?php echo ($vo["id"]); ?>">
			  <option value ="role<?php echo ($vo["num"]); ?>"  selected="true"><?php echo ($vo["name"]); ?></option>
			 <?php $__FOR_START_10720__=0;$__FOR_END_10720__=101;for($i=$__FOR_START_10720__;$i < $__FOR_END_10720__;$i+=1){ ?><option  value ="<?php echo ($i); ?>"><?php echo ($i); ?></option><?php } ?>
			</select><?php endforeach; endif; else: echo "" ;endif; ?>
		  </dd>
		</dl>
		
	  </div>
  </div>
</div>
<div class="bgstyle buyadd">
	  <input class="buying" type="submit" value="保存" />
</div>
</form>
</body>
</html>