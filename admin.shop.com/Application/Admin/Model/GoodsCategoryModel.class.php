<?php


namespace Admin\Model;


use Admin\Service\NestedSetsService;
use Think\Model;
use Think\Page;

class GoodsCategoryModel extends BaseModel{
    //进行自动验证
    protected $_validate = array(
    array('name','require','分类名称不能为空！'), 
    array('parent_id','require','父分类不能为空！'),
    array('status','require','是否显示不能为空！'),
    );

    /**返回分类数据
     * @param bool|false $isJson  true表示返回Json数据 false返回正常数据
     * @return string   返回分类数据
     */
    public function getTreeList($isJson=false,$field='*'){
        $rows =  $this->field($field)->where(array('status'=>array('egt',0)))->order('lft')->select();
        if($isJson){
            return json_encode($rows);
        }else{
            return $rows;
        }
    }

    /**添加分类
     * @return false|int 失败返回false 成功返回最后插入的id
     */
    public function add(){
        //实现了DbMysqlInterface接口的类
        $dbMysql = new DbMysqlInterfaceImplModel();
        //通过NestedSetsService里面的方法来计算边界
        $nestedSetsService = new NestedSetsService($dbMysql,'goods_category','lft','rgt','parent_id','id','level');
        //通过insert方法将添加的节点信息保存到数据库
        return $nestedSetsService->insert($this->data['parent_id'],$this->data,'bottom');
    }

    /**编辑分类
     * @return bool
     */
    public function save(){
        //实现了DbMysqlInterface接口的类
        $dbMysql = new DbMysqlInterfaceImplModel();
        //通过NestedSetsService里面的方法来计算边界
        $nestedSetsService = new NestedSetsService($dbMysql,'goods_category','lft','rgt','parent_id','id','level');
        //移动节点到父分类下面
        $nestedSetsService->moveUnder($this->data['id'],$this->data['parent_id'],'bottom');
        //将其他数据修改
        return parent::save();
    }

    /**改变该分类及其子孙分类的status
     * @param $id  该数据的id
     * @param int $status  该数据修改后的status值  默认为-1
     * @return bool  修改后的结果
     */
    public function changeStatus($id, $status = -1)
    {
        //>>1.根据自己的id找到自己以及子孙节点的id
        $sql = "select child.id from  goods_category as child,goods_category as parent where  parent.id = {$id}  and child.lft>=parent.lft  and child.rgt<=parent.rgt";
        $rows = $this->query($sql);
        $id = array();
        foreach($rows as $value){
            $id[] = $value['id'];
        }
//        dump($id);
//        exit;
        if ($status == -1) {
            // $id可能是具体的值 也可能是数组（批量删除）
            return parent::save(array('status' => $status, 'id' => array('in', $id), 'name' => array('exp', "concat(`name`,'_del')")));
        }
        return parent::save(array('status' => $status, 'id' => array('in', $id)));
    }
}