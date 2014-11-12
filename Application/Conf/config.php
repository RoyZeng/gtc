<?php
return array(
    'SHOW_ERROR_MSG'                =>          false,
    'SHOW_PAGE_TRACE'               =>          false,
    'TMPL_SWITCH_ON'                =>          true, // 启用多模版支持
    'TMPL_DETECT_THEME'             =>          true, // 自动侦测模板主题
    'DEFAULT_THEME'                 =>          'Default',
    'DEFAULT_LANG'                  =>          'zh-cn', // 默认语言
    'SITE_CHARSET'					=>			'UTF-8',
    'CACHE_TIME'					=>			60*60*12,
    'DATA_CACHE_SUBDIR'				=>			true, //缓存文件夹
    'DATA_PATH_LEVEL'				=>			3, //缓存文件夹层级
	'LOAD_EXT_CONFIG' 				=> 			'config_url,config_db',
	'VAR_PAGE'          			=>			'p',
    'TAGLIB_PRE_LOAD'               =>          'mall', //自动加载标签
	'APP_AUTOLOAD_PATH' 			=> 			'@.ORG,@.Lib,@.Tag,@.ORG.Image', //自动加载项目类库
	'APP_GROUP_LIST'            	=>			'Home,Admin',
    'DEFAULT_GROUP'             	=>  		'Home',
    'DEFAULT_MODULE'				=>			'Index',
    'APP_GROUP_MODE'                =>          0,
	'COOKIE_PREFIX' 				=>			'americanexpress_',
	'HTML_CACHE_ON'					=>			true,
	'VAR_FILTERS'					=>			'stripslashes,strip_tags',
    'TAG_NESTED_LEVEL'              =>          6,
    'TMPL_ACTION_SUCCESS'           =>          'Public:success',
    'TMPL_ACTION_ERROR'             =>          'Public:error',
    
    //静态路径
    'TMPL_PARSE_STRING'             =>          array(
        '__IMG__'    => __STATIC__ . '/images',
        '__CSS__'    => __STATIC__ . '/styles',
        '__JS__'     => __STATIC__ . '/scripts',
        '__UPLOAD__' => __UPLOAD__,
        '__PUBLIC__' => __PUBLIC__,
        '__ADMIN__'     => 'statics/admin/',
    ),
    //日志记录
    'LOG_EXCEPTION_RECORD'          =>          TRUE,
    'COOKIE_PREFIX' =>  'americanexpress_',
    //'COOKIE_DOMAIN' => '.mall.com'
);
?>