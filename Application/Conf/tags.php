<?php
// 系统默认的核心行为扩展列表文件
return array(
	'app_begin' => array(
        'check_ipban', //禁止IP
        'load_lang', //语言
    ),
    'view_template' => array(
        'basic_template','_overlay'=>1, //自动定位模板文件
    ),
    'view_filter' => array(
        'content_replace',
    ),
    /*
    'login_end' => array(
        'alter_score', // 积分
    ),
    'register_end' => array(
        'alter_score', // 积分
    ),
    */
);