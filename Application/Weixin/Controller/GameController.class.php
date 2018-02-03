<?php
namespace Weixin\Controller;
use Weixin\Model\Message;
class GameController extends CommonController {
	protected function _initialize(){
		$this->getGame();
		$this->msgtype=Message::MSGTYPE_NEWS;
	}
	public function index(){
		//$this->_data($this->data);
	}
	public function _before_insert(){
		//print_r($this->_data());
		if($this->_data('nickname')==''){
            //print_r($this->_data());
		    $this->quickSend('你未绑定！');
		}
		if(time()>$this->over_time){
			$this->quickSend('报名结束了！');
		}
		if(!$this->getGame()){
			$this->quickSend('目前还没有比赛。');
		}
			
        	$access = D('Access');
        	$data=$this->_data('User');
        	foreach($this->role as $role){
				if($role['access_id']==$data['role'][0]['id']){
                    $this->pid=$role['id'];
                    $limit = $role['num'];
                    break;
				}
			}
        	$role_num_ed=$access->where("game_id = {$this->game_id} and access_id<> {$data['id']} and and pid ={$this->pid} andlevel = 4 ")->sum('num');
        	$all_num_ed=$access->where("game_id = {$this->_data('game_id')} and access_id <> {$data['id']} and level = 4 ")->sum('num');
        // print_r($this->_data('role','Game'));
		if($role_num_ed+$this->_data('result','Data')>$limit){
				$this->quickSend($data['role'][0]['name'].'的参赛名额不够了。');
		}
        $all=$this->limit;
        if($all_num_ed+$this->_data('result','Data')>$all['num']){
				$this->quickSend('总名额到达上限。');
		}
        // print_r($data);
			
	}
	public function getGame(){
		if(!S('game')){
			$game=D("Game");
			$where['status']=0;
			$where['name']='index';
			$where['over_time']=array('gt',time());
			$data=$game->relation(true)->where($where)->limit(1)->select();
			//dump($data[0]['role']);
			/*
			echo "-------\r\n";
			print_r($game->getLastSql());
			print_r($data);
			echo "-------\r\n";
			*/
			if(!empty($data)&&$data[0]['over_time']>time())
				S('game',$data,$data[0]['over_time']-time());
		}else{
			$data=S('game');
            //S('game',null);
		}
		$this->_data('','Game',$data[0]);
        $this->data=$data[0];
		return $data[0];
	}
	public function insert(){
        	$num = preg_replace("/\D/",null,$this->_data('result','Data'));
			$this->_before_insert();
			$access = D('Access');
			$xxx['game_id']=$this->_data('game_id');
			$xxx['access_id']=$this->_data('id','User');
			$xxx['level']=4;
			$access->where($xxx)->delete();
			$xxx['num']=$num;
        	$xxx['pid']=$this->pid;
			$access->add($xxx);
        	S('result',null);
			$this->read();
			//$this->_data('','Msg',$this->data);
			//print_r($access->getLastSql());
            //print_r($this->_data());
	}
	public function read(){
		 $this->news=W('Game/index');
         $this->msgtype=Message::MSGTYPE_NEWS;
		 $this->_data('','Msg',$this->data);
		 //print_r($list);
		 //print_r($game);
		// print_r($game);
	}
}