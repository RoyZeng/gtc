<?php
/*
$png = imagecreatefrompng('./1.png');
$jpg = imagecreatefrompng('./2.png');
$dd = imagecreatefromjpeg('./top.jpg');

list($width, $height) = getimagesize('./2.png');
list($newwidth, $newheight) = getimagesize('./1.png');
list($w, $h) = getimagesize('./top.jpg');
$out = imagecreatetruecolor($newwidth, $newheight);
imagecopyresampled($out, $png, 0, 0, 0, 0, $newwidth, $newheight, $newwidth, $newheight);
imagecopyresampled($out, $jpg, 0, 0, 0, 0, $width, $height, $width, $height);
imagecopyresampled($out, $dd, 100, 100, 0, 0, $w, $h, $w, $h);
/*左，上,zindex*/

//imagejpeg($out, 'out.jpg', 100);


//exit();

define('APP_DEBUG', FALSE);
define("PATH_INC", dirname(__FILE__).DIRECTORY_SEPARATOR);
//定义项目名称和路径
define('APP_NAME','Application');
define('THINK_PATH',PATH_INC.'ThinkPHP/');
define('APP_PATH',PATH_INC.APP_NAME.'/');
/* 扩展目录*/
define('EXTEND_PATH', APP_PATH . 'Extend/');
/* 数据目录*/
define('MALL_DATA_PATH', './Data/');
define('BACKUP_PATH', MALL_DATA_PATH.'backup/');
define('RUNTIME_PATH', MALL_DATA_PATH . 'Runtime/');
require( THINK_PATH."ThinkPHP.php");