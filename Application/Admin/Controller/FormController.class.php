<?php
namespace Admin\Controller;
class FormController extends CommonController {
    //过滤查询字段
    function _filter(&$map){
        if(!empty($_POST['name'])) {
        $map['title'] = array('like',"%".$_POST['name']."%");
        }
    }
}