<?php
namespace Weixin\Model;
use Think\Model\RelationModel;
class GameModel extends RelationModel {
	protected $_link = array(
	'Role' => array(    
		'mapping_type'  => self::HAS_MANY,    
		'class_name'    => 'game_access',  
		'foreign_key'   => 'game_id',   
		'mapping_name'  => 'role', 
		'condition'		=> 'level =3',
		'mapping_fields'=> 'id,access_id,num'
	),
    'Limit' => array(    
		'mapping_type'  => self::HAS_ONE,    
		'class_name'    => 'game_access',  
		'foreign_key'   => 'game_id',   
		'mapping_name'  => 'limit', 
		'condition'		=> 'level  = 2',
		'mapping_fields'=> 'num'
	)
);
}