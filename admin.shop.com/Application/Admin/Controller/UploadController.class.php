<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/1/13
 * Time: 1:53
 */

namespace Admin\Controller;


use Think\Controller;
use Think\Upload;

class UploadController extends Controller{
    public function index(){
        $dir = I('post.dir');
        $config = C('UPLOAD_CONFIG'); // ÉÏ´«Çý¶¯ÅäÖÃ
//        dump($_FILES['Filedata']);
//        exit;
        $uploader = new Upload($config);
        $result = $uploader->uploadOne($_FILES['Filedata']);
        if($result!==false){
            echo $result['savepath'].$result['savename'];
        }else{
            echo $uploader->getError();
        }
    }
}