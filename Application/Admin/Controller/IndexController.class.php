<?php
namespace Admin\Controller;
class IndexController extends CommonController {
    public function index(){
        if(!isset($_SESSION[C('USER_AUTH_KEY')])) {
			$this->redirect('Admin/Public/login');
        }
		C ( 'SHOW_RUN_TIME', false ); // 运行时间显示
        C ( 'SHOW_PAGE_TRACE', false );
		$this->display();
    }
}
?>