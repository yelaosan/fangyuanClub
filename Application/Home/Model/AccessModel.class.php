<?php
namespace Home\Model;
use Think\Model\RelationModel;
class AccessModel extends RelationModel {
	protected $tableName = 'game_access'; 
	protected $_map		 = array(

	);
	protected $_auto = array (          
		array('status','0'),  // 新增的时候把status字段设置为1         
		//array('password','md5',3,'function') , // 对password字段在新增和编辑的时候使md5函数处理         
		//array('name','getName',3,'callback'), // 对name字段在新增和编辑的时候回调getName方法        
		array('create_time','time',1,'function'),    
	);
}