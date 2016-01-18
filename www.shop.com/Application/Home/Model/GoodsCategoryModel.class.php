<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/1/19
 * Time: 1:13
 */

namespace Home\Model;


use Think\Model;

class GoodsCategoryModel extends Model{

    /**查询出表中所有数据
     * @return mixed
     */
    public function getList(){
        $rows = $this->field('id,name,parent_id,level')->where(array('status'=>1))->order('lft')->select();
        return $rows;
    }
}