<?php
header('Content-Type: text/html;charset=utf-8');
/**拼接错误信息
 * @param $supplierModel  错误信息所在的模型
 * @return string         以ul li形式拼接的错误信息
 */
function show_model_error($model)
{
    $errors = $model->getError();//得到错误信息
    $errorMsg = '<ul>';//拼接错误信息为ul
    if (is_array($errors)) {//如果错误信息是数组
        foreach ($errors as $error) {
            $errorMsg .= "<li>$error</li>";//将错误信息拼成li
        }
    } else {//如果不是数组
        $errorMsg .= "<li>$errors</li>";
    }
    $errorMsg .= '</ul>';
    return $errorMsg;
}

/**根据传入的二维数组得到由每个元素中相同键名的键值组成的一维数组
 * @param $arr     二维数组
 * @param $field   每个元素中相同的键名
 * @return array   最后得到的一维数组
 */
if(!function_exists('array_column')){  //如果不存在该函数才定义  兼容性处理(事实上，在php5.5及以上的版本中存在该函数)
    function array_column($arr,$field){
        $result = array();
        foreach($arr as $v){
            $result[] = $v[$field];
        }
        return $result;
    }
}

/**生成select
 * @param $name            select的name属性
 * @param $data            select的数据源
 * @param $valueField      option的value属性
 * @param $textValue       option显示的文本
 * @param $defaultValue    option的默认值 用于编辑是选中
 */
function arr2select($name,$data,$defaultValue='',$valueField='id',$textValue='name'){
    $select = "<select class='$name' name='$name'>";
    $select .= "<option value=''>--请选择--</option>";
    if(is_array($data)){
        foreach ($data as $v) {
            $selected = '';
            if($defaultValue==$v[$valueField]){
                $selected = 'selected';
            }
            $select .= "<option value='{$v[$valueField]}' $selected>{$v[$textValue]}</option>";
        }
    }
    $select .= "</select>";
    echo $select;
}