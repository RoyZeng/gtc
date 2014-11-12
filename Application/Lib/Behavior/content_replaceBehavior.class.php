<?php
/**
 * 行为扩展：模板内容输出替换
 */
class content_replaceBehavior extends Behavior{

    public function run(&$content){
        $content = $this->_replace($content);
    }

    private function _replace($content) {
        $replace = array();
        //静态资源地址
        $statics_url = C('WEB_STATICS_URL');
        $public_url  = C('web_public_url');
        $upload_url  = C('web_upload_url');
        if ($statics_url != '') {
            $replace['__STATIC__'] = $statics_url;
        } else {
            $replace['__STATIC__'] = __ROOT__.'/statics';
        }
        if ($public_url != '') {
            $replace['__PUBLIC__'] = $public_url;
        } else {
            $replace['__PUBLIC__'] = __ROOT__.'/public';
        }
        if ($upload_url != '') {
            $replace['__UPLOAD__'] = $upload_url;
        } else {
            $replace['__UPLOAD__'] = __ROOT__.'/upload';
        }
        $content = str_replace(array_keys($replace),array_values($replace),$content);
        return $content;
    }
}