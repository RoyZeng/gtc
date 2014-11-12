<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html><html><head><meta charset="utf-8"><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><meta name="viewport" content="width=device-width, initial-scale=1.0"><meta name="renderer" content="webkit"><meta http-equiv="Content-type" content="application/x-www-form-urlencoded; charset=UTF-8" /><meta name="description" content="<?php echo ($page_seo["description"]); ?>"><meta name="keywords" content="<?php echo ($page_seo["keywords"]); ?>"><meta name="author" content="听着情歌流泪"><meta name="copyright" content=""><meta name="rating" content="General"><meta name="robots" content="INDEX,FOLLOW"><meta name="revisit-after" content="1 Week"><meta name="application-name" content="<?php echo C('web_site_title');?>" /><link href="/favicon.ico" rel="icon" type="image/x-icon" /><link href="/favicon.ico" rel="shortcut icon" type="image/x-icon" /><link href="/favicon.ico" rel="bookmark" type="image/x-icon" /><title><?php echo ($page_seo["title"]); ?></title><link rel="stylesheet" type="text/css" href="__CSS__/common.css" /><link rel="stylesheet" type="text/css" href="__CSS__/layout.css" /><script src="http://libs.baidu.com/jquery/1.8.3/jquery.min.js"></script><!--[if lt IE 9]><script type="text/javascript" src="__STATIC__/scripts/html5shiv.js"></script><script type="text/javascript" src="__STATIC__/scripts/respond.min.js"></script><![endif]--><script type="text/javascript">		var AECONGIF = {
			"root"   	: "http://<?php echo ($home_url); ?>", //站点URL
			"public" 	: "__PUBLIC__", //项目公共目录地址
			"statics" 	: "__STATIC__", //静态文件目录
			"upload" 	: "__UPLOAD__",	//上传目录
		}
		var mobile = false;
</script></head><body><header><div class="container"><a href="<?php echo U('/index');?>" class="logo"><img src="__IMG__/logo.png" /></a><a href="https://www.americanexpress.com/china/personal/travel/prepaid_travel_card/"><img src="__IMG__/top_card.png" class="right_card" /></a><nav><ul class="fn-clear"><li><a href="<?php echo U('collections/index');?>">查看作品<em>All Collections</em></a></li><li><a href="javascript:void(0);" data-scorll="game_intro">活动介绍<em>Game Introduction</em></a></li><li><a href="javascript:void(0);" data-scorll="pro_intro">产品简介<em>Product Introduction</em></a></li><li style="margin-left:-15px"><a href="javascript:void(0);" data-scorll="download">下载锦囊<em>Download Guide</em></a></li><li><a href="<?php echo U('branch/index');?>">办理网点<em>Bank Branch</em></a></li><li><a href="javascript:void(0);" id="regCard">新卡注册<em>New Card Registration</em></a></li></ul></nav></div></header><script>
window.shareData = {
    "imgUrl": "__UPLOAD__/<?php echo ($info["path"]); ?>",
    "timeLineLink": Location.href,
    "tTitle": "你购时尚吗",
    "tContent": "#你购时尚么#快来看我的纽约街头最fashion搭配！现在用美国运通电子旅行支票在纽约麦迪逊大街shopping还能获得专属优惠呢"
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
</script><div class="crumbs"><div class="container"><a href="<?php echo U('/');?>"><i class="icons icon-home"></i></a>作品详情<span>Collection Details</span></div></div><div class="container"><div class="details-box fn-clear"><div class="left-box"><h3><em><?php echo ($info["nick"]); ?></em>的<br/>纽约<em><?php echo ($info["style"]); ?></em>搭配<h3><img src="__UPLOAD__/<?php echo ($info["path"]); ?>"></div><div class="right-box"><h2>已选商品<span>Choosed Products</span></h2><?php if(is_array($img)): $i = 0; $__LIST__ = $img;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><dl class="fn-clear"><dt><?php echo ($val["brand"]); ?></dt><?php if(is_array($val['img'])): $i = 0; $__LIST__ = $val['img'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$pic): $mod = ($i % 2 );++$i;?><dd><img src="/<?php echo ($pic); ?>"></dd><?php endforeach; endif; else: echo "" ;endif; ?></dl><?php endforeach; endif; else: echo "" ;endif; ?></div></div></div><div id="gotop"><a href="javascript:void(0);">gotop</a></div><script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-48201726-33', 'auto');
  ga('send', 'pageview');

</script></body></html>