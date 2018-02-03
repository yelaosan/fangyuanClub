<?php
namespace Admin\Model;
use Think\Model\RelationModel;
class AccessModel extends RelationModel {
	protected $_auto = array (                           
		array('create_time','time',1,'function'), // 对name字段在新增和编辑的时候回调getName方法            
	);
	protected $tableName = 'game_access'; 
    protected $_link = array(
        'Num' =>	array(
			'mapping_type'  => self::HAS_ONE,    
			'class_name'    => 'game_access',  
			'foreign_key'   => 'pid',   
			'mapping_name'  => 'user', 
			'condition'		=> 'level =4',
			'mapping_fields'=> 'SUM(num) AS num'
		),
		/*
		"Name"  => array(
			'mapping_type'  => self::HAS_MANY, 
			'class_name'    => 'home_role',
			'parent_key'	=>	'access_id',
			'foreign_key'   => 'id',
			'mapping_name'  => 'name',
			'mapping_fields'=> 'name'
		)
		*/
    );
}