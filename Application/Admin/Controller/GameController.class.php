<?php
namespace Admin\Controller;
class GameController extends CommonController {
    //过滤查询字段
    function _filter(&$map){
        if(!empty($_POST['name'])) {
        $map['title'] = array('like',"%".$_POST['name']."%");
        }
    }
	public function _before_add(){
		$user = D('HomeRole');
		$data=$user ->where('status = 1')->field('id,name')->select();
		$this->assign('role', $data);
		//dump($data);
	}
	function insert() {
        $model = D("Game");
		$model->create();
        //保存当前数据对象
        $game_id = $model->add();
		if($game_id){
			$access=M('GameAccess');
			$access->create();
			$pid=0;
			foreach(I('post.') as $key => $value){
				if(is_numeric($key )){
					$data['game_id']=$game_id;
					$data['level']=($key)?3:2;
					$data['access_id']=$key ;
					$data['num']=$value;
					$data['pid']=$pid;
					$data['create_time'] = NOW_TIME;
					$id=$access->add($data);
					$pid=($key)?$pid:$id;
				}
			}
			$this->success('新增成功!',cookie('_currentUrl_'));
		}
    }
	public function _after_update() {
		$model = D("Access");
		$model->create();
		$map['game_id'] = I('post.game_id');
		foreach(I('post.') as $key => $value){
			if(is_numeric($key )){
				$map['level']=($key)?3:2;
				$map['access_id']=$key ;
				$data['num']=$value;
				$model->where($map)->save($data);
			}
		}
		S('game',null);
		S('temporary',null);
    }
	public function _before_edit(){
		$model = D("Access");
        $id = $_REQUEST ['id'];
        $vo = $model->join('bb_home_role ON bb_game_access.access_id = bb_home_role.id')
			->relation(true)->where("game_id = {$id} and level =3")->field('bb_home_role.name,access_id,num,bb_game_access.id')->select();
        $this->assign('num', $vo);
		//dump($vo);
	}
	public function edit() {
        $name = $this->getActionName();
        $model = D($name);
        $id = $_REQUEST ['id'];
        $vo = $model->relation(true)->select($id);
        $this->assign('data', $vo[0]);
		//dump($vo[0]);
        $this->display();
    }
	protected function _list($model, $map, $sortBy = '', $asc = false) {
        //排序字段 默认为主键名
        if (isset($_REQUEST ['_order'])) {
            $order = $_REQUEST ['_order'];
        } else {
            $order = !empty($sortBy) ? $sortBy : $model->getPk();
        }
        //排序方式默认按照倒序排列
        //接受 sost参数 0 表示倒序 非0都 表示正序
        if (isset($_REQUEST ['_sort'])) {
            $sort = $_REQUEST ['_sort'] ? 'asc' : 'desc';
        } else {
            $sort = $asc ? 'asc' : 'desc';
        }
        //取得满足条件的记录数
        $count = $model->where($map)->count($order);//原先是count('id')
        if ($count > 0) {
            //创建分页对象
            if (!empty($_REQUEST ['listRows'])) {
                $listRows = $_REQUEST ['listRows'];
            } else {
                $listRows = '';
            }
            $p = new \Think\Page($count, $listRows);
            //分页查询数据

            $voList = $model->where($map)->relation(true)->order("`" . $order . "` " . $sort)->limit($p->firstRow . ',' . $p->listRows)->select();
            //echo $model->getlastsql();
            //分页跳转的时候保证查询条件
            foreach ($map as $key => $val) {
                if (!is_array($val)) {
                    $p->parameter .= "$key=" . urlencode($val) . "&";
                }
            }
            //分页显示
            $page = $p->show();
            //列表排序显示
            $sortImg = $sort; //排序图标
            $sortAlt = $sort == 'desc' ? '升序排列' : '倒序排列'; //排序提示
            $sort = $sort == 'desc' ? 1 : 0; //排序方式
            //模板赋值显示
            $this->assign('list', $voList);
            $this->assign('sort', $sort);
            $this->assign('order', $order);
            $this->assign('sortImg', $sortImg);
            $this->assign('sortType', $sortAlt);
            $this->assign("page", $page);
        }
        cookie('_currentUrl_', __SELF__);
        return;
    }
}