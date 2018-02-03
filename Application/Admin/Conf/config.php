<?php
return array(
	//'配置项'=>'配置值'
	'DB_PREFIX'             => 'bb_',
	/*
	'SESSION_AUTO_START'        =>  true,
    'TMPL_ACTION_ERROR'         =>  'Public:success', // 默认错误跳转对应的模板文件
    'TMPL_ACTION_SUCCESS'       =>  'Public:success', // 默认成功跳转对应的模板文件
    'USER_AUTH_ON'              =>  true,
    'USER_AUTH_TYPE'			=>  2,		// 默认认证类型 1 登录认证 2 实时认证
    'USER_AUTH_KEY'             =>  'authId',	// 用户认证SESSION标记
    'ADMIN_AUTH_KEY'			=>  'administrator',
    'USER_AUTH_MODEL'           =>  'User',	// 默认验证数据表模型
    'AUTH_PWD_ENCODER'          =>  'md5',	// 用户认证密码加密方式
    'USER_AUTH_GATEWAY'         =>  '/Public/login',// 默认认证网关
    'NOT_AUTH_MODULE'           =>  'Public',	// 默认无需认证模块
    'REQUIRE_AUTH_MODULE'       =>  '',		// 默认需要认证模块
    'NOT_AUTH_ACTION'           =>  '',		// 默认无需认证操作
    'REQUIRE_AUTH_ACTION'       =>  '',		// 默认需要认证操作
    'GUEST_AUTH_ON'             =>  false,    // 是否开启游客授权访问
    'GUEST_AUTH_ID'             =>  0,        // 游客的用户ID
    'DB_LIKE_FIELDS'            =>  'title|remark',
    'RBAC_ROLE_TABLE'           =>  'think_role',
    'RBAC_USER_TABLE'           =>  'think_role_user',
    'RBAC_ACCESS_TABLE'         =>  'think_access',
    'RBAC_NODE_TABLE'           =>  'think_node',
	*/
	'USER_AUTH_MODEL'           =>  'admin_user',
	'USER_AUTH_KEY'             =>  'authId',	// 用户认证SESSION标记
	'RBAC_ROLE_TABLE'           =>  'bb_admin_role',
    'RBAC_USER_TABLE'           =>  'bb_role_user',
    'RBAC_ACCESS_TABLE'         =>  'bb_access',
    'RBAC_NODE_TABLE'           =>  'bb_node',
    'MAIL_TO'	   		=> '10467763@qq.com',
    //'MAIL_TO'	   		=> '971308896@qq.com',
	'MAIL_HOST' =>'smtp.163.com',//smtp服务器的名称
    'MAIL_SMTPAUTH' =>TRUE, //启用smtp认证
    'MAIL_USERNAME' =>'13468844596@163.com',//你的邮箱名
    'MAIL_FROM' =>'13468844596@163.com',//发件人地址
    'MAIL_FROMNAME'=>'方圆羽毛球俱乐部',//发件人姓名
    'MAIL_PASSWORD' =>'4594444109',//邮箱密码
    'MAIL_CHARSET' =>'utf-8',//设置邮件编码
    'MAIL_ISHTML' =>TRUE, // 是否HTML格式邮件
);
?>