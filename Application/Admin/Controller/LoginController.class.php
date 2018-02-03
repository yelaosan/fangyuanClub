<?php
namespace Admin\Controller;
use Think\Controller;
class LoginController extends Controller {
	protected function _initialize() {
        header("Content-Type:text/html; charset=utf-8");
    }
    public function index(){
		$this->display();
    }
	public function verify(){
		$config =    array(    
			'imageW'	  =>	60,
			'imageH'	  =>	15,
			'fontSize'    =>    9,    // 验证码字体大小   
			'length'      =>    4,     // 验证码位数    
			'useNoise'    =>    false, // 关闭验证码杂点
		);
		$Verify = new \Think\Verify($config);
		$Verify->entry();
	}
}
?>