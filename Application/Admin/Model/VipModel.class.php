<?php
// 用户模型
namespace Admin\Model;
use Think\Model\RelationModel;
class VipModel extends RelationModel {
	protected $tableName = 'home_user'; 
    public $_validate	=	array(
        array('account','/^[a-z]\w{3,}$/i','帐号格式错误'),
        array('password','require','密码必须'),
        array('nickname','require','昵称必须'),
        array('repassword','require','确认密码必须'),
        array('repassword','password','确认密码不一致',self::EXISTS_VALIDATE,'confirm'),
        array('account','','帐号已经存在',self::EXISTS_VALIDATE,'unique',self::MODEL_INSERT),
        );

    public $_auto		=	array(
        array('password','pwdHash',self::MODEL_BOTH,'callback'),
        array('create_time','time',self::MODEL_INSERT,'function'),
        array('update_time','time',self::MODEL_UPDATE,'function'),
        );
	protected $_link = array(
        'Group' =>	array(
			'mapping_type'  => self::HAS_ONE,    
			'class_name'    => 'role_user',  
			'foreign_key'   => 'user_id',   
			'mapping_name'  => 'GroupInfo', 
			'condition'		=> 'level =2',
			'mapping_fields'=> 'role_id as GroupId',
		),
    );
    protected function pwdHash() {
        if(isset($_POST['password'])) {
            return pwdHash($_POST['password']);
        }else{
            return false;
        }
    }
	// 获取当前用户的ID
    public function getMemberId() {
        return isset($_SESSION[C('USER_AUTH_KEY')])?$_SESSION[C('USER_AUTH_KEY')]:0;
    }

   /**
     +----------------------------------------------------------
     * 根据条件禁用表数据
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     * @param array $options 条件
     +----------------------------------------------------------
     * @return boolen
     +----------------------------------------------------------
     */
    public function forbid($options,$field='status'){

        if(FALSE === $this->where($options)->setField($field,0)){
            $this->error =  L('_OPERATION_WRONG_');
            return false;
        }else {
            return True;
        }
    }

	 /**
     +----------------------------------------------------------
     * 根据条件批准表数据
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     * @param array $options 条件
     +----------------------------------------------------------
     * @return boolen
     +----------------------------------------------------------
     */

    public function checkPass($options,$field='status'){
        if(FALSE === $this->where($options)->setField($field,1)){
            $this->error =  L('_OPERATION_WRONG_');
            return false;
        }else {
            return True;
        }
    }


    /**
     +----------------------------------------------------------
     * 根据条件恢复表数据
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     * @param array $options 条件
     +----------------------------------------------------------
     * @return boolen
     +----------------------------------------------------------
     */
    public function resume($options,$field='status'){
        if(FALSE === $this->where($options)->setField($field,1)){
            $this->error =  L('_OPERATION_WRONG_');
            return false;
        }else {
            return True;
        }
    }

    /**
     +----------------------------------------------------------
     * 根据条件恢复表数据
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     * @param array $options 条件
     +----------------------------------------------------------
     * @return boolen
     +----------------------------------------------------------
     */
    public function recycle($options,$field='status'){
        if(FALSE === $this->where($options)->setField($field,0)){
            $this->error =  L('_OPERATION_WRONG_');
            return false;
        }else {
            return True;
        }
    }

    public function recommend($options,$field='is_recommend'){
        if(FALSE === $this->where($options)->setField($field,1)){
            $this->error =  L('_OPERATION_WRONG_');
            return false;
        }else {
            return True;
        }
    }

    public function unrecommend($options,$field='is_recommend'){
        if(FALSE === $this->where($options)->setField($field,0)){
            $this->error =  L('_OPERATION_WRONG_');
            return false;
        }else {
            return True;
        }
    }
	public function GroupInfoChange($user_id,$role_id){
		$result = $this->db->execute("update bb_role_user set role_id={$role_id} where level=2 and user_id=".$user_id);
		return $result ;
	}
}