<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/1/17
 * Time: 21:21
 */

namespace Admin\Model;


use Think\Model;

class GoodsMemberPriceModel extends Model{

    public function getMemberPrice($goods_id){
        //得到goods_member_price表中的member_level_id和price数据
        $rows = $this->field('member_level_id,price')->where(array('goods_id'=>$goods_id))->select();
        //取出$rows键值为member_level_id的一列数据
        $member_level_ids = array_column($rows,'member_level_id');
        //取出$rows键值为price的一列数据
        $prices = array_column($rows,'price');
        //用$member_level_ids的键值作为键名，$prices的键值作为键值
        $row = array_combine($member_level_ids,$prices);
        //$row = array(
//            会员级别id=>价格,
//            会员级别id=>价格,
//            会员级别id=>价格,
//            会员级别id=>价格,
        //)
        return $row;
    }
}