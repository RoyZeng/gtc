<?php
/*禁止IP访问*/
class check_ipbanBehavior extends Behavior{

    public function run(&$params){
        if (false === $config =  F('config')) {
            $config = D('config')->lists();
        }
        if (!$config['web_ipban_switch'] || in_array(GROUP_NAME, array('Admin'))) return false;
        $ip = get_client_ip();
        $ipban_mod = D('ipban');
        $ipban_mod->clear(); //清除过期数据
        $isban = $ipban_mod->where(array('type'=>'ip', 'name'=>$ip))->count();
        header('Content-Type:text/html; charset=utf-8');
        $isban && exit('对不起，您的IP被禁止访问本站！');

    }
}