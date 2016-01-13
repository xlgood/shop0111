<?php


namespace Admin\Model;


use Think\Model;
use Think\Page;

class SupplierModel extends BaseModel{
    //进行自动验证
    protected $_validate = array(
    array('name','require','供应商名称不能为空！'), 
array('sort','require','排序不能为空！'), 
array('status','require','是否显示不能为空！'), 
    );


}