<?php
define('WEB_URL') or define('WEB_URL','http://admin.shop.com/');
return array(
	//'配置项'=>'配置值'
    'TMPL_PARSE_STRING'  =>array(
        '__CSS__' => WEB_URL.'Public/Admin/css', // css文件路径
        '__JS__'  => WEB_URL.'Public/Admin/js', // js文件路径
        '__IMG__' => WEB_URL.'Public/Admin/images', // images文件路径
        '__UPLOADIFY__'=> WEB_URL.'Public/Admin/uploadify', // uploadify文件路径
        '__TREEGRID__' => WEB_URL.'Public/Admin/treegrid', // treegrid文件路径
        '__ZTREE__' => WEB_URL.'Public/Admin/zTree', // zTree文件路径
        '__UEDITOR__' => WEB_URL.'Public/Admin/ueditor', // zTree文件路径
        '__GOODS__' => 'http://itsource-goods.b0.upaiyun.com/', //代表brand_logo空间的域名
        '__BRAND__' => 'http://brand-logo.b0.upaiyun.com/', // Upyun下php1009-brand服务(空间)的域名
    ),
    'UPLOAD_CONFIG'=>array(
        //'rootPath'     => './Uploads/', //保存根路径
        'rootPath'     => './', //保存到upyun的根路径
        //'savePath'     => $dir.'/', //保存路径
        'driver'       => 'Upyun', // 文件上传驱动
        'driverConfig' => array(
            'host'     => 'v0.api.upyun.com', //又拍云服务器
            'username' => 'itsource', //又拍操作员用户
            'password' => 'itsource', //又拍云操作员密码
            'timeout'  => 90, //超时时间
        ) // 上传驱动配置
    )
);