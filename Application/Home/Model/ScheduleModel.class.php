<?php
namespace Home\Model;
use Think\Model\RelationModel;
class ScheduleModel extends RelationModel {
	protected $_link = array(
		'Spot' => array(
			'mapping_type'  =>  self::HAS_MANY,
			'relation_deep' =>	true
		)
	);
}