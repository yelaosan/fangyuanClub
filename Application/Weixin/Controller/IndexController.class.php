<?php
namespace Weixin\Controller;
use Weixin\Model\Message;
use Think\Controller;
class IndexController extends Controller {
	protected function _initialize() {
		C('SHOW_RUN_TIME',false);			// 运行时间显示
        C('SHOW_PAGE_TRACE',false);
        $Msg = Message::getInstance();
		if($Msg->data()==''){
			$xml = (array) simplexml_load_string($GLOBALS['HTTP_RAW_POST_DATA'], 'SimpleXMLElement', LIBXML_NOCDATA);
			$Msg->Msg=array_change_key_case($xml, CASE_LOWER);
            //$Msg->Msg=array('content'=>'2','fromusername'=>'8xxx');
		}
		if (isset($_GET['echostr']) && $this->validateSignature()) {
			exit(I('get.echostr'));
		}
    }
    public function _before_index(){
		A('User')->index();			//用户权限 等级 积分……
		A('Data')->index();			//信息匹配
    }
	public function index(){
		$Msg = Message::getInstance();
		$con = $Msg ->Data['controller'];
		$fun	= $Msg ->Data['function'];
        if(is_string($con)&&is_string($fun)){
			//print_r($Msg ->data());
			A($con)->$fun();
		}else{
			print_r($Msg ->data());
		}
        
	}
	public function _after_index(){
       
		$Msg = Message::getInstance();
        //print_r($Msg->Msg);
		$this->assign('data',$Msg->Msg);
		$this->display(C('MSGTPL'),'utf-8',(C('SHOW_PAGE_TRACE'))?'html':'xml');
	}
	private function validateSignature() {
      $signature = I('get.signature');
      $timestamp = I('get.timestamp');
      $nonce = I('get.nonce');
	  $token = C('WECHAT_TOKEN');
      $signatureArray = array($token, $timestamp, $nonce);
      sort($signatureArray);
      return sha1(implode($signatureArray)) == $signature;
    }
}