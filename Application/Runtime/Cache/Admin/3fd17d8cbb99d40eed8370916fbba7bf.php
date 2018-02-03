<?php if (!defined('THINK_PATH')) exit();?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>『ThinkPHP管理平台』By ThinkPHP <?php echo (THINK_VERSION); ?></title>
<link rel="stylesheet" type="text/css" href="/sae/fangyuanclub/1/Public/css/blue.css" />
<script type="text/javascript" src="/sae/fangyuanclub/1/Public/js/Base.js"></script>
<script type="text/javascript" src="/sae/fangyuanclub/1/Public/js/prototype.js"></script>
<script type="text/javascript" src="/sae/fangyuanclub/1/Public/js/mootools.js"></script>
<script type="text/javascript" src="/sae/fangyuanclub/1/Public/js/Think/ThinkAjax.js"></script>
<script type="text/javascript" src="/sae/fangyuanclub/1/Public/js/Form/CheckForm.js"></script>
<script type="text/javascript" src="/sae/fangyuanclub/1/Public/js/common.js"></script>
<script language="JavaScript">
<!--
//指定当前组模块URL地址 
var URL = '/sae/fangyuanclub/1/index.php/Admin/Game';
var APP	 =	 '/sae/fangyuanclub/1/index.php';
var PUBLIC = '/sae/fangyuanclub/1/Public';
//-->
</script>
</head>

<body>
<!-- 菜单区域  -->

<!-- 主页面开始 -->
<div id="main" class="main" >

<!-- 主体内容  -->
<div class="content" >
<div class="title">数据列表</div>
<!--  功能操作区域  -->
<div class="operate" >
<div class="impBtn hMargin fLeft shadow" ><input type="button" id="" name="add" value="新增" onclick="add()" class="add imgButton"></div>
<div class="impBtn hMargin fLeft shadow" ><input type="button" id="" name="edit" value="编辑" onclick="edit()" class="edit imgButton"></div>
<div class="impBtn hMargin fLeft shadow" ><input type="button" id="" name="delete" value="删除" onclick="foreverdel()" class="delete imgButton"></div>
<!-- 查询区域 -->
<div class="fRig">
<form method='post' action="/sae/fangyuanclub/1/index.php/Admin/Game">
<div class="fLeft"><span id="key"><input type="text" name="name" title="组名" class="medium" ></span></div>
<div class="impBtn hMargin fLeft shadow" ><input type="submit" id="" name="search" value="查询" onclick="" class="search imgButton"></div>
</div>
<!-- 高级查询区域 -->
<div  id="searchM" class=" none search cBoth" >
</div>
</form>
</div>
<!-- 功能操作区域结束 -->

<!-- 列表显示区域  -->
<div class="list" >
<!-- Think 系统列表组件开始 -->
	<table id="checkList" class="list" cellpadding=0 cellspacing=0 >
		<tr><td height="5" colspan="9" class="topTd" ></td></tr>
		<tr class="row" >	
			<th width="8"><input type="checkbox" id="check" onclick="CheckAll('checkList')"></th>
			<th width="8%"><a href="javascript:sortBy('game_id','<?php echo (empty($_GET['_sort'])); ?>','index')" title="按照编号升序排列 ">编号</a></th>
			<th><a href="javascript:sortBy('title','<?php echo (empty($_GET['_sort'])); ?>','index')" title="按照用户名升序排列 ">名称</a></th>
			<th><a href="javascript:sortBy('create_time','<?php echo (empty($_GET['_sort'])); ?>','index')" title="按照添加时间升序排列 ">添加时间</a></th>
			<th><a href="javascript:sortBy('over_time','<?php echo (empty($_GET['_sort'])); ?>','index')" title="按照添加时间升序排列 ">结束时间</a></th>
			<th><a href="javascript:sortBy('status','<?php echo (empty($_GET['_sort'])); ?>','index')" title="按照状态升序排列 ">状态</a></th>
			<th >操作</th></tr>
		<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="row" >
			<td><input type="checkbox" name="key"	value="<?php echo ($vo["game_id"]); ?>"></td>
			<td><?php echo ($vo["game_id"]); ?></td>
			<td><a href="javascript:edit('<?php echo ($vo["game_id"]); ?>')"><?php echo ($vo["title"]); ?></a></td>
			<td><?php echo (date("Y-m-d   H:i:s",$vo["create_time"])); ?></td>
			<td><?php echo (date("Y-m-d   H:i:s",$vo["over_time"])); ?></td>
			<?php if($vo["status"] == 1): ?><td>结束<IMG SRC="/sae/fangyuanclub/1/Public/images/ok.gif" WIDTH="20" HEIGHT="20" BORDER="0" ALT="结束"></td>
				<td> <a href="javascript:read(<?php echo ($vo["game_id"]); ?>)">查看</a>&nbsp;</td></tr>
			<?php else: ?>
				<td>进行中<IMG SRC="/sae/fangyuanclub/1/Public/images/write.gif" WIDTH="20" HEIGHT="20" BORDER="0" ALT="进行中"></td>
				<td> <a href="javascript:over(<?php echo ($vo["game_id"]); ?>)">结束</a>&nbsp;</td></tr><?php endif; ?>
			<?php if($vo["status"] == -1): ?><td>删除<IMG SRC="/sae/fangyuanclub/1/Public/images/error.gif" WIDTH="20" HEIGHT="20" BORDER="0" ALT="删除"></td>
				<td> <a href="javascript:resume(<?php echo ($vo["game_id"]); ?>)">恢复</a>&nbsp;</td></tr><?php endif; endforeach; endif; else: echo "" ;endif; ?>
		<tr>
			<td height="5" colspan="9" class="bottomTd"></td></tr></table>
<!-- Think 系统列表组件结束 -->
</div>
<!--  分页显示区域 -->
<div class="page"><?php echo ($page); ?></div>
<!-- 列表显示区域结束 -->
</div>
<!-- 主体内容结束 -->
</div>
<!-- 主页面结束 -->