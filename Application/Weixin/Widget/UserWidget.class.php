<?php
namespace Weixin\Widget;
use Weixin\Controller\CommonController;
class UserWidget extends CommonController {    
    public function Subscribe(){
        $result[0]['title']="方圆俱乐部欢迎您！";
        $result[0]['description']="时间: 周二一般晚上7～9点，周六一般下午2~6点".chr(13).chr(10)."地点：省体一号馆".chr(13).chr(10)."费用(每次活动时间不同，俱乐部统一买球，自带拍就好)：4小时：正式学生20元、临时学生30元、临时35元；3小时：正式学生15元、临时学生25元、临时30元；2小时：正式学生10元、临时学生20元、临时25元";
		return $result;
	}
}