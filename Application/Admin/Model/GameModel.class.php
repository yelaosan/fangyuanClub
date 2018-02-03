<?php
namespace Admin\Model;
use Think\Model\RelationModel;
class GameModel extends RelationModel {
	protected $_map = array(         
		'0' =>'num',   
	);
	protected $_auto = array (          
		array('status','0'),  // 新增的时候把status字段设置为1                  
		array('create_time','strtotime',3,'function'), // 对name字段在新增和编辑的时候回调getName方法         
		array('over_time','strtotime',3,'function'), // 对update_time字段在更新的时候写入当前时间戳    
	);
	protected $_link = array(
	'Auto_All' => array(    
		'mapping_type'  => self::HAS_ONE,    
		'class_name'    => 'game_access',  
		'foreign_key'   => 'game_id'
	),
	'Auto_Role' => array(    
		'mapping_type'  => self::HAS_MANY,    
		'class_name'    => 'game_access',  
		'foreign_key'   => 'game_id'    
	),
    'Limit' => array(    
		'mapping_type'  => self::HAS_ONE,    
		'class_name'    => 'game_access',  
		'foreign_key'   => 'game_id',   
		'mapping_name'  => 'limit', 
		'condition'		=> 'level  = 2',
		'mapping_fields'=> 'num',
		//'relation_deep'=> true
	),
	'Num' =>	array(
			'mapping_type'  => self::HAS_ONE,    
			'class_name'    => 'game_access',  
			'foreign_key'   => 'game_id',   
			'mapping_name'  => 'user', 
			'condition'		=> 'level =4',
			'mapping_fields'=> 'SUM(num) AS num'
		)
	);
	public function freeAccess($id){
		$num=$this->query("SELECT num,id FROM bb_game_access WHERE game_id = {$id} and level=2 limit 1");
		$this->execute("UPDATE bb_game_access SET num ={$num[0]['num']} WHERE game_id = {$id} and level=3 and pid={$num[0]['id']}");
        S('game',null);
        //S('result',null);
	}
	public function getGameId(){
		if(!($game=S('game'))){
			$num=$this->where("status = 0 and name = 'index'")->getField('game_id');
		}else{
			$num=$game[0]['game_id'];
		}
		return $num?$num:false;
	}
	public function getAccessId($id){
        for($i=0;$i<10&&!$num;$i++){
			$num=$this->query("SELECT id FROM bb_game_access WHERE game_id = {$id} and level=2 limit 1");
        }
		return $num[0]['id'];
	}
}