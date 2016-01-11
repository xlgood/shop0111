<?php
define('WEB_URL') or define('WEB_URL','http://admin.shop.com/');
return array(
	//'配置项'=>'配置值'
    'TMPL_PARSE_STRING'  =>array(
        '__CSS__' => WEB_URL.'Public/Admin/css', // css文件路径
        '__JS__'  => WEB_URL.'Public/Admin/js', // js文件路径
        '__IMG__' => WEB_URL.'Public/Admin/images', // images文件路径
    )

);