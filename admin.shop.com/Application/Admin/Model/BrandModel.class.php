<?php

namespace Admin\Model;


use Think\Model;
use Think\Page;

class BrandModel extends BaseModel{
    //进行自动验证
    protected $_validate = array(
        array('name','require','供应商名称不能为空！'), //默认情况下用正则进行验证
        array('url','require','网址不能为空！'), //默认情况下用正则进行验证
        array('name','','供应商名称不能重复！','','unique'), //供应商名称不能重复
        array('intro','require','供应商描述不能为空！'), //默认情况下用正则进行验证
    );

}