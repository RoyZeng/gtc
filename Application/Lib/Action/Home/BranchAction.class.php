<?php
class BranchAction extends FrontendAction {
    public function index(){
    	$this->_config_seo(C('WEB_SEO_CONFIG.branch'), array(
            'seo_title' => C('WEB_SEO_CONFIG.branch.title'),
            'seo_keywords' => C('WEB_SEO_CONFIG.branch.keywords'),
            'seo_description' => C('WEB_SEO_CONFIG.branch.description')
        ));
		if($this->detect->isMobile()){
            $this->display('mobile_index');
        }else{
            $this->display();
        }
    }

    public function list_search($list,$condition) {
	    if(is_string($condition))
	        parse_str($condition,$condition);
	    // 返回的结果集合
	    $resultSet = array();
	    foreach ($list as $key=>$data){
	        $find   =   false;
	        foreach ($condition as $field=>$value){
	            if(isset($data[$field])) {
	                if(0 === strpos($value,'/')) {
	                    $find   =   preg_match($value,$data[$field]);
	                }elseif($data[$field]==$value){
	                    $find = true;
	                }
	            }
	        }
	        if($find)
	            $resultSet[]  =  &$list[$key];
	    }
	    return $resultSet;
	}
    
	public function branch_list($bank=NULL,$city = NULL){
		$list = F($bank.'_list');
		$list = $this->list_search($list,array('city'=>$city));
		$this->ajaxReturn(1,'success',$list);
	}

	

	public function impExl(){
		$result = $this->importExecl('./icbc.xls');
		if($result["error"] == 1){          
			$execl_data = $result["data"][0]["Content"];
			$data = array();
			foreach($execl_data as $k=>$v){
				$data[$k]['city'] = $v[0];
				$data[$k]['name'] = $v[1];
				$data[$k]['branch'] = $v[2];
				$data[$k]['address'] = $v[3];
				$data[$k]['tel'] = $v[4];
				$data[$k]['status'] = 1;
				$data[$k]['create_time'] = time();
				$User->data($data)->add();
			}
			//print_r($data);
			//F('bcm_list',$data);
		}
	}
	public function read(){
		$execl_data = F('icbc_list');
		$data = array();
		foreach($execl_data as $k=>$v){
			$data[$k]['city'] = $v[0];
			$data[$k]['name'] = $v[1];
			$data[$k]['branch'] = $v[2];
			$data[$k]['address'] = $v[3];
			$data[$k]['tel'] = $v[4];
			$data[$k]['status'] = 1;
			$data[$k]['create_time'] = time();
			D('bank')->data($data)->add();
		}
	}


	
}