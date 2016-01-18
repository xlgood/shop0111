<?php
define('WEB_URL') or define('WEB_URL','http://www.shop.com/');
return array(
    'TMPL_PARSE_STRING'  =>array(
        '__CSS__' => WEB_URL.'Public/Home/css', // css文件路径
        '__JS__'  => WEB_URL.'Public/Home/js', // js文件路径
        '__IMG__' => WEB_URL.'Public/Home/images', // images文件路径
        '__UPLOADIFY__'=> WEB_URL.'Public/Admin/uploadify', // uploadify文件路径
        '__TREEGRID__' => WEB_URL.'Public/Admin/treegrid', // treegrid文件路径
        '__ZTREE__' => WEB_URL.'Public/Admin/zTree', // zTree文件路径
        '__UEDITOR__' => WEB_URL.'Public/Admin/ueditor', // zTree文件路径
        '__GOODS__' => 'http://itsource-goods.b0.upaiyun.com/', //代表brand_logo空间的域名
        '__BRAND__' => 'http://brand-logo.b0.upaiyun.com/', // Upyun下php1009-brand服务(空间)的域名
    ),
);