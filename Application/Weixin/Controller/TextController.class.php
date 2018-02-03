<?php
namespace Weixin\Controller;
class TextController extends CommonController {    
	public function index(){ 
        $game=$this->_data('Game');
        //if(!$game)$this->quickSend('没有比赛');
        $game['role']=array(array('num'=>1,'access_id'=>9,'id'=>3));
        foreach($game['role'] as $key => $role){
            $game['role'][$key]['name'] = M('HomeRole')->where("id = {$role['access_id']}")->getField('name');
            $game['role'][$key]['ed']	= D('Access')->where("pid = {$role['id']} and level = 4")->sum('num');
            $game['role'][$key]['list'] = D('Access')->join('bb_home_user')->where("num>0 and bb_home_user.status>0 and level=4 and pid = {$role['id']} and bb_home_user.id=bb_game_access.access_id")->field('bb_home_user.nickname,num')->select();
        }
		foreach($data['user'] as $vo){
			$list.=$vo['nickname']."		".$vo['num']."人		".chr(13).chr(10);
            $num+=$vo['num'];
            
		}
        $result[22]['title']="比赛报名开始啦！";
        $result[0]['title']='时间：'.date("m-d H:m",$data['over_time'])."(截止)";
		//$result[0]['url']=;
		$result[1]['title']='地点：'.$data['place'];
		//$result[1]['url']=;
        //        $result[2]['title']="人数：总{$num}/{$data['limit']['num']} $data['role'][0]['num']";
	//	$result[2]['url']=;
		$result[3]['title']=$list;
	//	$result[3]['url']=;
		$result[4]['title']='附：';
        // foreach($data['role'] as $role){
        //        $result[4]['title'].="{$role['name']}限{$role['num']} 人";
        //   }
	//	$result[4]['url']=;
		return $result;
	}
}