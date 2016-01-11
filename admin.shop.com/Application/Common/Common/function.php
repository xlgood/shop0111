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