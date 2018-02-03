<?php
// 后台用户模块
namespace Admin\Controller;
class VipController extends CommonController {
	public function index() {
        //列表过滤器，生成查询Map对象
        $map = $this->_search();
        if (method_exists($this, '_filter')) {
            $this->_filter($map);
        }
        $name = $this->getActionName();
        $model = D($name);
        $data=$model->relation(true)->select();
		$group=I('group',8);
		foreach($data as $key=>$vo){
			if($vo['GroupInfo']['GroupId']==$group){
				$result[$key]=$vo;
			}
		}
		$this->assign('list',$result);
        $this->display();
        return;
    }
    function _filter(&$map){
        $map['id'] = array('egt',2);
        if(!empty($_POST['account'])) {
            $map['account'] = array('like',"%".$_POST['account']."%");
        }
    }
    // 检查帐号
    public function checkAccount() {
        if(!preg_match('/^[a-z]\w{4,}$/i',$_POST['account'])) {
            $this->error( '用户名必须是字母，且5位以上！');
        }
        $User = M("User");
        // 检测用户名是否冲突
        $name  =  $_REQUEST['account'];
        $result  =  $User->getByAccount($name);
        if($result) {
            $this->error('该用户名已经存在！');
        }else {
            $this->success('该用户名可以使用！');
        }
    }

    // 插入数据
    public function insert() {
        // 创建数据对象
        $User	 =	 D("User");
        if(!$User->create()) {
            $this->error($User->getError());
        }else{
            // 写入帐号数据
            if($result	 =	 $User->add()) {
                $this->addRole($result);
                $this->success('用户添加成功！');
            }else{
                $this->error('用户添加失败！');
            }
        }
    }

    protected function addRole($userId) {
        //新增用户自动加入相应权限组
        $RoleUser = M("RoleUser");
        $RoleUser->user_id	=	$userId;
        // 默认加入网站编辑组
        $RoleUser->role_id	=	3;
        $RoleUser->add();
    }

    //重置密码
    public function resetPwd() {
        $id  =  $_POST['id'];
        $password = $_POST['password'];
        if(''== trim($password)) {
            $this->error('密码不能为空！');
        }
        $User = M('User');
        $User->password	=	md5($password);
        $User->id			=	$id;
        $result	=	$User->save();
        if(false !== $result) {
            $this->success("密码修改为$password");
        }else {
            $this->error('重置密码失败！');
        }
    }
	public function GroupInfoChange(){
		$model=D($this->getActionName());
		$result=$model->GroupInfoChange(I('id',0),17-I('status',0));
		if(false !== $result) {
            $this->success("修改成功");
        }else {
            $this->error('修改失败！');
        }
	}
}