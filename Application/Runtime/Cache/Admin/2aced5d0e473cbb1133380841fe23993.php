<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>{%$title%}</title>
<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
       <link href="/sae/bibisai/1/Public/css/Admin/Game/style.css" rel="stylesheet" type="text/css" />
</head>
<body>  
<form action="/sae/bibisai/1/index.php/Admin/Game/update" method="post">
 <div class="imagetext martop10">
  <div class="texttitle radius5">
	<ul>
	  <li class="this"><?php echo ($data["title"]); ?>-编辑</li>
	</ul>
  </div>
  <div class="bgstyle textcontent evaluation">
	  <div class="evalinput">
	  	<dl>
		  <dt>类 型:</dt>
		  <dd>
			<input type="radio" name="game_id" checked="checked" value="<?php echo ($data["game_id"]); ?>" hidden="true"/>
			<input type="radio" name="title" checked="checked" value="<?php echo ($data["title"]); ?>"/> <?php echo ($data["title"]); ?>
		  </dd>
		</dl>
		<dl>
		  <dt>开 始:</dt>
		  <dd>
			<input name="create_time" type="text" class="a1 radius5" maxlength="19" value="<?php echo (date('Y-m-d H:i:s',$data["create_time"])); ?>" />
		  </dd>
		</dl>
		<dl>
		  <dt>结 束:</dt>
		  <dd><input name="over_time" type="text" class="a1 radius5" maxlength="19" value="<?php echo (date('Y-m-d H:i:s',$data["over_time"])); ?>"/></dd>
		</dl>
		<dl>
		  <dt>地 点:</dt>
		  <dd>
			<input name="place" type="text" value="<?php echo ($data["place"]); ?>" class="a1 radius5" maxlength="20" />
		  </dd>
		</dl>
		<dl>
		  <dt>限 制:</dt>
		  <dd>
			<select name="0">
			  <option  value ="<?php echo (intval($data["limit"]["num"])); ?>" selected="true">总人数<?php echo (intval($data["limit"]["num"])); ?>人</option>
			  <?php $__FOR_START_32521__=0;$__FOR_END_32521__=50;for($i=$__FOR_START_32521__;$i < $__FOR_END_32521__;$i+=1){ ?><option value ="<?php echo ($i); ?>"><?php echo ($i); ?></option><?php } ?>
			</select>
			<?php if(is_array($num)): $i = 0; $__LIST__ = $num;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><select name="<?php echo ($vo["access_id"]); ?>">
			  <option value ="<?php echo (intval($vo["num"])); ?>" selected="true"><?php echo ($vo["name"]); echo (intval($vo["num"])); ?>人</option>
			 <?php $__FOR_START_2064__=0;$__FOR_END_2064__=50;for($i=$__FOR_START_2064__;$i < $__FOR_END_2064__;$i+=1){ ?><option value ="<?php echo ($i); ?>"><?php echo ($i); ?></option><?php } ?>
			</select><?php endforeach; endif; else: echo "" ;endif; ?>
		  </dd>
		</dl>
		<dl>
		  <dt>已 报:</dt>
		  <dd>
			<select>
			  <option value ="<?php echo ($data["user"]["num"]); ?>">总人数<?php echo ($data["user"]["num"]); ?>人</option>
			</select>
			<?php if(is_array($num)): $i = 0; $__LIST__ = $num;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><select>
			  <option value ="<?php echo ($vo["user"]["num"]); ?>" ><?php echo ($vo["name"]); echo ($vo["user"]["num"]); ?>人</option>
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