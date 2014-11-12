<?php
class ConfigAction extends BackendAction {

    public function _initialize() {
        parent::_initialize();
        $this->_mod = D('config');
    }
    public function index() {
        $type = $this->_get('type', 'trim', 'index');
        $this->display($type);
    }
    public function mail() {
        $this->display();
    }
    public function url() {
        $config_file = CONF_PATH . 'config_url.php';
        $config = require $config_file;
        if (IS_POST) {
            $url_model = $this->_post('url_model', 'intval', 0);
            $url_suffix = $this->_post('url_suffix', 'trim');
            $url_depr = $this->_post('url_depr', 'trim');
            $new_config = array(
                'URL_MODEL' => $url_model,
                'URL_HTML_SUFFIX' => $url_suffix,
                'URL_PATHINFO_DEPR' => $url_depr,
            );
            if ($this->update_config($new_config, $config_file)) {
                $this->success(L('operation_success'));
            } else {
                $this->error(L('file_no_authority'));
            }
        } else {
            $this->assign('config', $config);
            $this->display();
        }
    }
    public function page() {
        $setting_mod = D('config');
        if (IS_POST) {
            $seo_config = $this->_post('seo_config', ',');
            $seo_config = serialize($seo_config);
            $setting_mod->where(array('name'=>'WEB_SEO_CONFIG'))->save(array('value'=>$seo_config));
            $this->success(L('operation_success'));
        } else {
            $seo_config = $setting_mod->where(array('name'=>'WEB_SEO_CONFIG'))->getField('value');
            $this->assign('seo_config', unserialize($seo_config));
            $this->display();
        }
    }
    public function edit() {
        $setting = $this->_post('setting', ',');
        foreach ($setting as $key => $val) {
            $val = is_array($val) ? serialize($val) : $val;
            $this->_mod->where(array('name' => $key))->save(array('value' => $val));
        }
        $type = $this->_post('type', 'trim', 'index');
        $this->success(L('operation_success'));
    }

}