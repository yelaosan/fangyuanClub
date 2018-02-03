<?php
namespace Weixin\Widget;
use Weixin\Controller\CommonController;
class GameWidget extends CommonController {    
	public function index(){ 
        $cache = S('result');
        if($cache!='')return  $cache;
        $data=S('game');
        $game=$data[0];
        foreach($game['role'] as $key => $role){
            $game['role'][$key]['name'] = M('HomeRole')->where("id = {$role['access_id']}")->getField('name');
            $zzz= D('Access')->where("pid = {$role['id']} and level = 4")->sum('num');
            $game['role'][$key]['ed']=$zzz?$zzz:0;
            $num+=$zzz;
            $cache_list=S($key.'list');
            for($i=0;$i<10;$i++){
            	$listData = D('Access')->join('bb_home_user')->where("num>0 and bb_home_user.status>0 and level=4 and pid = {$role['id']} and bb_home_user.id=bb_game_access.access_id")->field('bb_home_user.nickname,num')->select();
                if($listData!="" && $listData!=$cache_list && $i>1)break;
            }
            $game['role'][$key]['list']=$listData;
            S($key.'list',$listData ,3600*24*5);
        }
        //print_r($game)
        function string_pad($input , $pad_length ,$pad_string , $pad_type){
            $strlen = strlen($input);
            if($strlen < $pad_length){
                $difference = $pad_length - $strlen;
                switch ($pad_type) {
                    case 'STR_PAD_BOTH':
                        $left = $difference / 2;
                        $right = $difference - $left;
                        return str_repeat($pad_string, $left) . $input . str_repeat($pad_string, $right);
                        break;
                    case 'STR_PAD_LEFT':
                        return str_repeat($pad_string, $difference) . $input;
                        break;
                    default:
                        return $input . str_repeat($pad_string, $difference);
                        break;
                }
            }else{
                return $input;
            }
 	   }
        
        
        $wek=array('日','一','二','三','四','五','六');
        $result[0]['title']="报名开始啦！";
        $result['time']['title']='时间：'.date("m-d H:m",$game['over_time'])."周".$wek[date("w",$game['over_time'])]."(截止)";
		$result['place']['title']='地点：'.$game['place'];
        $result['num']['title']="人数：总{$num}/{$game['limit']['num']} ";
        foreach($game['role'] as $role){
            $result['num']['title'] .= "{$role['name']}{$role['ed']}/{$role['num']} ";
        }
		$result['list']['title']=$list;
        $result['remark']['title']="附：{$game['remark']}";
        
        $title = date("m-d",$game['over_time'])." 周".$wek[date("w",$game['over_time'])].'的活动 已报 ';
        foreach($game['role'] as $role){
            $title .= "{$role['name']}{$role['ed']}/{$role['num']} ";
        }
        $title .= "总{$num}/{$game['limit']['num']} ";

        $key = 0;
        foreach($game['role'] as $role){
            foreach($role['list'] as $user){
                $key++;
                if ($key < 46) {
                    if($role['name']=="正式会员"){
                        $tmp = preg_replace('/(:|：|\+| |　|\s)*/','',$user['nickname']);
                        if ($user['num'] != 1) {
                            $tmp .= " ".$user['num']."人";
                        }
                        $list .= string_pad($tmp, 20, ' '); 
                    }else {
                        $tmp = preg_replace('/(:|：|\+| |　|\s)*/','',$user['nickname']."(临时)");
                        if ($user['num'] != 1) {
                            $tmp .= " ".$user['num']."人";
                        }
                        $list .= string_pad($tmp, 20, ' '); 
                    }
                    if($key%3 == 0){
                        $list .= "\n";
                    }
                }else {
                    if($role['name']=="正式会员"){
                        $tmp = preg_replace('/(:|：|\+| |　|\s)*/','',$user['nickname']);
                        if ($user['num'] != 1) {
                            $tmp .= " ".$user['num']."人";
                        }
                        $list1 .= string_pad($tmp, 20, ' '); 
                    }else {
                        $tmp = preg_replace('/(:|：|\+| |　|\s)*/','',$user['nickname']."(临时)");
                        if ($user['num'] != 1) {
                            $tmp .= " ".$user['num']."人";
                        }
                        $list1 .= string_pad($tmp, 20, ' '); 
                    }
                    if($key%3 == 0){
                        $list1 .= "\n";
                    }
                }
            }  
        }

        $res[0]['title'] = $title;
        $res[0]['description'] = $list;
        
        $list1 && $res[1]['title'] = $list1; 
        
        S('result',$res,3600*24*2);
		return $res;
	}
}