<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/1/11
 * Time: 21:24
 */

namespace Admin\Controller;


use Think\Controller;

class BaseController extends Controller{
    protected $model;

    protected $useAllRequestData = false;  //是否使用所有post请求中的数据

    /**
     * 父类的构造方法中调用了此方法 为了防止覆盖父类的构造方法
     */
    public function _initialize()
    {
        $this->model = D(CONTROLLER_NAME);
    }
    /**
     * 商品列表的展示
     */
    public function index()
    {
        cookie('request_uri', $_SERVER['REQUEST_URI']);
        $keyword = I('keyword');
        $supplier_id = I('supplier_id');
        $brand_id = I('brand_id');
        $goods_category_id = I('goods_category_id');
        if(!empty($goods_category_id)){
            $leaf = $this->_getLeaf($goods_category_id);
        }

        /**
         * 生成分页
         * $pageResult = array（
         *      'rows' => 二维数组 用来显示分页数据列表,
         *      'pageHtml'=> 生成的分页工具条html
         * ）
         */
        $pageResult = $this->model->getPageResult($keyword,$supplier_id,$brand_id,$goods_category_id,$leaf);
        $this->assign($pageResult);
        $this->assign('meta_title',$this->meta_title);
        $this->_before_edit_view();
        $this->display('index');
    }

    /**钩子方法 用于被子类覆盖 根据分类id得到叶子id
     * @param $goods_category_id  分类id
     */
    protected function _getLeaf($goods_category_id){

    }

    /**改变该数据的status
     * @param $id   该数据的id
     * @param int $status  该数据修改后的status值  默认为-1
     */
    public function changeStatus($id, $status = -1)
    {
        $result = $this->model->changeStatus($id, $status);
        if ($result !== false) {
            $this->success('操作成功', cookie('request_uri'));
        } else {
            $this->error('操作失败' . show_model_error($this->model));
        }
    }

    /**
     * 添加供应商
     */
    public function add()
    {
        if (IS_POST) {
            if ($this->model->create() !== false) {
                if ($this->model->add($this->useAllRequestData?I('post.'):'') !== false) {
                    $this->success('添加成功', cookie('request_uri'));
                    return;
                }
            }
            $this->error('添加失败' . show_model_error($this->model));
        } else {
            $this->_before_edit_view();
            $this->assign('meta_title', '添加' . $this->meta_title);
            $this->display('edit');
        }
    }

    /**
     * 用于被子类覆盖 在edit页面展示之前准备数据 钩子方法 通常以_开头
     */
    protected function _before_edit_view(){
    }

    /**编辑供应商
     * @param $id  该供应商的id
     */
    public function edit($id)
    {
        if (IS_POST) {
            if ($this->model->create() !== false) {
                if ($this->model->save($this->useAllRequestData?I('post.'):'') !== false) {
                    $this->success('更新成功', cookie('request_uri'));
                    return;
                }
            }
            $this->error('更新失败' . show_model_error($this->model));
        } else {
            $row = $this->model->find($id);
            $this->assign($row);
            $this->_before_edit_view();
            $this->assign('meta_title', '编辑' . $this->meta_title);
            $this->display('edit');
        }
    }

    /**删除供应商（将该供应商的status变为-1）
     * @param $id  该供应商的id
     */
    public function remove($id)
    {
        $result = $this->model->remove($id);
        if ($result !== false) {
            $this->success('删除成功', cookie('request_uri'));
        } else {
            $this->error('删除失败' . show_model_error($this->model));
        }
    }


}