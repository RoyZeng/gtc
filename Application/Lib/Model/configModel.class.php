<?php
class configModel extends Model {
    /**
     * 获取配置列表
     * @return array 配置数组
     */
    public function lists(){
        $config = array();
        $res = $this->getField('name,value');
        foreach ($res as $key=>$val) {
            $config[$key] = unserialize($val) ? unserialize($val) : $val;
        }
        F('config', $config);
        return $config;
    
    }

    /**
     * 根据配置类型解析配置
     * @param  integer $type  配置类型
     * @param  string  $value 配置值
     */
    private function parse($type, $value){
        switch ($type) {
            case 3: //解析数组
                $array = preg_split('/[,;\r\n]+/', trim($value, ",;\r\n"));
                if(strpos($value,':')){
                    $value  = array();
                    foreach ($array as $val) {
                        list($k, $v) = explode(':', $val);
                        $value[$k]   = $v;
                    }
                }else{
                    $value =    $array;
                }
                break;
        }
        return $value;
    }

    /**
     * 后台有更新则删除缓存
     */
    protected function _before_write($data, $options) {
        F('config', NULL);
    }

}
