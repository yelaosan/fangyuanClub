<?php
namespace Weixin\Controller;
use Weixin\Model\Message;
class DataController extends CommonController {
	protected $ActionName = 'Data';
	protected $rule;
	protected function _initialize(){
		$this->get_rule();
	}
	public function index(){
		$data=$this->_data('content');
		foreach($this->rule as $key => $value){
			if(preg_match($key,$data,$m)){
				$this->controller=$value[0];
				$this->function	= $value[1];
				$this->result  =$m[0];
				break;
			}
		}
		$this->_data('','Data',$this->data);
	}
	protected function get_rule(){
		$this->rule=array(
			'/^\d+[ 人个]{0,}$/'=>array('Game','insert'),
			'/^查看[ ]?$/'=>array('Game','read'),
            '/^？$/'=>array('Game','read'),
            '/^[\?]+$/'=>array('Game','read'),
			'/^绑定.+/'=>array('User','register'),
            '/^测试[ ]?$/'=>array('User','subscribe'),
			'/.*/'
		);
	}
	public function DataError(){
		
	}
}