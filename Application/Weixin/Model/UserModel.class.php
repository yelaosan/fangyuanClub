<?php
namespace Weixin\Model;
use Think\Model\RelationModel;
class UserModel extends RelationModel {
	protected $tableName = 'home_user'; 
	protected $_link = array(
		'Role' => array(    
			'mapping_type'      =>  self::MANY_TO_MANY,    
            'class_name'        =>  'home_role', 
			'mapping_name'      =>  'role', 
			'foreign_key'       =>  'user_id',  
			'relation_foreign_key'  =>  'role_id',   
			'relation_table'    =>  'bb_role_user',
			'condition'			=>   'status = 1',
			'mapping_fields'=> 'id,name'
			) ,
       'RoleAdd'=> array(    
            'mapping_type'      => self::HAS_ONE,
           'class_name'        =>  'role_user', 
        )
	);
}