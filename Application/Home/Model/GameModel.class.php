<?php
namespace Home\Model;
use Think\Model\RelationModel;
class GameModel extends RelationModel {
	protected $_link = array(
	'Num' => array(    
		'mapping_type'  => self::HAS_ONE,    
		'class_name'    => 'game_access',  
		'foreign_key'   => 'game_id',   
		'mapping_name'  => 'ed', 
		'condition'		=> 'level =5',
		'mapping_fields'=> 'sum(num) as num'
	),
	'List' => array(    
		'mapping_type'  => self::HAS_MANY,    
		'class_name'    => 'game_access',  
		'foreign_key'   => 'game_id',   
		'mapping_name'  => 'list', 
		'condition'		=> 'level =5 and num>0',
		'mapping_fields'=> 'access_id,num'
	),
    'Limit' => array(    
		'mapping_type'  => self::HAS_ONE,    
		'class_name'    => 'game_access',  
		'foreign_key'   => 'game_id',   
		'mapping_name'  => 'limit', 
		'condition'		=> 'level  = 2',
		'mapping_fields'=> 'id,num'
	)
);
}