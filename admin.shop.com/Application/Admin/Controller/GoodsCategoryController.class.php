<?php


namespace Admin\Controller;


use Think\Controller;

class GoodsCategoryController extends BaseController{
    protected $meta_title = '商品分类';
    /**
     * 分类列表的展示
     */
    public function index()
    {
        cookie('request_uri', $_SERVER['REQUEST_URI']);
        $rows = $this->model->getTreeList();
        $this->assign('rows',$rows);
        $this->assign('meta_title',$this->meta_title);
        $this->display('index');
    }

    /**
     * 覆盖父类的钩子方法
     */
    protected function _before_edit_view(){
        //得到树状列表并分配到页面
        $rows = $this->model->getTreeList(true,'id,name,parent_id');
        $this->assign('zNodes',$rows);

    }
}