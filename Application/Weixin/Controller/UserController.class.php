<?php
namespace Weixin\Controller;
use Weixin\Model\Message;
class UserController extends CommonController {
	protected $ActionName = 'User';
	protected function _initialize(){
        if($this->_data('event')=="subscribe")
            $this->subscribe();
		$this->_init_cache();
	}
	protected function _init_cache(){
		$wid = $this->_data('fromusername');
		if(!S($wid)){
			$user = D('User');
			$where['bind_account'] = $wid;
			$data=$user ->relation(true)->where($where)->limit(1)->select();
			if(empty($data)){
				$this->insert();
			}else{
				S($wid,$data,60*30);
			}
		}else{
			$data=S($wid);
		}
        S($wid,null);
        //print_r($data[0]);
        //print_r($user->getLastSql());
		
		$this->_data('','User',$data[0]);
	}
    public function index(){
       
    }
	public function insert(){
		$user = D('User');
        $user->create();
        $data['create_time']=NOW_TIME;
		$data['bind_account'] = $this->_data('fromusername');
        $data['RoleAdd']=array('role_id'=>9,'level'=>2);
        $id=$user->relation(true)->add($data);
		//S('vip'.$id,$this->fromusername);
        //print_r("111");
        //$this->quickSend($user->getLastSql());
	}
	public function _before_updata(){
		$this->nickname=$this->_data('content');
		$this->_data('','User',$this->data);
	}
	public function update(){
		$user = D('User');
		$user ->save();
		$map = $this->_search();
		$user->save($map);
	}
	public function register(){
        $name=preg_replace("/绑定/",null,$this->_data('result'));
		$user = D('User');
        $user->create();
		$where['bind_account'] = $this->_data('fromusername');
		$data['nickname']	= $name;
        $data['status']		= 1;
        $data['update_time']=NOW_TIME;
		$user->where($where)->save($data);
		//var_dump($user->getLastSql());
        S($where['bind_account'],null);
		$this->assign('data',$this->_data('Msg'));
        $this->display("User:register",'utf-8','xml');
        exit;
	}
    public function subscribe(){
        //$this->news=W('User/Subscribe');
        //$this->msgtype=Message::MSGTYPE_NEWS;
        //$this->_data('','Msg',$this->data);
        $this->assign('data',$this->_data('Msg'));
        $this->display("Public:EventTpl:Subscribe",'utf-8','xml');
        exit;
    }
	
}