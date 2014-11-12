<?php
class collectionsModel extends AdvModel {

    public function index_list ($num){
        $list = $this->order('create_time DESC')->limit($num)->select();
        return $list;
    }
    public function alllist($skip = 0, $limit = 10) {
    	$list = $this->order('create_time DESC')->limit($skip, $limit)->select();
    	return $list;
    }
    public function getCollectionsNum(){
    	$CollectionsNum = $this->count('id');
        return $CollectionsNum;
    }
    public function getDetails($id){
        $info = $this->where(array('id'=>$id))->find();
        $info['img'] = unserialize($info['img_list']);
        return $info;
    }
}
