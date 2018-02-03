<?php
namespace Admin\Controller;
use Think\Controller;
class AutoController extends Controller {
    protected function _initialize(){
        header("Content-type:text/html;charset=utf-8");
    }
	public function game(){
		$this->check();
        $w=date('w');
		$game = D('Game');
		$over_time=$game->where("status = 0 and name = 'index'")->getField('over_time');
		if(NOW_TIME>$over_time){
			$game->where("status = 0 and name='index'")->save(array('status'=>1));
			$data['create_time']=NOW_TIME;
            $data['over_time']	=NOW_TIME+3600*(99-6*$w);//2->87 6->63  99-6x
			$data['Auto_All']['num']=33-2.5*$w;
			$data['Auto_All']['level']=2;
			$game_id=$game->relation('Auto_All')->add($data);
			$access_id=$game->getAccessId($game_id);
			$data=array(
				array($game_id,9,6.5-$w*3/4,3,$access_id),
				array($game_id,8,26.5-$w*7/4,3,$access_id)//2->3,6->2    9,6.5-$w*3/4
			);
			$this->setAccess($data);
            $this->mail();
			echo("新比赛开始了！");
		}else if(NOW_TIME+2*24*3600>$over_time){//关联操作得到设定的人数。。。。
			$num=$game->getGameId();
			if(is_numeric($num)){
				$game->freeAccess($num);
				echo("开放报名！");
			}else{
				echo("开放报名失败！");
			}
		}else{
			echo("报名进行中！");
		}
	}
	/*
	设置比赛人数
	*/
	public function setAccess($data){
		$access=M('GameAccess');
		$map=array('game_id','access_id','num','level','pid');
		foreach($data as $num=>$vo){
			foreach($vo as $key=>$value){
				$result[$num][$map[$key]]=$value;
			}
		}
		$access->addAll($result);
        S('game',null);
	}
	/*
	结束过期的比赛
	*/
	public function check(){
		$game = M('Game');
		$map['over_time'] 	= array('elt',NOW_TIME);
		$map['status']		= 0;
		$game->where($map)->setField('status',1);
	}
	public function backup(){
		if(date('w')!=3)return false;
		$user = M('HomeUser');
		$data=$user  ->getField('id,bind_account');
		foreach($data as $id => $wid){
			S('vip'.$id,$wid,24*3600*6);
		}
	}
	public function mail(){
        $data = S('result') ;
        if(!$data){
			echo "数据为空，邮件发送失败！";
			return false;
		}
        foreach($data as $value){
                $result .= implode(chr(13).chr(10),$value).chr(13).chr(10);
        }
  		return sendMail(C('MAIL_TO'),$data['time']['title'],$result);
	}
}