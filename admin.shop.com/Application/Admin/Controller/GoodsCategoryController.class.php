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
//        cookie('request_uri', $_SERVER['REQUEST_URI']);
//        $keyword = I('keyword');
        /**
         * 生成分页
         * $pageResult = array（
         *      'rows' => 二维数组 用来显示分页数据列表,
         *      'pageHtml'=> 生成的分页工具条html
         * ）
         */
//        $pageResult = $this->model->getPageResult($keyword);
//        $this->assign($pageResult);
        //得到树状列表
        $rows = $this->model->getTreeList();
        $this->assign('rows',$rows);
        $this->assign('meta_title',$this->meta_title);
        $this->display('index');
    }

    /**
     * 添加分类
     */
    public function add()
    {
        if (IS_POST) {
            if ($this->model->create() !== false) {
                if ($this->model->add() !== false) {
                    $this->success('添加成功', U('index'));
                    return;
                }
            }
            $this->error('添加失败' . show_model_error($this->model));
        } else {
            //得到树状列表
            $rows = $this->model->getTreeList(true,'id,name,parent_id');
            $this->assign('zNodes',$rows);
            $this->assign('meta_title', '添加' . $this->meta_title);
            $this->display('edit');
        }
    }

    /**编辑分类
     * @param $id  该分类的id
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
            //得到树状列表
            $rows = $this->model->getTreeList(true,'id,name,parent_id');
            $this->assign('zNodes',$rows);
            $this->assign('meta_title', '编辑' . $this->meta_title);
            $this->display('edit');
        }
    }
}