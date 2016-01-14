<?php
define('WEB_URL') or define('WEB_URL','http://admin.shop.com/');
return array(
	//'配置项'=>'配置值'
    'TMPL_PARSE_STRING'  =>array(
        '__CSS__' => WEB_URL.'Public/Admin/css', // css文件路径
        '__JS__'  => WEB_URL.'Public/Admin/js', // js文件路径
        '__IMG__' => WEB_URL.'Public/Admin/images', // images文件路径
        '__UPLOADIFY__' => WEB_URL.'Public/Admin/uploadify', // uploadify文件路径
        '__TREEGRID__' => WEB_URL.'Public/Admin/treegrid', // treegrid文件路径
        '__ZTREE__' => WEB_URL.'Public/Admin/zTree', // zTree文件路径
        '__BRAND__' => 'http://php1009-brand.b0.upaiyun.com/', // Upyun下php1009-brand服务(空间)的域名
    ),
    'UPLOAD_CONFIG'=>array(
        'rootPath'     => './', //保存根路径
//            'rootPath'     => './Uploads/', //保存根路径
//            'savePath'     => $dir.'/', //保存路径
        'driver'       => 'Upyun', // 文件上传驱动
//            'driver'       => '', // 文件上传驱动
        'driverConfig' => array(
            'host'     => 'v0.api.upyun.com', //又拍云服务器
            'username' => 'php1009', //又拍云操作员
            'password' => 'php1009brand', //又拍云操作员密码
            'bucket'   => $dir, //服务名称
            'timeout'  => 90, //超时时间
        )
    )
);