<?php
function sendMail($to, $title, $content) {
     
        Vendor('PHPMailer.PHPMailer');     
        $mail = new PHPMailer(); //实例化
        $mail->IsSMTP(); // 启用SMTP
        $mail->Host=C('MAIL_HOST'); //smtp服务器的名称（这里以QQ邮箱为例）
        $mail->SMTPAuth = C('MAIL_SMTPAUTH'); //启用smtp认证
        $mail->Username = C('MAIL_USERNAME'); //你的邮箱名
        $mail->Password = C('MAIL_PASSWORD') ; //邮箱密码
        $mail->From = C('MAIL_FROM'); //发件人地址（也就是你的邮箱地址）
        $mail->FromName = C('MAIL_FROMNAME'); //发件人姓名
        $mail->AddAddress($to,"尊敬的客户");
        $mail->WordWrap = 50; //设置每行字符长度
        $mail->IsHTML(C('MAIL_ISHTML')); // 是否HTML格式邮件
        $mail->CharSet=C('MAIL_CHARSET'); //设置邮件编码
        $mail->Subject =$title; //邮件主题
        $mail->Body = $content; //邮件内容
        $mail->AltBody = "这是一个纯文本的身体在非营利的HTML电子邮件客户端"; //邮件正文不支持HTML的备用显示
        return($mail->Send());
}
function toDate($time, $format = 'Y-m-d H:i:s') {
	if (empty ( $time )) {
		return '';
	}
	$format = str_replace ( '#', ':', $format );
	return date ($format, $time );
}

function getStatus($status, $imageShow = true) {
	switch ($status) {
		case 0 :
			$showText = '禁用';
        $showImg = '<IMG SRC="/Public/images/locked.gif" WIDTH="20" HEIGHT="20" BORDER="0" ALT="禁用">';
			break;
		case 2 :
			$showText = '待审';
			$showImg = '<IMG SRC="__PUBLIC__/Images/prected.gif" WIDTH="20" HEIGHT="20" BORDER="0" ALT="待审">';
			break;
		case - 1 :
			$showText = '删除';
			$showImg = '<IMG SRC="__PUBLIC__/Images/del.gif" WIDTH="20" HEIGHT="20" BORDER="0" ALT="删除">';
			break;
		case 1 :
		default :
			$showText = '正常';
        $showImg = '<IMG SRC="/Public/images/ok.gif" WIDTH="20" HEIGHT="20" BORDER="0" ALT="正常">';

	}
	return ($imageShow === true) ?  $showImg  : $showText;

}

function getNodeGroupName($id) {
	if (empty ( $id )) {
		return '未分组';
	}
	if (isset ( $_SESSION ['nodeGroupList'] )) {
		return $_SESSION ['nodeGroupList'] [$id];
	}
	$Group = D ( "Group" );
	$list = $Group->getField ( 'id,title' );
	$_SESSION ['nodeGroupList'] = $list;
	$name = $list [$id];
	return $name;
}

function showStatus($status, $id) {
	switch ($status) {
		case 0 :
			$info = '<a href="javascript:resume(' . $id . ')">恢复</a>';
			break;
		case 2 :
			$info = '<a href="javascript:pass(' . $id . ')">批准</a>';
			break;
		case 1 :
			$info = '<a href="javascript:forbid(' . $id . ')">禁用</a>';
			break;
		case - 1 :
			$info = '<a href="javascript:recycle(' . $id . ')">还原</a>';
			break;
	}
	return $info;
}


function getGroupName($id) {
	if ($id == 0) {
		return '无上级组';
	}
	if ($list = F ( 'groupName' )) {
		return $list [$id];
	}
	$dao = D ( "Role" );
	$list = $dao->select( array ('field' => 'id,name' ) );
	foreach ( $list as $vo ) {
		$nameList [$vo ['id']] = $vo ['name'];
	}
	$name = $nameList [$id];
	F ( 'groupName', $nameList );
	return $name;
}
function showInfo($status, $id='') {
	if($id==''){
		switch ($status) {
		case 8 :
			$info = "正式会员";
			break;
		case 9 :
			$info = "临时会员";
			break;
		default :
			$info = "额。。。";
			break;
		}
	}else{
		switch ($status) {
		case 8 :
			$info = "<a href='javascript:GroupInfoChange({$id},{$status})'>改为临时</a>";
			break;
		case 9 :
			$info = "<a href='javascript:GroupInfoChange({$id},{$status})'>改为正式</a>";
			break;
		default :
			$info = "<a href='#'>出错了</a>";
			break;
		}
	}
	
	return $info;
}
function pwdHash($password, $type = 'md5') {
	return hash ( $type, $password );
}
?>