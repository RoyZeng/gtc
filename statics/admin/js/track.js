var get_track = function(qid,time){
	
	
	$.ajax({
		type: "POST",
		async:false,
		dataType:'json',
		url: '?g=Admin&m=track&a=load_track_question_click',
		data:"qid="+qid+"&start_time="+time,
		success: function(data){
			
			if(data.status == 1){
				var track_count_a = data.data.track_count_a;
				var track_count_b = data.data.track_count_b;
				var track_count_c = data.data.track_count_c;
				var track_count_d = data.data.track_count_d;
				var track_7day = data.data.track_7day;
				
				var chart = new Highcharts.Chart({
					chart: {
		                type: 'spline',
		                renderTo: 'stat'
		            },
		            title: {
		                text: '课件:'+data.data.lesson_title+'<br />',
		                style: {
                            color: '#666666',
                            font: 'bold 14px "Microsoft YaHei","Lucida Grande", "Lucida Sans Unicode", Verdana, Arial, Helvetica, sans-serif'
                        }
		            },
		            subtitle: {
		                text: '问题:'+data.data.question_title+' 用户答题每小时趋势'
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
		                    text: '点击次数'
		                },
		                min: 0,
		                color:"#e5e5e5",
                        lineWidth: 1,
		            },
		            tooltip: {
		                enabled: true,
		                formatter: function() {
		                    return data.data.question_title+'<br /><b>'+ this.series.name +'</b><br/>'+
		                        this.x +' 被点击: '+ this.y +' 次';
		                },
		                borderColor:'#333',
                        backgroundColor: 'rgba(0, 0, 0, 0.75)',
		                style:{
		                	color:'#ffffff',
		                	font: 'bold 14px "Microsoft YaHei","Lucida Grande", "Lucida Sans Unicode", Verdana, Arial, Helvetica, sans-serif'
		                }
		            },
		            plotOptions: {
		                series: {
		                    cursor: 'pointer',
		                    point: {
		                        events: {
		                            click: function() {
		                                hs.htmlExpand(null, {
		                                    pageOrigin: {
		                                        x: this.pageX,
		                                        y: this.pageY
		                                    },
		                                    headingText: data.data.lesson_title,
		                                    maincontentText: data.data.question_title+'<br /><b>'+ this.series.name +'</b><br/>'+this.x +':00 -'+this.x+':59 被点击: '+ this.y +' 次',
		                                    width: 200
		                                });
		                            }
		                        }
		                    },
		                    marker: {
		                        lineWidth: 1
		                    }
		                }
		            },
		            series: [
			            {
			                name: '答案A',
			                data:track_count_a
			            }, {
			                name: '答案B',
			                data:track_count_b
			            }, {
			                name: '答案C',
			                data:track_count_c
			            }, {
			                name: '答案D',
			                data:track_count_d
			            }
		            ],
		            colors:colors
    			});
				
				var chart_pie_1 = new Highcharts.Chart({
					colors:colors,
			        chart: {
			            plotBackgroundColor: null,
			            plotBorderWidth: null,
			            plotShadow: false,
			            renderTo: 'stat_pie_1'
			        },
			        title: {
		                text: '课件:'+data.data.lesson_title+'<br />',
		                style: {
                            color: '#666666',
                            font: 'bold 14px "Microsoft YaHei","Lucida Grande", "Lucida Sans Unicode", Verdana, Arial, Helvetica, sans-serif'
                        }
		            },
		            subtitle: {
		                text: '问题:'+data.data.question_title+' 各选项比例'
		            },
			        tooltip: {
			        	formatter: function() {
                            return this.point.name +'占总点击数量：'+ Highcharts.numberFormat(this.percentage,2) +' %';
                        },
                        percentageDecimals: 1,
                        borderColor:'#333',
                        backgroundColor: 'rgba(0, 0, 0, 0.75)',
                        style: {
                            color: '#F0F0F0'
                        }
			    	    //pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
			        },
			        plotOptions: {
			            pie: {
			                allowPointSelect: true,
			                cursor: 'pointer',
			                dataLabels: {
			                    enabled: true,
			                    color: '#000000',
			                    connectorColor: '#000000',
			                    //format: '<b>{point.name}</b>被选比例: {point.percentage:.1f} %'
			                    formatter: function() {
                                    return this.point.name +'占总点击数量：'+ Highcharts.numberFormat(this.percentage,2) +' %';
                                }
			                },
			                showInLegend: true
			            }
			        },
			        legend: {
                        enabled: true,
                        borderWidth: 0,
                        align: 'center',
                        symbolWidth: 16,
                    },
			        series: [{
			            type: 'pie',
			            name: '占总数量',
			            data: [
			            	['答案B',    data.data.track_answer_b],
			                {
			                    name: '答案A',
			                    y: data.data.track_answer_a,
			                    sliced: true,
			                    selected: true
			                },
			                
			                ['答案C',     data.data.track_answer_c],
			                ['答案D',    data.data.track_answer_d]
			            ]
			        }],
			        exporting: {
                        enabled: false
                    },
                    colors:colors
			    });
				
				var chart_pie_2 = new Highcharts.Chart({
					chart: {
		                type: 'column',
                		margin: [ 50, 50, 100, 80],
                		renderTo: 'stat_pie_2'
		            },
		            title: {
		                text: '课件:'+data.data.lesson_title+'<br />',
		                style: {
                            color: '#666666',
                            font: 'bold 14px "Microsoft YaHei","Lucida Grande", "Lucida Sans Unicode", Verdana, Arial, Helvetica, sans-serif'
                        }
		            },
		            subtitle: {
		                text: '问题:'+data.data.question_title+' 7天答题统计'
		            },
		            xAxis: {
		                categories: track_7day,
		                labels:{
                            rotation:-20,
                            y:35
                        }
		            },
		            yAxis: {
		                min: 0,
		                title: {
		                    text: '被选择次数'
		                }
		            },
		            tooltip: {
		            	borderColor:'#333',
		            	backgroundColor: 'rgba(0, 0, 0, 0.75)',
                        style: {
                            color: '#F0F0F0'
                        },
		                headerFormat: '<span style="font-size:12px;font-size:14px;">{point.key} 答题统计</span><table>',
		                pointFormat: '<tr><td style="color:#fff;padding:0">{series.name}被选择: </td>' +
		                    '<td style="padding:0;color:{series.color};"><b>{point.y} 次</b></td></tr>',
		                footerFormat: '</table>',
		                shared: true,
		                useHTML: true
		            },
		            plotOptions: {
		                column: {
		                    pointPadding: 0,
		                    borderWidth: 0
		                }
		            },
		            series: [{
		                name: '答案A',
		                data: data.data.track_7count_a,
		    			dataLabels: {
		                    enabled: true,
		                    rotation: -90,
		                    color: '#FFFFFF',
		                    align: 'right',
		                    x: 4,
		                    y: 10,
		                    style: {
		                        fontSize: '10px',
		                        //fontFamily: 'Verdana, sans-serif',
		                        //textShadow: '0 0 3px black'
		                    }
	                	}
		            }, {
		                name: '答案B',
		                data: data.data.track_7count_b,
		    			dataLabels: {
		                    enabled: true,
		                    rotation: -90,
		                    color: '#FFFFFF',
		                    align: 'right',
		                    x: 4,
		                    y: 10,
		                    style: {
		                        fontSize: '10px',
		                        //fontFamily: 'Verdana, sans-serif',
		                        //textShadow: '0 0 3px black'
		                    }
	                	}
		            }, {
		                name: '答案C',
		                data: data.data.track_7count_c,
		    			dataLabels: {
		                    enabled: true,
		                    rotation: -90,
		                    color: '#FFFFFF',
		                    align: 'right',
		                    x: 4,
		                    y: 10,
		                    style: {
		                        fontSize: '10px',
		                        //fontFamily: 'Verdana, sans-serif',
		                        //textShadow: '0 0 3px black'
		                    }
	                	}
		            }, {
		                name: '答案D',
		                data: data.data.track_7count_d,
		    			dataLabels: {
		                    enabled: true,
		                    rotation: -90,
		                    color: '#FFFFFF',
		                    align: 'right',
		                    x: 4,
		                    y: 10,
		                    style: {
		                        fontSize: '10px',
		                        //fontFamily: 'Verdana, sans-serif',
		                        //textShadow: '0 0 3px black'
		                    }
	                	}
		            }],
		            colors:colors
    			});

			}
		}

	});
}

var get_user_stat = function(verify){
    $.ajax({
        type: "POST",
        async:false,
        dataType:'json',
        url: '?g=Admin&m=track&a=stat_user&verify='+verify,
        success: function(data){
            var get_user_stat_1 = new Highcharts.Chart({
                chart: {
                    type: 'column',
                    margin: [ 50, 50, 100, 80],
                    renderTo: 'get_user_stat_1'
                },
                title: {
                    text: ''+data.data.title+'<br />',
                    style: {
                        color: '#666666',
                        font: 'bold 14px "Microsoft YaHei","Lucida Grande", "Lucida Sans Unicode", Verdana, Arial, Helvetica, sans-serif'
                    },
                    align:"center"
                },
                xAxis: {
                    categories: data.data.day,
                    
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: '人数'
                    }
                },
                tooltip: {
                    borderColor:'#333',
                    backgroundColor: 'rgba(0, 0, 0, 0.75)',
                    style: {
                        color: '#F0F0F0'
                    },
                    headerFormat: '<span style="font-size:12px;font-size:14px;">{point.key} 用户统计</span><table>',
                    pointFormat: '<tr><td style="color:#fff;padding:0">{series.name}：</td>' +
                        '<td style="padding:0;color:{series.color};"><b>{point.y} 人</b></td></tr>',
                    footerFormat: '</table>',
                    shared: true,
                    useHTML: true
                },
                plotOptions: {
                    column: {
                        pointPadding: 0,
                        borderWidth: 0
                    }
                },
                series: [
                    name: data.data.title_1,
                    data: data.data.count_1,
                    dataLabels: {
                        enabled: false,
                        rotation: -90,
                        color: '#FFFFFF',
                        align: 'right',
                        x: 4,
                        y: 10,
                        style: {
                            fontSize: '10px',
                            //fontFamily: 'Verdana, sans-serif',
                            //textShadow: '0 0 3px black'
                        }
                    }
                ],
                colors:colors
            });
			
			var get_user_stat_2 = new Highcharts.Chart({
					colors:colors,
			        chart: {
			            plotBackgroundColor: null,
			            plotBorderWidth: null,
			            plotShadow: false,
			            renderTo: 'get_user_stat_2'
			        },
			        title: {
		                text: data.data.title_pie,
		                align:"center",
		                style: {
                            color: '#666666',
                            font: 'bold 14px "Microsoft YaHei","Lucida Grande", "Lucida Sans Unicode", Verdana, Arial, Helvetica, sans-serif'
                        }
		            },
			        tooltip: {
			        	formatter: function() {
                            return this.point.name +'：'+ this.point.y+' 人';
                        },
                        percentageDecimals: 1,
                        borderColor:'#333',
                        backgroundColor: 'rgba(0, 0, 0, 0.75)',
                        style: {
                            color: '#F0F0F0'
                        }
			    	    //pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
			        },
			        plotOptions: {
			            pie: {
			                allowPointSelect: true,
			                cursor: 'pointer',
			                dataLabels: {
			                    enabled: true,
			                    color: '#000000',
			                    connectorColor: '#000000',
			                    formatter: function() {
                                    return this.point.name +'占总人数：'+ Highcharts.numberFormat(this.percentage,2) +' %';
                                }
			                },
			                showInLegend: true
			            }
			        },
			        legend: {
                        enabled: true,
                        borderWidth: 0,
                        align: 'center',
                        symbolWidth: 16,
                    },
			        series: [{
			            type: 'pie',
			            name: '占总人数',
			            data: [
			                {
			                    name: '正式用户',
			                    y: data.data.tal_2,
			                    sliced: true,
			                    selected: true
			                }
			            ]
			        }],
			        exporting: {
                        enabled: true
                    },
                    colors:['#c42525','#8bbc21']
			    });

        }
    });
}
;(function($){

	
	
	//;(function(){
		
		get_track(1,'');
	//})();
})(jQuery);