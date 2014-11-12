<?php
class IndexAction extends BackendAction {

    public function _initialize() {
        parent::_initialize();
    }

    public function index() {
        $this->top_menu();
        $my_admin = array('username'=>$_SESSION['admin']['username'], 'nick'=>$_SESSION['admin']['nick']);
        $this->assign('my_admin', $my_admin);
        $this->display();
    }
    public function top_menu(){
        $menu = array(
            '0'=> array(
                'alias'=>'left',
                'name'=>'控制台'
            ),
            '1'=> array(
                'alias'=>'lesson',
                'name'=>'作品'
            ),
            
            '2'=> array(
                'alias'=>'user',
                'name'=>'用户'
            )
            
        );
        $this->assign('top_menu',$menu);
    }
    public function panel() {



        $message = array();

        if (APP_DEBUG == true) {
            $message[] = array(
                'type' => 'error',
                'content' => "您网站的 DEBUG 没有关闭，出于安全考虑，我们建议您关闭程序 DEBUG。",
            );
        }
        if (!function_exists("curl_getinfo")) {
            $message[] = array(
                'type' => 'error',
                'content' => "系统不支持 CURL ,将无法采集商品数据。",
            );
        }
        $this->assign('message', $message);
        $system_info = array(
            'system_version' => '1.0.0',
            'server_domain' => $_SERVER['SERVER_NAME'] . ' [ ' . gethostbyname($_SERVER['SERVER_NAME']) . ' ]',
            'server_os' => PHP_OS,
            'web_server' => $_SERVER["SERVER_SOFTWARE"],
            'php_version' => PHP_VERSION,
            'mysql_version' => mysql_get_server_info(),
            'upload_max_filesize' => ini_get('upload_max_filesize'),
            'max_execution_time' => ini_get('max_execution_time') . '秒',
            'safe_mode' => (boolean) ini_get('safe_mode') ?  L('yes') : L('no'),
            'zlib' => function_exists('gzclose') ?  L('yes') : L('no'),
            'curl' => function_exists("curl_getinfo") ? L('yes') : L('no'),
            'timezone' => function_exists("date_default_timezone_get") ? date_default_timezone_get() : L('no')
        );
        $this->assign('system_info', $system_info);
        $this->display();
    }

    public function login() {
        if (IS_POST) {
            $username = $this->_post('username', 'trim');
            $password = $this->_post('password', 'trim');
            $verify_code = $this->_post('verify_code', 'trim');
            if(session('verify') != md5($verify_code)){
                $this->error(L('verify_code_error'));
            }
            $admin = M('admin')->where(array('username'=>$username, 'status'=>1))->find();
            if (!$admin) {
                $this->error(L('admin_not_exist'));
            }
            if ($admin['password'] != md5($password)) {
                $this->error(L('password_error'));
            }
            session('admin', array(
                'id' => $admin['id'],
                'username' => $admin['username'],
                'nick' => $admin['nick'],
            ));
            M('admin')->where(array('id'=>$admin['id']))->save(array('last_time'=>time(), 'last_ip'=>get_client_ip()));
            $this->success(L('login_success'), U('index/index'));
        } else {
            $this->display();
        }
    }

    public function logout() {
        session('admin', null);
        $this->success(L('logout_success'), U('index/login'));
        exit;
    }

    public function verify_code() {
        Image::buildImageVerify(4,1,'gif','50','30');
    }

    public function left() {
        $alias = $this->_request('alias');
        if ($alias) {
            $this->display($alias);
        } else {
            $this->display();
        }
        
    }

    
}