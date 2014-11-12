<?php

/**
 * 合并加载JS和CSS文件
 *
 */
class loadTag {

    private $jm;
    private $dir;

    function __construct() {
        $this->jm = new JSMin();
        $this->dir = new Dir();
    }

    public function CSS($options) {
        $path =  C('STATICS_ROOT').'styles/' . md5($options['href']) . '.css';
        $statics_url = C('STATICS_ROOT');
        if (!is_file($path)) {
            //静态资源地址
            $files = explode(',', $options['href']);
            $content = '';
            foreach ($files as $val) {
                $val = str_replace('__STATIC__', $statics_url, $val);
                $content.=file_get_contents($val);
            }
            file_put_contents($path, $this->jm->minify($content));
        }
        echo ( '<link rel="stylesheet" type="text/css" href="'.C('STATICS_ROOT').'styles/' . md5($options['href']) . '.css?v='.time().'">'."\n");
    }
}