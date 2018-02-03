<?php
namespace Weixin\Model;
class Message{
	const MSGTYPE_TEXT    = "text";
	const MSGTYPE_IMAGE   = "image";
	const MSGTYPE_VIDEO   = "video";
	const MSGTYPE_MUSIC   = "music";
	const MSGTYPE_NEWS    = "news";
	const MSGTYPE_VOICE   = "voice";
	private $data;
	//该属性用来保存实例
	private static $msg;
  //构造函数为private,防止创建对象
	private function __construct(){
	}
  //创建一个用来实例化对象的方法
	public static function getInstance(){
	if(!(self::$msg instanceof self)){
		self::$msg = new self;
	}
	return self::$msg;
	}
  //防止对象被复制
	public function __clone(){
		trigger_error('Clone is not allowed !');
	}
	/**
     * 设置数据对象的值
     * @access public
     * @param string $name 名称
     * @param mixed $value 值
     * @return void
     */
    public function __set($name,$value) {
        // 设置数据对象属性
        $this->data[$name]  =   $value;
    }

    /**
     * 获取数据对象的值
     * @access public
     * @param string $name 名称
     * @return mixed
     */
    public function __get($name) {
        return isset($this->data[$name])?$this->data[$name]:null;
    }

    /**
     * 检测数据对象的值
     * @access public
     * @param string $name 名称
     * @return boolean
     */
    public function __isset($name) {
        return isset($this->data[$name]);
    }

    /**
     * 销毁数据对象的值
     * @access public
     * @param string $name 名称
     * @return void
     */
    public function __unset($name) {
        unset($this->data[$name]);
    }
	/**
     * 设置数据对象值
     * @access public
     * @param mixed $data 数据
     * @return Model
     */
    public function data($data=''){
        if('' === $data && !empty($this->data)) {
            return $this->data;
        }
        if(is_object($data)){
            $data   =   get_object_vars($data);
        }elseif(is_string($data)){
            parse_str($data,$data);
        }elseif(!is_array($data)){
            E(L('_DATA_TYPE_INVALID_'));
        }
        $this->data = $data;
        //return $this;
		return;
    }

 }
?>