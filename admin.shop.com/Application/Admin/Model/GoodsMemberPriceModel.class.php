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
        //�õ�goods_member_price���е�member_level_id��price����
        $rows = $this->field('member_level_id,price')->where(array('goods_id'=>$goods_id))->select();
        //ȡ��$rows��ֵΪmember_level_id��һ������
        $member_level_ids = array_column($rows,'member_level_id');
        //ȡ��$rows��ֵΪprice��һ������
        $prices = array_column($rows,'price');
        //��$member_level_ids�ļ�ֵ��Ϊ������$prices�ļ�ֵ��Ϊ��ֵ
        $row = array_combine($member_level_ids,$prices);
        //$row = array(
//            ��Ա����id=>�۸�,
//            ��Ա����id=>�۸�,
//            ��Ա����id=>�۸�,
//            ��Ա����id=>�۸�,
        //)
        return $row;
    }
}