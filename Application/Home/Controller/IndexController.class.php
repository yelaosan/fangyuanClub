<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
	public function index(){
		$this->read();
		$this->display();
	}
	public function read(){
		$game=S('temporary');
		if(!$game){
			$Game=D("Game");
			$where['status']=0;
			$where['name']='temporary';
			$where['over_time']=array('gt',time());
			$data=$Game->relation(true)->where($where)->limit(1)->select();
			foreach($data[0]['list'] as $key=>$user){
				$data[0]['list'][$key]['nickname'] = M('HomeUser')->where('id = '.$user['access_id'])->getfield('nickname');
			}
			$game=$data[0];
			S('temporary',$game,3600*24);
		}
		$this->assign('data',$game);
		//dump($game);
	}
	public function insert(){
		$game=S('temporary');
		$User=D("User");
		$User->create();
		$id=$User->where("nickname like '".I('username')."'")->getfield('id');
		if($id==null)$id=$User->add();
		$Access = D('Access');
		$map['access_id']=$id;
		$map['level'] = 5;
		$map['pid'] = $game['limit']['id'];
		$map['game_id']=$game['game_id'];
		$Access->where($map)->delete();
		$map['num']=I('num');
		if($game['ed']['num']+I('num')<=$game['limit']['num']){
			$Access->add($map);
			S('temporary',null);
			echo  1;
		}
			
		
	}
}
?>