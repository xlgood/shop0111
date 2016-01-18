<?php
namespace Home\Controller;

use Think\Controller;

class IndexController extends Controller
{
    public function index()
    {
        $goodsCategoryModel = D('GoodsCategory');
        $goodsCategorys = $goodsCategoryModel->getList();
        $this->assign('goodsCategorys',$goodsCategorys);

        $this->assign('meta_title','首页');
        $this->display('index');
    }

    public function lst()
    {
        $this->assign('is_hide',true);
        $this->assign('meta_title','商品列表');
        $this->display('lst');
    }

    public function goods()
    {
        $this->assign('is_hide',true);
        $this->assign('meta_title','商品名称');
        $this->display('goods');
    }
}