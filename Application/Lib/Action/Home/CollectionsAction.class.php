<?php
class CollectionsAction extends FrontendAction {
    public function _initialize() {
        parent::_initialize();
        $this->_collections_mod = D('collections');
    }
    public function index(){
        $count =  $this->_collections_mod->getCollectionsNum();
        $pager = new Page($count, 10);
        $list = $this->_collections_mod->alllist($pager->firstRow, $pager->listRows);
        $this->assign('list',$list);

        $pager->setConfig('theme','%upPage% %first% %prePage% %linkPage% %nextPage% %downPage%  %end%');
        $page = $pager->show();
        
        $this->assign("page", $page);

    	$this->_config_seo(C('WEB_SEO_CONFIG.collections'), array(
            'seo_title' => C('WEB_SEO_CONFIG.collections.title'),
            'seo_keywords' => C('WEB_SEO_CONFIG.collections.keywords'),
            'seo_description' => C('WEB_SEO_CONFIG.collections.description')
        ));
		if($this->detect->isMobile()){
            $this->display('mobile_index');
        }else{
            $this->display();
        }
    }

    
    public function details($id = NULL){
        $info = $this->_collections_mod->getDetails($id);
        $img = D('img_list')->where(array('collections_id'=>$id))->select();
        $brand=array();
        foreach ( $img as $key => $val ) {
            $brand[]=$val['brand'];
        }
        $brand=array_unique($brand);
        foreach ($brand as $key=>$val){
    
            foreach ($img as $k=>$v){
                if ($v['brand']==$val){
                    $imgArr[$key]['id']=$v['id'];
                    $imgArr[$key]['collections_id']=$v['collections_id'];
                    $imgArr[$key]['brand']=$v['brand'];
                    $imgArr[$key]['img'][]=$v['img'];
                }
            }
        }


        $this->assign('info',$info);
        $this->assign('img',$imgArr);
        $this->_config_seo(C('WEB_SEO_CONFIG.collections'), array(
            'seo_title' => C('WEB_SEO_CONFIG.collections.title'),
            'seo_keywords' => C('WEB_SEO_CONFIG.collections.keywords'),
            'seo_description' => C('WEB_SEO_CONFIG.collections.description')
        ));
        if($this->detect->isMobile()){
            $this->display('mobile_details');
        }else{
            $this->display();
        }
    }
}