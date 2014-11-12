<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html><html><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no, minimal-ui"><meta name="apple-mobile-web-app-capable" content="yes"><meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"><title><?php echo ($page_seo["title"]); ?></title><link rel="stylesheet" type="text/css" href="__CSS__/common.css" /><link rel="stylesheet" type="text/css" href="__CSS__/mobile_layout.css" /><script src="http://libs.baidu.com/jquery/1.8.3/jquery.min.js"></script><script type="text/javascript">			var AECONGIF = {
				"root"   	: "http://<?php echo ($home_url); ?>", //站点URL
				"public" 	: "__PUBLIC__", //项目公共目录地址
				"statics" 	: "__STATIC__", //静态文件目录
				"upload" 	: "__UPLOAD__",	//上传目录
			}
			var mobile = true;
	</script></head><body><header><div class="container"><a href="<?php echo U('/index');?>" class="logo"><img src="__IMG__/logo.png" /></a><a href="https://www.americanexpress.com/china/personal/travel/prepaid_travel_card/"><img src="__IMG__/top_card.png" class="right_card" /></a><nav><ul class="fn-clear"><!--<li><a href="<?php echo U('collections/index');?>">查看作品</a></li>--><li><a href="javascript:void(0);" data-scorll="game_intro">活动介绍</a></li><li><a href="javascript:void(0);" data-scorll="pro_intro">产品简介</a></li><li><a href="javascript:void(0);" data-scorll="download">下载锦囊</a></li><li><a href="<?php echo U('branch/index');?>">办理网点</a></li><li><a href="<?php echo U('index/mobile_regCard');?>">新卡注册</a></li></ul></nav></div></header><script>
window.shareData = {
    "imgUrl": "__UPLOAD__/<?php echo ($info["path"]); ?>",
    "timeLineLink": location.href,
    "tTitle": "你购时尚吗",
    "tContent": "快来看我的纽约街头最fashion搭配！现在用美国运通电子旅行支票在纽约麦迪逊大街shopping还能获得专属优惠呢"
};
document.addEventListener('WeixinJSBridgeReady', function onBridgeReady() {
            
    WeixinJSBridge.on('menu:share:appmessage', function(argv) {
        WeixinJSBridge.invoke('sendAppMessage', {
            "img_url": window.shareData.imgUrl,
            "link": window.shareData.timeLineLink,
            "desc": window.shareData.tContent,
            "title": window.shareData.tTitle
        }, onShareComplete);
    });
    
    WeixinJSBridge.on('menu:share:timeline', function(argv) {
        WeixinJSBridge.invoke('shareTimeline', {
            "img_url": window.shareData.imgUrl,
            "img_width": "640",
            "img_height": "640",
            "link": window.shareData.timeLineLink,
            "desc": window.shareData.tContent,
            "title": window.shareData.tContent
        }, onShareComplete);
    });
}, false);
function onShareComplete(){}
</script><div class="crumbs"><div class="container"><a href="<?php echo U('/');?>"><i class="icons icon-home"></i></a>作品详情<span>Collection Details</span></div></div><div class="container"><div class="details-box fn-clear"><h3><em><?php echo ($info["nick"]); ?></em>的<br/>纽约<em><?php echo ($info["style"]); ?></em>搭配<h3><img src="__UPLOAD__/<?php echo ($info["path"]); ?>"><div class="products-box"><h2>已选商品<span>Choosed Products</span></h2><?php if(is_array($img)): $i = 0; $__LIST__ = $img;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><dl class="fn-clear"><dt><?php echo ($val["brand"]); ?></dt><?php if(is_array($val['img'])): $i = 0; $__LIST__ = $val['img'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$pic): $mod = ($i % 2 );++$i;?><dd><img src="/<?php echo ($pic); ?>"></dd><?php endforeach; endif; else: echo "" ;endif; ?></dl><?php endforeach; endif; else: echo "" ;endif; ?></div></div></div></script></body></html>