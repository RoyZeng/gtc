<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html><html><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no, minimal-ui"><meta name="apple-mobile-web-app-capable" content="yes"><meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"><title><?php echo ($page_seo["title"]); ?></title><link rel="stylesheet" type="text/css" href="__CSS__/common.css" /><link rel="stylesheet" type="text/css" href="__CSS__/mobile_layout.css" /><script src="http://libs.baidu.com/jquery/1.8.3/jquery.min.js"></script><script type="text/javascript">			var AECONGIF = {
				"root"   	: "http://<?php echo ($home_url); ?>", //站点URL
				"public" 	: "__PUBLIC__", //项目公共目录地址
				"statics" 	: "__STATIC__", //静态文件目录
				"upload" 	: "__UPLOAD__",	//上传目录
			}
			var mobile = true;
	</script></head><body><header><div class="container"><a href="<?php echo U('/index');?>" class="logo"><img src="__IMG__/logo.png" /></a><a href="https://www.americanexpress.com/china/personal/travel/prepaid_travel_card/"><img src="__IMG__/top_card.png" class="right_card" /></a><nav><ul class="fn-clear"><!--<li><a href="<?php echo U('collections/index');?>">查看作品</a></li>--><li><a href="javascript:void(0);" data-scorll="game_intro">活动介绍</a></li><li><a href="javascript:void(0);" data-scorll="pro_intro">产品简介</a></li><li><a href="javascript:void(0);" data-scorll="download">下载锦囊</a></li><li><a href="<?php echo U('branch/index');?>">办理网点</a></li><li><a href="<?php echo U('index/mobile_regCard');?>">新卡注册</a></li></ul></nav></div></header><div class="crumbs"><div class="container"><a href="<?php echo U('/');?>"><i class="icons icon-home"></i></a>银行网点<span>Bank Branch</span></div></div><div class="container"><ul class="bank-list fn-clear"><li class="bank-icon bank_1"><a href="javascript:void(0);" class="active" data-bank="icbc">工行</a></li><li class="bank-icon bank_2"><a href="javascript:void(0);" class="" data-bank="ceb">光大银行</a></li><li class="bank-icon bank_3"><a href="javascript:void(0);" class="" data-bank="bcm">交通银行</a></li></ul><input type="hidden" id="bank" value="ICBC"><div class="city-select"><dl><dt><input type="text" readOnly id="city_val" value="北京" /><i></i></dt><dd><a href="javascript:void(0);" data-city="北京">北京</a><a href="javascript:void(0);" data-city="成都">成都</a><a href="javascript:void(0);" data-city="上海">上海</a></dd></dl></div></div><div class="branch-list"><div class="container"><div class="branch-content" style="display:block;"></div></div></div><script src="__STATIC__/scripts/icheck.js"></script><script src="__STATIC__/scripts/main.js"></script><script>
;(function ($) {
	AE.brandList.init();
	AE.brandList.getData('icbc','北京');
})(jQuery);
</script></script></body></html>