<?php


namespace Admin\Model;


use Think\Model;
use Think\Page;

class BrandModel extends BaseModel{
    //进行自动验证
    protected $_validate = array(
        array('name','require','品牌名称不能为空！'),
        array('url','require','品牌网址不能为空！'),
        array('logo','require','品牌LOGO不能为空！'),
    );


}