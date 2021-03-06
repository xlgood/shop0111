<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/1/11
 * Time: 21:45
 */

namespace Admin\Model;


use Think\Model;
use Think\Page;

class BaseModel extends Model{
    //开启批量验证
    protected $patchValidate = true;

    /**根据id 将当前数据的status修改为-1
     * @param $id       需要修改的数据的id
     * @return bool     修改后的结果
     */
    public function remove($id)
    {
        return parent::save(array('status' => -1, 'id' => $id));
    }

    /**查询出status大于-1的数据
     * @return mixed
     */
    public function getList($field='*')
    {
        return $this->field($field)->where(array('status' => array('gt', -1)))->select();
    }

    /**得到分页数据和分页工具条
     * @param $keyword    搜索的关键字
     * @return array      二维数组 rows分页数据,pageHtml分页工具条
     */
    public function getPageResult($keyword,$supplier_id,$brand_id,$goods_category_id,$leaf)
    {
        if ($keyword) {
            $keyword = urldecode($keyword);
        }

        $wheres = array(
            'obj.status' => array('gt', -1),
            'obj.name' => array('like', "%$keyword%"),

        );
        if(!empty($supplier_id)){
            $wheres['obj.supplier_id'] = $supplier_id;
        }
        if(!empty($brand_id)){
            $wheres['obj.brand_id'] = $brand_id;
        }
        if(!empty($goods_category_id) && !empty($leaf)){
            $wheres['obj.goods_category_id'] = array('in',$leaf);
        }
        $this->alias('obj');
        $totalRows = $this->where($wheres)->count();//总条数
        $listRows = 2;//每页显示的条数

        $page = new Page($totalRows, $listRows);//thinkPHP的分页类
        $totalPages = ceil($page->totalRows / $page->listRows);//分页的总页数
        foreach ($page->parameter as $key => $value) {
            $page->parameter[$key] = urldecode($value);
        }
        /**
         * 为了保证当前页如果只有1条数据 删除后不会停留在当前页 而是回到删除后的最后一页
         */
        if ($page->parameter['p'] > $totalPages) { //如果当前页码大于总页数
            $page->firstRow = $page->totalRows - $page->listRows;//分页的起始页就等于总条数-每页显示条数
        }
        $this->alias('obj');
        //用来进行连接表查询
        $this->_setModel();
        $page->setConfig('theme', '%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');//thinkphp分页主题
        $pageHtml = $page->show();//生成分页工具条html
        $rows = $this->where($wheres)->limit($page->firstRow, $page->listRows)->select();//分页数据列表
        //处理$rows中的数据 将goods_status 变成三种状态
        $this->_handleRows($rows);
        return array('rows' => $rows, 'pageHtml' => $pageHtml, 'keyword' => $keyword);
    }

    /**
     * 该方法主要是被子类覆盖..
     */
    protected function _handleRows(&$rows){

    }

    /**
     * 该方法主要是被子类覆盖..
     */
    protected function _setModel(){

    }

    /**改变该数据的status
     * @param $id  该数据的id
     * @param int $status  该数据修改后的status值  默认为-1
     * @return bool  修改后的结果
     */
    public function changeStatus($id, $status = -1)
    {
        if ($status == -1) {
            // $id可能是具体的值 也可能是数组（批量删除）
            return parent::save(array('status' => $status, 'id' => array('in', $id), 'name' => array('exp', "concat(`name`,'_del')")));
        }
        return parent::save(array('status' => $status, 'id' => array('in', $id)));
    }
}