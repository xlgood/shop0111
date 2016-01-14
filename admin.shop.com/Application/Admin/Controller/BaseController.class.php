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

    /**
     * 父类的构造方法中调用了此方法 为了防止覆盖父类的构造方法
     */
    public function _initialize()
    {
        $this->model = D(CONTROLLER_NAME);
    }
    /**
     * 供应商列表的展示
     */
    public function index()
    {
        cookie('request_uri', $_SERVER['REQUEST_URI']);
        $keyword = I('keyword');
        /**
         * 生成分页
         * $pageResult = array（
         *      'rows' => 二维数组 用来显示分页数据列表,
         *      'pageHtml'=> 生成的分页工具条html
         * ）
         */
        $pageResult = $this->model->getPageResult($keyword);
        $this->assign($pageResult);
        $this->assign('meta_title',$this->meta_title);
        $this->display('index');
    }

    /**改变该数据的status
     * @param $id   该数据的id
     * @param int $status  该数据修改后的status值  默认为-1
     */
    public function changeStatus($id, $status = -1)
    {
        $result = $this->model->changeStatus($id, $status);
        if ($result !== false) {
            $this->success('操作成功', U('index'));
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
                if ($this->model->add() !== false) {
                    $this->success('添加成功', cookie('request_uri'));
                    return;
                }
            }
            $this->error('添加失败' . show_model_error($this->model));
        } else {
            $this->assign('meta_title', '添加' . $this->meta_title);
            $this->display('edit');
        }
    }

    /**编辑供应商
     * @param $id  该供应商的id
     */
    public function edit($id)
    {
        if (IS_POST) {
            if ($this->model->create() !== false) {
                if ($this->model->save() !== false) {
                    $this->success('更新成功', cookie('request_uri'));
                    return;
                }
            }
            $this->error('更新失败' . show_model_error($this->model));
        } else {
            $row = $this->model->find($id);
            $this->assign($row);
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
            $this->success('删除成功', U('index'));
        } else {
            $this->error('删除失败' . show_model_error($this->model));
        }
    }


}