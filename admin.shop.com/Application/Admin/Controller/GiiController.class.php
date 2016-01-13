<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/1/11
 * Time: 23:47
 */

namespace Admin\Controller;


use Think\Controller;

class GiiController extends Controller{
    public function index(){
        if(IS_POST){
            header('Content-Type: text/html;charset=utf-8');
            $table_name = I('post.table_name');//得到用户输入的表名

            $name = parse_name($table_name,1);  //通过表名生成符合TP规范的名字
            //通过表名得到表的注解
            $sql = "SELECT TABLE_COMMENT FROM information_schema.`TABLES` WHERE TABLE_SCHEMA= '".C('DB_NAME')."' AND TABLE_NAME='$table_name'";
            $model = M();
            $rows = $model->query($sql);
            $meta_title = $rows[0]['table_comment'];//得到表的注解

            //查询表中字段信息 为视图页面和模型提供数据
            $sql = "SHOW FULL COLUMNS FROM ".$table_name;
            $fields = $model->query($sql);//表中所有的字段信息
            //对字段信息进一步处理 根据注解提取出字段名 字段类型和可选值
            foreach($fields as $k=>&$field){ //注意这里是引用传值&
                if($field['field']=='id'){   //将id信息删除，以便在视图页面循环输出其他数据
                    unset($fields[$k]);
                }
                $comment = $field['comment']; //得到注解信息
                if(strpos($comment,'@')!==false){  //如果注解信息里面有@符号
                    $pattem = '/(.*)@([a-z]*)\|?(.*)/';  //匹配注解信息的增则表达式
                    preg_match($pattem,$comment,$result); //将结果保存在了$result中
                    $field['comment'] = $result[1];  //将$result[1]作为字段名字
                    $field['field_type'] = $result[2]; //将$result[2]作为字段类型
                    if(!empty($result[3])){ //如果$result[3]有值的话
                        parse_str($result[3],$option_values); //将$result[3]转化为数组$option_values
                        $field['option_values'] = $option_values; //将$option_values作为可选值数组
                    }
                }

            }
            unset($field);//由于上面引用传值的$field 这里将其销毁 不然会引起一些问题

            define('TPL_PATH') or define('TPL_PATH',ROOT_PATH.'Template/'); //定义代码模板目录

            //生成控制器
            require TPL_PATH.'Controller.tpl'; //生成控制器内容
            $controller_content = "<?php\r\n".ob_get_clean();//得到控制器内容
            $conreoller_path = APP_PATH.'Admin/Controller/'.$name.'Controller.class.php'; //生成的控制器路径
            file_put_contents($conreoller_path,$controller_content); //生成控制器文件

            //生成模型
            ob_start();//再次开启ob缓存
            require TPL_PATH.'Model.tpl'; //生成模型内容
            $model_content = "<?php\r\n".ob_get_clean();//得到模型内容
            $model_path = APP_PATH.'Admin/Model/'.$name.'Model.class.php'; //生成的模型路径
            file_put_contents($model_path,$model_content); //生成模型文件

            //生成edit页面
            ob_start();//再次开启ob缓存
            require TPL_PATH.'edit.tpl'; //生成页面内容
            $edit_content = ob_get_clean();//得到页面内容
            $edit_dir = APP_PATH.'Admin/View/'.$name;  //页面存放路径
            if(!is_dir($edit_dir)){
                mkdir($edit_dir,0777,true);   //如果路径不存在则递归创建
            }
            $edit_path = $edit_dir.'/edit.html'; //生成的页面路径
            file_put_contents($edit_path,$edit_content); //生成视图文件

            //生成index页面
            ob_start();//再次开启ob缓存
            require TPL_PATH.'index.tpl'; //生成页面内容
            $index_content = ob_get_clean();//得到页面内容
            $index_dir = APP_PATH.'Admin/View/'.$name;  //页面存放路径
            if(!is_dir($index_dir)){
                mkdir($index_dir,0777,true);   //如果路径不存在则递归创建
            }
            $index_path = $index_dir.'/index.html'; //生成的页面路径
            file_put_contents($index_path,$index_content); //生成视图文件

            $this->success('生成成功',U('index'));
        }else{
            $this->assign('meta_title','代码生成器');
            $this->display('index');
        }

    }
}