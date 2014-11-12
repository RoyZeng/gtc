<?php
class IndexAction extends FrontendAction {
	public function _initialize() {
        parent::_initialize();
        $this->_collections_mod = D('collections');
    }
    public function index(){
    	if($this->detect->isMobile()){
    		$num = 6;
    	}else{
    		$num = 20;
    	}

    	$list = $this->_collections_mod->index_list($num);
    	$this->assign('list',$list);
    	$this->_config_seo();

    	if($this->detect->isMobile()){
    		$this->display('mobile_index');
    	}else{
			$this->display();
		}
    }
    public function regUser($card = NULL){
    	empty($card) && $this->ajaxReturn(0,'error');
    	if( !is_numeric($card) ){
    		$this->ajaxReturn(0,'error');
    	}
    	$cardMod = D('card');
    	$data['card'] = $card;
    	$data['reg_time'] = time();
    	$data['status']   = '0';
    	$result = $cardMod ->data($data)->add();
    	if($result){
	    	$this->ajaxReturn(1,'success',$card);
	    }else{
	    	$this->ajaxReturn(0,'error');
	    }
    }
    public function mobile_regCard(){
    	$this->display();
    }
    public function download($file=null){
    	return Http::download('public/'.$file);
    }
    public function createImg(){
    	$collectionsMod = D('collections');
    	$imgMod = D('img_list');
    	$coordinate = $_POST['coordinate'];
		$imgList = $_POST['imgList'];
		$brandList = $_POST['brandList'];
		$nick_name = $_POST['nick_name'];
		$style_name = $_POST['style_name'];

		$coordinate    =  stripslashes($coordinate[0]);
		$imgList    =  stripslashes($imgList[0]);
		$brandList  = stripslashes($brandList[0]);

		$imgList  = json_decode($imgList,true);
		$brandList  = json_decode($brandList,true);
		$coordinate  = json_decode($coordinate,true);

		foreach ($coordinate as $key => $value) {
			$v[] = explode("|",$value);
		}
		$out = @imagecreatefromjpeg('statics/images/pic_bg.jpg');
		foreach ($imgList as $key => $value) {
			$pic[$key] = imagecreatefrompng($value);
			list($width[$key], $height[$key]) = getimagesize($value);
			if($this->detect->isMobile()){
				if ($height[$key] >= 100 || $width[$key] >=90){
					imagecopyresampled($out,$pic[$key], $v[$key][0],$v[$key][1],0, 0, $width[$key]*0.6, $height[$key]*0.6, $width[$key], $height[$key]);
				}
			}else{
				imagecopyresampled($out,$pic[$key], $v[$key][0],$v[$key][1],0, 0, $width[$key], $height[$key], $width[$key], $height[$key]);
			}
			
		}
		
		$img_name = md5(time());
		$img = $img_name.'.png';

		imagepng($out,$img);
		copy($img, 'upload/'.$img);

		imagedestroy($img);
		unlink($img);
		
		//保存产品数据
		$data = array();
		$data['nick'] = $nick_name;
		$data['style'] = $style_name;
		$data['path'] = $img;
		$data['create_time'] = time();
		$result = $collectionsMod ->data($data)->add();

		//保存选择的图片数据
		$data_img = array();
		foreach($brandList as $key => $val){
			$data_img[$key]['collections_id'] = $result;
			$data_img[$key]['brand'] = $val;
			$data_img[$key]['img'] = $imgList[$key];
		}
		foreach($data_img as $value){
			$imgMod ->data($value)->add();
		}
		$QRcode_path =  './upload/';
		QRcode::png(U('collections/details@'.$_SERVER['SERVER_NAME'],array('id'=>$result)), $QRcode_path.$img_name.'_qr.png', 'L',6, 2); 
		$data['qr'] = $QRcode_path.$img_name.'_qr.png';
		
		$this->ajaxReturn(1,'success',$data);
    }
    
}