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
        $dir = I('post.dir');  //��ȡ�����ָ���ķ���(�ռ�)
        $config = C('UPLOAD_CONFIG');

        //����������� �ռ�
        $config['driverConfig']['bucket'] = $dir;
//        dump($config);
//        exit;
        $uploader = new Upload($config);
        $result = $uploader->uploadOne($_FILES['Filedata']);
        if($result!==false){
            //���ϴ����·�����͸������
            echo $result['savepath'].$result['savename']; //���浽upyun�ϵĵ�ַ
        }else{
            echo $uploader->getError();
        }
    }
}