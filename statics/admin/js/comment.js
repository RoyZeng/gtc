;(function ($) {
	$.fn.showComment = function(options) {
		var _vid,$this;
		var defaults={
            "url":'',
        };
        var L=[],C=[];
		L.push('<tr id="show_comment" style="display:none">');
    	L.push('</tr>');
    	$("body").append(L.join('\n'));
        var opts = $.extend({},defaults,options);
        var loadComment = function(vid){
            
        	$.post(opts.url+'&vid='+vid,function(data){
        		if(data.status == 1){
        			console.warn(data.data);
                    
                    C.push('<td colspan="12">');
                    C.push('<table width="100%" cellspacing="0">');
                    C.push('<thead>');
                    C.push('<th align="left" width="100">用户</th>');
                    C.push('<th align="left">评论内容</th>');
                    C.push('<th align="left" width="100">评论时间</th>');
                    C.push('<th align="center" width="60">操作</th>');
                    C.push('</thead>');
                    C.push('<tbody>');
        			$.each(data.data, function(index, item) {
        				
        				C.push('<tr>');
                        C.push('<td>'+item.user[0].username+'</td>');
                        C.push('<td style="padding:0 20px 0 0">'+item.content+'</td>');
                        C.push('<td>'+item.addtime+'</td>');
                        C.push('<td align="center"><a href="javascript:void(0);" class="J_confirmurl" data-uri="" data-acttype="ajax" data-msg="确认删除">删除</a></td>');
                        C.push('</tr>');

        			});
                    C.push('</tbody>');
                    C.push('</table>');
                    C.push('</td>');
                    $("#show_comment").empty();
        			$("#show_comment").append(C.join('\n'));
        		}
        	});
        };
		this.each(function(index, val) {
			$this = $(this);
			$this.bind("click",function(){
				_vid = $(this).data('vid');
				$("#show_comment").empty().insertAfter($("#lesson_info_"+_vid)).slideDown(500,function() {
					loadComment(_vid);
				});
			});
		});

		return this;
	};
})(jQuery);

;$(function(){
	$('.show-comment').showComment({url:'?g=Home&m=comment&a=getComment'});
});