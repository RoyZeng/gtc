"use strict";Array.prototype.indexOf=function(i){for(var e=0;e<this.length;e++)if(this[e]==i)return e;return-1},Array.prototype.removeArr=function(i){var e=this.indexOf(i);e>-1&&this.splice(e,1)},Array.prototype.unique=function(){this.sort();for(var i=[this[0]],e=1;e<this.length;e++)this[e]!==i[i.length-1]&&i.push(this[e]);return i};var AE=AE||{},$body=$("body");AE.browser=function(){var i,e={},t=navigator.userAgent.toLowerCase();return(i=t.match(/msie ([\d.]+)/))?e.ie=i[1]:(i=t.match(/firefox\/([\d.]+)/))?e.firefox=i[1]:(i=t.match(/chrome\/([\d.]+)/))?e.chrome=i[1]:(i=t.match(/opera.([\d.]+)/))?e.opera=i[1]:(i=t.match(/version\/([\d.]+).*safari/))?e.safari=i[1]:0,e}(),AE.lowBrowserTips={tips:function(){var i=[];i.push('<div class="dialog browser-tip">'),i.push("<h2>\u60a8\u597d\uff0c\u60a8\u7684\u6d4f\u89c8\u5668\u7248\u672c\u8fc7\u4f4e</h2>"),i.push("<p>\u4e3a\u4e86\u4f7f\u60a8\u5728\u9875\u9762\u6d4f\u89c8\u8fc7\u7a0b\u4e2d\u62e5\u6709\u6700\u4f73\u4f53\u9a8c\uff0c\u6211\u4eec\u5efa\u8bae\u60a8\u5347\u7ea7\u5230IE9\u6216\u4ee5\u4e0a\u7248\u672c\uff0c\u6216\u8005\u66f4\u6362\u4e3achrome\u6216\u706b\u72d0\u6d4f\u89c8\u5668\uff0c\u611f\u8c22\u914d\u5408\u3002</p>"),i.push('<a href="javascript:void(0);">>>\u7ee7\u7eed\u8bbf\u95ee</a>'),i.push("</div>"),$body.prepend(i.join("\n"))},browser:function(){return $.browser.msie&&9>=$.browser.version?!0:!1},init:function(){this.browser()&&this.tips()}},AE.videoTips={createVideo:function(){var i=[];i.push('<div class="mask"></div>'),i.push('<div class="dialog video-content">'),i.push('<a href="javascript:void(0);" class="icons video-close">\u5173\u95ed</a>'),i.push('<i class="icons play-icon"></i>'),i.push('<video id="video" width="793"><source src="'+AECONGIF.public+'/video.mp4" type="video/mp4" /></video>'),i.push("</div>"),$body.prepend(i.join("\n")),this.playVideo(),this.removeVideo()},playVideo:function(){$body.on("click",".play-icon",function(){var i=document.getElementById("video");$(this).remove(),i.paused?i.play():i.pause()})},removeVideo:function(){$body.on("click",".video-close",function(){$(".video-content,.mask").remove()})},init:function(){this.createVideo()}},AE.regSuccess={createDialog:function(){var i=[];i.push('<div class="dialog regSuccess-bg" id="regSuccess">'),i.push('<a href="javascript:void(0);" class="dialog-close">\u5173\u95ed</a>'),i.push("<h4>\u606d\u559c\u60a8\uff0c \u4fe1\u606f\u63d0\u4ea4\u6210\u529f\uff01</h4>"),i.push("<p>CONGRATULATION!</p>"),i.push('<a href="https://www279.americanexpress.com/GPTRAVELWeb/cardRegister.do?page=156" class="btn" class="_blank">\u524d\u5f80\u8fd0\u901a\u5b98\u7f51\u6ce8\u518c<br/>\u9886\u53d6$10\u7f8e\u91d1</a>'),i.push("</div>"),$body.prepend(i.join("\n")),this.removeDialog()},removeDialog:function(){$body.on("click","#regSuccess .dialog-close",function(){$("#regSuccess,.mask").remove()})},init:function(){this.createDialog()}},AE.regCard={createDialog:function(){var i=[];i.push('<div class="mask"></div>'),i.push('<div class="dialog regCard-bg" id="regCardDialog">'),i.push('<a href="javascript:void(0);" class="dialog-close">\u5173\u95ed</a>'),i.push("<p>\u4e3a\u4e86\u60a8\u80fd\u987a\u5229\u9886\u53d6\u7a77\u6e38\u4e13\u5c5e$10\u7f8e\u91d1\u4f18\u60e0\uff0c\u8bf7\u5728\u4e0b\u65b9\u586b\u5199\u60a8\u7684\u7f8e\u56fd\u8fd0\u901a\u7535\u5b50\u65c5\u884c\u652f\u7968\u540e6\u4f4d\u5361\u53f7<span>(\u5982\u56fe\u793a)</span>"),i.push('<input type="text" id="card_num" /><button id="send_card">\u63d0 \u4ea4</button>'),i.push("</p>"),i.push('<div class="fn-content"><em>*\u5982\u679c\u60a8\u8fd8\u672a\u529e\u7406\u7f8e\u56fd\u8fd0\u901a\u7535\u5b50\u65c5\u884c\u652f\u7968</em>\u8bf7\u5148\u5230\u7ebf\u4e0b\u7f51\u70b9\u8fdb\u884c\u8d2d\u4e70\uff0c\u518d\u6b21\u56de\u5230\u6b64\u9875\u9762\u586b\u5199\u5361\u53f7\uff0c\u540c\u65f6\u9886\u53d6\u7a77\u6e38\u4e13\u5c5e\u4f18\u60e0<br /><a href="/branch/index.shtml">\u67e5\u770b\u7ebf\u4e0b\u7f51\u70b9\u4f4d\u7f6e</a></div>'),i.push(""),i.push("</div>"),$body.prepend(i.join("\n")),this.sendData(),this.removeDialog()},sendData:function(){$("body").on("click","#send_card",function(){var i=$("#card_num").val(),e=new RegExp("[ ,\\`,\\~,\\!,\\@,#,\\$,\\%,\\^,\\+,\\*,\\&,\\\\,\\/,\\?,\\|,\\:,\\.,\\<,\\>,\\{,\\},\\(,\\),\\',\\;,\\=,\"]");return 6!=i.length?(alert("\u8bf7\u8f93\u51656\u4f4d\u652f\u7968\u5361\u53f7"),!1):e.test(i)?(alert("\u5361\u53f7\u4e0d\u80fd\u6709\u7279\u6b8a\u5b57\u7b26"),!1):void $.ajax({url:"index.php?m=index&a=regUser",type:"POST",dataType:"json",data:{card:i}}).done(function(i){1==i.status&&($("#regCardDialog").remove(),AE.regSuccess.init())})})},removeDialog:function(){$body.on("click",".regCard-bg .dialog-close",function(){$(".regCard-bg,.mask").remove()})},mobile_sendData:function(){$("body").on("click","#send_card",function(){var i=$("#card_num").val(),e=new RegExp("[ ,\\`,\\~,\\!,\\@,#,\\$,\\%,\\^,\\+,\\*,\\&,\\\\,\\/,\\?,\\|,\\:,\\.,\\<,\\>,\\{,\\},\\(,\\),\\',\\;,\\=,\"]");return 6!=i.length?(alert("\u8bf7\u8f93\u51656\u4f4d\u652f\u7968\u5361\u53f7"),!1):e.test(i)?(alert("\u5361\u53f7\u4e0d\u80fd\u6709\u7279\u6b8a\u5b57\u7b26"),!1):void $.ajax({url:"index.php?m=index&a=regUser",type:"POST",dataType:"json",data:{card:i}}).done(function(i){if(1==i.status){var e=[];$("#regBox").empty(),e.push("<h2>\u606d\u559c\u60a8\uff0c\u4fe1\u606f\u63d0\u4ea4\u6210\u529f\uff01</h2>"),e.push("<h3>CONGRATULATION!</h3>"),e.push('<a href="https://www279.americanexpress.com/GPTRAVELWeb/cardRegister.do?page=156" class="btn-link">\u524d\u5f80\u8fd0\u901a\u5b98\u7f51\u6ce8\u518c<br />\u9886\u53d6$10\u7f8e\u91d1</a>'),$("#regBox").empty().append(e.join("\n")).css({"padding-bottom":"40px"})}})})},init:function(){this.createDialog()}},AE.makeCollection={hideBanner:function(){$body.scrollTo("#banner",{duration:500,axis:"y",onAfter:function(){$("#banner").fadeOut(),$("#map_logo").css({visibility:"visible"}),AE.makeCollection.createMapLogoList(),$(".logo_map_list a").eq(0).click()}})},showMakeContent:function(i){this.createLogoSlides(i),this.createItems(i),$("#logo_"+i).click(),$("#map_logo").css({visibility:"hidden"}),$("#make_content").css({visibility:"visible"}),this.changeSale_msg(i)},createMapLogoList:function(){var i=[];$.each(logoList,function(e,t){i.push(0==e?'<a href="#" class="select" data-item="'+t.lng+"|"+t.lat+"|"+t.img.logo_2+"|"+t.address+"|"+t.tel+"|"+t.url+"|"+e+'"><img src="'+t.img.logo_2+'" /></a>':'<a href="#" class="" data-item="'+t.lng+"|"+t.lat+"|"+t.img.logo_2+"|"+t.address+"|"+t.tel+"|"+t.url+"|"+e+'"><img src="'+t.img.logo_2+'" /></a>')}),$("#map_logo_list").prepend(i.join("\n")),this.mapLogoClick()},mapLogoClick:function(){$(".logo_map_list a").bind("click",function(i){$(this).siblings("a").removeClass("select"),$(this).addClass("select");var e=$(this).data("item").split("|"),t=e[0],a=e[1],s=e[2],n=e[3],o=e[4],r=e[5],c=e[6];if(initMap(t,a,s,n,o,r,"map_icon_open",c),document.getElementById("mask").style.backgroundImage="url(/statics/images/map.jpg)",document.getElementById("mask").style.backgroundRepeat="repeat",document.getElementById("mask").style.backgroundPosition=logoList[c].pos,mobile){var l="<div class='poi_content fn-text-overflow' id='mobile_poi_content'><div class='fn-clear'><img src='"+s+"' class='fn-left'><ul class='fn-right'><li>"+n+"</li><li>"+o+"</li><li>"+r+'</li></ul></div><a href="javascript:void(0);" onclick="AE.makeCollection.showMakeContent('+c+');">ENTER</a></div>';$("#mobile_poi_content").remove(),$("#map_logo .left-content").append(l)}i.preventDefault()})},createLogoSlides:function(i){var e=[];e.push('<div class="item">'),$.each(logoList,function(t,a){e.push(i==t?'<a href="#" class="select" data-img="'+a.img.logo_1+'" data-tel="'+a.tel+'" data-url="'+a.url+'" data-address="'+a.address+'" id="logo_'+t+'"><img src="'+a.img.logo_2+'" /></a>':'<a href="#" class="" data-img="'+a.img.logo_1+'" data-tel="'+a.tel+'" data-url="'+a.url+'" data-address="'+a.address+'" id="logo_'+t+'"><img src="'+a.img.logo_2+'" /></a>'),(t+1)%6==0&&e.push('</div><div class="item">')}),e.push("</div>"),$("#logo_slides").prepend(e.join("\n")),$("#logo_slides .item:nth(2)").remove(),$("#logo_slides a").brandLogo({logo:i}),this.logo_slides()},createItems:function(i){var e=[];e.push('<div id="slides_list_'+i+'">'),$.each(logoList,function(t,a){if(t==i){e.push('<div class="item fn-clear">');for(var s=0;s<a.items.length;s++)e.push('<dl><dt data-id="'+s+'"><img src="'+a.items[s]+'" /></dt><dd>'),e.push('<input type="checkbox" name="itemCheck" id="item_'+s+'" data-brand="'+a.brand+'" value="'+a.items[s]+'"><label for="item_'+s+'">\u52a0\u5165\u642d\u914d\u6e05\u5355</label>'),e.push("</dd></dl>"),mobile?(s+1)%2==0&&e.push('</div><div class="item fn-clear">'):(s+1)%3==0&&e.push('</div><div class="item fn-clear">');e.push("</div>")}}),e.push("</div>"),e.push("<p>\u6700\u591a\u53ef\u6311\u900920\u4ef6\u5355\u54c1\u653e\u5165\u642d\u914d\u6e05\u5355\uff0c\u7136\u540e\u4ece\u4e2d\u9009\u62e96\u4ef6\u5355\u54c1\u5b8c\u6210\u4f60\u7684\u642d\u914d\u4f5c\u54c1</p>"),e.push('<a href="javascript:void(0);" id="preview_list" class="preview-list">\u9884\u89c8\u642d\u914d</a>'),$("#item_list").empty().prepend(e.join("\n")),this.item_slides(i);var t=$("#img_data").val()+",";this.itemClick(i,t)},itemClick:function(i,e){var t=[];$('input[type="checkbox"]').each(function(){var i=$(this),a=i.next(),s=a.text(),n="\u5df2\u6dfb\u52a0";a.remove(),i.iCheck({checkboxClass:"icheckbox",insert:"<label>"+s+"</label>"}).on("ifChecked",function(){$(this).next().text(n),t.push(","+$(this).val()+"|"+$(this).data("brand")),e+=t,e=e.split(",").unique(),$("#img_data").val(e)}).on("ifUnchecked",function(){$(this).next().text(s),t.removeArr(","+$(this).val()+"|"+$(this).data("brand")),e+=t,e=e.split(",").unique(),$("#img_data").val(e)})}),$("#preview_list").bind("click",function(e){var t,a=[];$('input[name="itemCheck"]:checked').each(function(){}),t=$("#img_data").val().split(",").unique();var s=$.grep(t,function(i){return $.trim(i).length>0});$("#img_area").prepend(a.join("\n")),AE.makeCollection.createPreview(s,i),e.preventDefault()})},changeSale_msg:function(i){$(".sale-msg dt").text(logoList[i].sale_msg[0]),$(".sale-msg dd").text(logoList[i].sale_msg[1])},item_slides:function(i){$("#slides_list_"+i).slidesjs(mobile?{width:710,height:650,navigation:{active:!0,effect:"slide"},pagination:!1}:{width:710,height:350,navigation:{active:!0,effect:"slide"},pagination:!1})},logo_slides:function(){$("#logo_slides").slidesjs({width:550,height:333,navigation:!1})},createPreview:function(i){$("#make_content").css({visibility:"hidden"}),$("#preview_content").css({visibility:"visible"});var e=[];e.push('<div class="item">'),$.each(i,function(i,t){t=t.split("|"),e.push('<a href="#" mask="true"><div class="img-mask"></div><img src="'+t[0]+'" data-preview="'+i+'" data-brand="'+t[1]+'"></a>'),(i+1)%12==0&&e.push('</div><div class="item">')}),e.push("</div>"),$("#preview_slides").prepend(e.join("\n")),this.previewClick();for(var t=0;5>=t;t++)$("#preview_slides a").eq(t).click();i.length>12&&this.preview_slides()},previewClick:function(){$("#preview_slides a").bind("click",function(i){var e,t=$(this).attr("mask"),a=$(this).find("img").attr("src"),s=$(this).find("img").data("brand"),n=$(this).find("img").data("preview"),o=$(this).find("img").height(),r=($(this).find("img").width(),[]);if("true"==t){if($(this).attr("mask","false"),$(this).children(".img-mask").addClass("fn-hide"),mobile)if(o>=100){var c=.5*o;e=60,r.push('<img src="'+a+'" id="preview_'+n+'" data-brand="'+s+'" height="'+c+'" />')}else e=80,r.push('<img src="'+a+'" id="preview_'+n+'" data-brand="'+s+'" width="70" />');else e=100,r.push('<img src="'+a+'" id="preview_'+n+'" data-brand="'+s+'" />');if($("#img_area img").size()>=6){var l=[];l.push('<div class="tipBox">'),l.push('<p>\u6700\u591a\u53ea\u80fd\u9009\u62e96\u4e2a\u5546\u54c1<span>Only 6 Products can be choose at most</span><a href="javascript:void(0)" class="close_tip">\u786e\u5b9a</a></p>'),l.push("</div>"),$("#img_area").prepend(l.join("\n")),$("#submit").hide(),$(this).children(".img-mask").removeClass("fn-hide"),$(".close_tip").click(function(){$(".tipBox").remove(),$("#submit").show()})}else $("#img_area").prepend(r.join("\n"));AE.makeCollection.wookmark(e)}else $(this).attr("mask","true"),$(this).children(".img-mask").removeClass("fn-hide"),$("#preview_"+n).remove();i.preventDefault()})},preview_slides:function(){$("#preview_slides").slidesjs({width:515,height:440,navigation:!1})},wookmark:function(i){var e=$("#img_area img");e.wookmark(mobile?{autoResize:!0,container:$("#img_area"),offset:5,outerOffset:0,itemWidth:i}:{autoResize:!0,container:$("#img_area"),offset:0,outerOffset:0,itemWidth:i})},submitBtn:function(){$("body").on("click","#submit",function(i){$(this).off("click");var e=[],t=[],a=[];if(""==$("#nick_name").val())return alert("\u8bf7\u8f93\u5165\u6635\u79f0"),$(this).on("click"),!1;if(""==$("#style_name").val())return alert("\u8bf7\u8f93\u5165\u98ce\u683c\u540d\u79f0"),$(this).off("click"),!1;if(0==$("#img_area img").length){var s=[];return s.push('<div class="tipBox">'),s.push('<p>\u8bf7\u81f3\u5c11\u9009\u62e9\u4e00\u4e2a\u5546\u54c1<span>Please choose at least one product</span><a href="javascript:void(0)" class="close_tip">\u786e\u5b9a</a></p>'),s.push("</div>"),$("#img_area").prepend(s.join("\n")),$("#submit").hide(),$(".close_tip").click(function(){$(".tipBox").remove(),$("#submit").show()}),!1}$("#img_area img").each(function(){var i=$(this).position();e.push(i.left+"|"+i.top),t.push($(this).attr("src")),a.push($(this).data("brand"))});var n="coordinate[]="+JSON.stringify(e)+"&imgList[]="+JSON.stringify(t)+"&nick_name="+$("#nick_name").val()+"&style_name="+$("#style_name").val()+"&brandList[]="+JSON.stringify(a);$.ajax({type:"POST",url:"index.php?m=index&a=createImg",data:n,success:function(i){var e=[];e.push('<div class="mask"></div>'),e.push('<div class="show-success-box">'),e.push('<div class="title">\u63d0\u4ea4\u6210\u529f<span>&nbsp;&nbsp;&nbsp;Successful</span></div>'),e.push('<div class="success_pic">'),e.push('<a href="javascript:void(0);" class="close">X</a>'),e.push("<h5><em>"+i.data.nick+"</em>\u7684<br/>\u7ebd\u7ea6<em>"+i.data.style+"</em>\u642d\u914d</h5>"),e.push('<img src="upload/'+i.data.path+'">'),e.push('<div class="share-box fn-clear">'),e.push('<div class="share fn-clear">'),e.push('<div class="share_text" id="share_text">\u5206\u4eab\u7ed9\u670b\u53cb</div>'),e.push('<div id="shareBox" style="display:none">'),e.push('<a href="#" class="weibo" data-href="http://service.weibo.com/share/share.php?url={url}&title={title}&pic={pic}" target="_blank"></a>'),e.push('<a href="#" class="tqq" data-href="http://share.v.t.qq.com/index.php?c=share&a=index&title={title}&url={url}&pic={pic}" target="_blank"></a>'),e.push('<a href="#" class="qq" data-href="http://connect.qq.com/widget/shareqq/index.html?url={url}&pics={pic}&title={title}" target="_blank"></a>'),e.push('<a href="#" class="weixin"><div style="background:url(/'+i.data.qr+') no-repeat center center"></div></a>'),e.push('<a href="#" class="douban" data-href="http://www.douban.com/recommend/?url={url}&title={title}&pic={pic}" target="_blank"></a>'),e.push("</div>"),e.push("</div>"),e.push('<a href="https://www.americanexpress.com/china/personal/travel/prepaid_travel_card/where-to-buy.shtml?linknav=ch-travel-prepaid-where-to-buy-tab" class="buyBtn" target="_blank">\u8d2d\u4e70GTC</a>'),e.push("</div>"),e.push("</div>"),e.push('<div class="qy-text">\u7a77\u6e38\u4e13\u5c5e\u4f18\u60e0<p><span>* </span>\u5373\u65e5\u8d77\u8d2d\u4e70\u7f8e\u56fd\u8fd0\u901a\u7535\u5b50\u65c5\u884c\u652f\u7968<br />\u524d\u5f80\u5b98\u65b9\u6ce8\u518c\u4f1a\u5458<br />\u5373\u53ef\u9886\u53d610\u7f8e\u91d1</p></div>'),e.push("</div>"),$("body").prepend(e.join("\n")),mobile?$(".share").click(function(){$("#shareBox").show()}):$(".share").hover(function(){$("#share_text").hide(),$("#shareBox").show()},function(){$("#share_text").show(),$("#shareBox").hide()}),$("body").scrollTop(0),$(".share a").bind("click",function(e){e=$(this).attr("data-href"),e=e.replace("{title}",encodeURIComponent("#\u4f60\u8d2d\u65f6\u5c1a\u5417#\u662f\u6f6e\u4eba\u5c31\u6765\u79c0\uff01\u5feb\u6765\u770b\u6211\u7684\u7ebd\u7ea6\u8857\u5934\u6700fashion\u642d\u914d\uff01\u73b0\u5728\u7528\u7f8e\u56fd\u8fd0\u901a\u7535\u5b50\u65c5\u884c\u652f\u7968\u5728\u7ebd\u7ea6\u9ea6\u8fea\u900a\u5927\u8857shopping\u8fd8\u80fd\u83b7\u5f97\u4e13\u5c5e\u4f18\u60e0\u5462\uff0c\u60ca\u559c\u4f20\u9001\u95e8")),e=e.replace("{url}",encodeURIComponent(document.location.href)),e=e.replace("{pic}",encodeURIComponent(AECONGIF.upload+"/"+i.data.path)),$(this).attr("href",e),$(this).blur();$(this).attr("class")}),$(".close").click(function(){$(".show-success-box,.mask").remove(),setTimeout(function(){location.reload()},500)})}}),i.preventDefault()})},init:function(){this.submitBtn(),this.hideBanner()}},AE.brandList={getData:function(i,e){$.ajax({url:"index.php?m=branch&a=branch_list",type:"POST",dataType:"json",data:{bank:i,city:e}}).done(function(t){1==t.status&&AE.brandList.createHtml(t.data,e,i)})},createHtml:function(i,e,t){switch(t){case"icbc":var a="\u4e2d\u56fd\u5de5\u5546\u94f6\u884c";break;case"ceb":var a="\u5149\u5927\u94f6\u884c";break;case"bcm":var a="\u4ea4\u901a\u94f6\u884c"}$(".branch-content").empty();var s=[];s.push('<div class="bank_list">'),s.push('<div class="list_title">'+a+"\u7535\u5b50\u65c5\u652f\u9500\u552e\u7f51\u70b9-"+e+"</div>"),s.push('<table width="100%">'),s.push("<tr>"),s.push(mobile?'<th width="30%">\u7f51\u70b9\u540d\u79f0<br />Branch Name</th><th>\u7f51\u70b9\u5730\u5740<br />Branch address</th>':'<th width="15%">\u94f6\u884c<br>brank</th><th width="25%">\u7f51\u70b9\u540d\u79f0<br />Branch Name</th><th>\u7f51\u70b9\u5730\u5740<br />Branch address</th><th width="15%">\u54a8\u8be2\u7535\u8bdd<br />Hotline</th>'),s.push("</tr>"),$.each(i,function(i,e){s.push("<tr>"),mobile?(s.push("<td>"+e.name+"</td>"),s.push("<td>"+e.address+"</td>")):(s.push("<td>"+e.name+"</td>"),s.push("<td>"+e.branch+"</td>"),s.push("<td>"+e.address+"</td>"),s.push("<td>"+e.tel+"</td>")),s.push("</tr>")}),s.push("</table>"),s.push("</div>"),$(".branch-content").prepend(s.join("\n"))},bankClick:function(){$(".bank-list a").click(function(i){$(this).parent().siblings().children("a").removeClass("active"),$(this).addClass("active");var e=$(this).data("bank"),t=$("#city_val").val();$("#bank").val(e),AE.brandList.getData(e,t),i.stopPropagation()})},init:function(){this.bankClick()}},AE.back={init:function(){$("#gotoBanner").bind("click",function(i){$("#banner").fadeIn(),$("#map_logo").css({visibility:"hidden"}),$("#map_logo_list").empty(),i.preventDefault()}),$("#go_map_logo").bind("click",function(i){$("#map_logo").css({visibility:"visible"}),$("#make_content").css({visibility:"hidden"}),$("#logo_slides").empty(),i.preventDefault()}),$("#goto_make_content").bind("click",function(i){$("#make_content").css({visibility:"visible"}),$("#preview_content").css({visibility:"hidden"}),$("#preview_slides,#img_area").empty(),i.preventDefault()})}},function(i){AE.lowBrowserTips.init(),AE.back.init(),$body.on("click",".browser-tip a",function(){i(".browser-tip").remove()}),$body.on("click",".play-icon",function(){var e=document.getElementById("video");i(this).hide(),e.paused?e.play():e.pause()}),$body.on("click",".content dd",function(){i(this).siblings().removeClass("active"),i(this).addClass("active"),document.getElementById("video").pause(),i(".play-icon").show();var e=i(this).data();e.index?(i(".plane-content").hide(),i(".plane-content-"+e.index).show()):window.location.href=e.url}),i(".slides dt,.collectionsList dt").hover(function(){i(this).find("a").append('<div class="img-bg"></div>')},function(){i(".img-bg").remove()}),$body.on("click","#regCard",function(i){AE.regCard.init(),i.stopPropagation(),i.preventDefault()}),i.fn.dropdownlist=function(){var e=i(this);e.bind("click",function(e){i(this).next().show(),e.stopPropagation()}),e.next().find("a").bind("click",function(){var t=i(this).text(),a=i(this).data("city"),s=i("#bank").val();e.children("input").val(t),e.next().hide(),AE.brandList.getData(s,a)}),$body.bind("click",function(){e.next().hide()})},i.fn.scroll=function(e){var t=i(this),a={time:100},s=i.extend(a,e);t.bind("click",function(){var e=location.pathname;console.log(e);var t=i(this).data("scorll");t&&("/index.shtml"==e?$body.scrollTo("#"+t,s.time):window.location.href="/index.shtml#"+t)})},i.fn.brandLogo=function(e){{var t,a,s,n,o,r=i(this),c={logo:1};i.extend(c,e)}r.bind("click",function(e){t=i(this).data("img"),a=i(this).data("tel"),s=i(this).data("url"),n=i(this).data("address"),o=i(this).attr("id").split("_")[1],i("#show_select_logo").attr("src",t),i("#tel").text(a),i("#url").text(s),i("#address").text(n),AE.makeCollection.createItems(o),i(this).siblings("a").removeClass("select"),i(this).addClass("select"),AE.makeCollection.changeSale_msg(o),e.preventDefault()})},i(".city-select dt").dropdownlist(),$body.on("click","#make_img",function(){AE.makeCollection.init()}),i("nav a").scroll({time:800}),i("body").on("click","#map",function(){alert("s")})}(jQuery),$(function(){$("#gotop a").click(function(){$("html, body").animate({scrollTop:0},500)})});