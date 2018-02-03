<?php
namespace Weixin\Controller;
use Think\Controller;
use Weixin\Model\Message;
class CommonController extends Controller {
	protected $data;
    public function index(){

    }
	public function _data($key='',$name='',$value=''){
		$Msg = Message::getInstance();
		$data= $Msg->data();
		if(!($key||$name||$value)){
			return $data;
		}
		if($value===''){
			if($name===''){
                if($data[$key]!=''){
                    return $data[$key];
                }
				foreach($data as $k => $value){
					if($data[$k][$key]!='')
						return $data[$k][$key];
				}
				return;
			}else{
				return $data[$name][$key];	
			}	
		}else{
			if($key===""){
				$data[$name]=$value;
			}else{
				$data[$name][$key]=$value;
			}
            $info = ($Msg->$name===null)?array():$Msg->$name;
            $Msg->$name = array_merge($info,$data[$name]);
		}				
		return;
	}
	public function __set($name,$value) {
        // 设置数据对象属性
        $this->data[$name]  =   $value;
    }
    public function __get($name) {
        return isset($this->data[$name])?$this->data[$name]:null;
    }
	protected function _search($name = '') {
        //生成查询条件
        if (empty($name)) {
            $name = $this->ActionName;
        }
        $model = D($name);
        $map = array();
		$name = ($this->ActionName!==null)?$this->ActionName:CONTROLLER_NAME;
		$data= $this->_data($name);
        foreach ($model->getDbFields() as $key => $val) {
            if (isset($data [$val]) && $data [$val] != '') {
                $map [$val] = $data [$val];
            }
        }
        return $map;
    }
	protected function quickSend($text="呵呵"){
        $this->_data('content','Msg',$text);
		$this->_data('msgtype','Msg',Message::MSGTYPE_TEXT);
		$this->assign('data',$this->_data('Msg'));
		$this->display(C('MSGTPL'),'utf-8',(C('SHOW_PAGE_TRACE'))?'html':'xml');
		exit;
	}

}