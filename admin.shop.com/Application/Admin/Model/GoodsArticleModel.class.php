<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/1/18
 * Time: 22:13
 */

namespace Admin\Model;


use Think\Model;

class GoodsArticleModel extends Model{
    //SELECT obj.article_id,a.`name` FROM goods_article as obj JOIN article as a ON obj.article_id=a.id WHERE obj.goods_id=16
    public function getArticel($goods_id){
        $this->field('obj.article_id,a.`name`');
        $this->alias('obj')->join('__ARTICLE__ as a on obj.article_id=a.id');
        $this->where(array('obj.goods_id'=>$goods_id));
        return $this->select();
    }
}