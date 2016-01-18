<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/1/18
 * Time: 1:13
 */

namespace Admin\Controller;


use Think\Controller;

class GoodsPhotoController extends Controller{
    public function remove($id){
        $goodsPhotoModel = M('GoodsPhoto');
        $result = $goodsPhotoModel->delete($id);
        if($result!==false){
            $this->success('É¾³ý³É¹¦');
        }else{
            $this->error('É¾³ýÊ§°Ü');
        }
    }
}