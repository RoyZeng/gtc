var showTitmeStat = function(time){
	$.ajax({
		type: "POST",
		async:false,
		dataType:'json',
		url: '?g=Admin&m=stat&a=trend&showTime=true',
		data:"showTime=true",
		success: function(data){
			
			if(data.status == 1){
				var categories = data.data.date;
				var pageviews = data.data.pageviews;
				var sessions= data.data.sessions;
				var ips = data.data.ips;
				var visitors = data.data.visitors;
				var active_visitors = data.data.active_visitors
				;
				var chart = new Highcharts.Chart({
					chart: {
		                type: 'spline',
		                renderTo: 'stat'
		            },
		            title: {
		                text: '每小时访问趋势',
		                align:'center',
		                style: {
                            color: '#666666',
                            font: 'bold 14px "Microsoft YaHei","Lucida Grande", "Lucida Sans Unicode", Verdana, Arial, Helvetica, sans-serif'
                        }
		            },
		            subtitle: {
		                text: '页面【 PV、UV、IP、活动用户、独立访客 】数据统计'
		            },
		            xAxis: {
		                categories: categories,
		                labels:{
                            rotation:-30,
                            y:28
                        }
		            },
		            yAxis: {
		                title: {
		                    text: ''
		                },
		                min: 0,
		                color:"#e5e5e5",
                        lineWidth: 1,
		            },
		            tooltip: {
		                enabled: true,
		                formatter: function() {
		                    return '<b>'+ this.series.name +'</b><br/>'+
		                        this.x +' <br /> '+ this.y;
		                },
		                borderColor:'#333',
                        backgroundColor: 'rgba(0, 0, 0, 0.75)',
		                style:{
		                	color:'#ffffff',
		                	font: 'bold 14px "Microsoft YaHei","Lucida Grande", "Lucida Sans Unicode", Verdana, Arial, Helvetica, sans-serif'
		                }
		            },
		            
		            series: [
			            {
			                name: 'PV',
			                data:pageviews
			            },
			            {
			                name: 'UV',
			                data:sessions
			            },
			            {
			                name: 'IP',
			                data:ips
			            },
			            {
			                name: '独立访客数',
			                data:visitors
			            },
			            {
			            	name: '活跃用户',
			            	data: active_visitors
			            }
		            ],
		            colors:colors
    			});
			}
		}
	});
}
var showBrowser = function(){
	$.ajax({
		type: "POST",
		async:false,
		dataType:'json',
		url: '?g=Admin&m=stat&a=showBrowser',
		data:"",
		success: function(data){
			if(data.status=1){
				var categories = data.data.browser_type_name;
				var pageviews = data.data.pageviews;
				var ips = data.data.ips;
				var visitors = data.data.visitors;
				var active_visitors = data.data.active_visitors;

				var chart_pie_1 = new Highcharts.Chart({
					colors:colors,
			        chart: {
			            renderTo: 'browser',
			            type: 'column'
			        },
			        title: {
		                text: '客户端',
		                align:"center"
		            },
		            subtitle: {
		                text: '页面【 PV、UV、IP、活动用户 】数据统计'
		            },
		            xAxis: {
		                categories:categories
		            },
		            yAxis: {
		                min: 0,
		                title: {
		                    text: '次数'
		                }
		            },
		            tooltip: {
		                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
		                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
		                    '<td style="padding:0"><b>{point.y} 次</b></td></tr>',
		                footerFormat: '</table>',
		                shared: true,
		                useHTML: true
		            },
		            plotOptions: {
		                column: {
		                    pointPadding: 0.2,
		                    borderWidth: 0
		                }
		            },
		            series: [{
		                name: 'PV',
		                data: pageviews
		    
		            }, {
		                name: 'IP',
		                data: ips
		            }, {
		                name: 'UV',
		                data: visitors
		    
		            },{
		            	name : '活动用户',
		            	data : active_visitors
		            }],
			        exporting: {
                        enabled: false
                    },
                    colors:colors
			    });
			}
		}
	});
}	
var showLocation = function(){
	$.ajax({
		type: "POST",
		async:false,
		dataType:'json',
		url: '?g=Admin&m=stat&a=showLocation',
		data:"",
		success: function(data){
			if(data.status=1){
				var categories = data.data.region_name;
				var pageviews = data.data.pageviews;
				var ips = data.data.ips;
				var visitors = data.data.visitors;
				var active_visitors = data.data.active_visitors;
				$('#location').highcharts({
		            chart: {
		                type: 'line'
		            },
		            title: {
		                text: '省份',
		                align:'center'
		            },
		            subtitle: {
		                text: '页面【 PV、UV、IP、活动用户 】数据统计'
		            },
		            xAxis: {
		                categories: categories,
		                min:0
		            },
		            yAxis: {
		                title: {
		                    text: '次数'
		                },
		                min:0
		            },
		            tooltip: {
		                enabled: true,
		                formatter: function() {
		                    return '<b>'+ this.series.name +'</b><br/>'+
		                        this.x +': '+ this.y +'次';
		                }
		            },
		            plotOptions: {
		                line: {
		                    dataLabels: {
		                        enabled: true
		                    },
		                    enableMouseTracking: true
		                }
		            },
		            series: [{
		                name: 'PV',
		                data: pageviews
		    
		            }, {
		                name: 'IP',
		                data: ips
		            }, {
		                name: 'UV',
		                data: visitors
		    
		            },{
		            	name : '活动用户',
		            	data : active_visitors
		            }],
			        exporting: {
                        enabled: false
                    },
                    colors:colors
		        });
			}	
		}
	});
}		
;(function($){

	showTitmeStat();
	showBrowser();
	showLocation();

})(jQuery);