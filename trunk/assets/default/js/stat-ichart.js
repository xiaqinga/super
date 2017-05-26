$(function(){
	var data = [
	         	{
	         		name : '缺陷',
	         		value:[45,52,54,74,90,84,45,52,54,74,90,84],
	         		color:'#DB524B'
	         	},
	         	{
	         		name : '已解决',
	         		value:[60,80,105,125,108,120,45,52,54,74,90,84],
	         		color:'#58B957'
	         	},
	         	{
	         		name : '项目',
	         		value:[45,52,54,74,90,84,45,52,54,74,90,84],
	         		color:'#F2AE43'
	         	},
	         	{
	         		name : '需求',
	         		value:[60,80,105,125,108,120,45,52,54,74,90,84],
	         		color:'#2A8FD2'
	         	}	         	
	         ];
	var chart = new iChart.ColumnMulti2D({
			render : 'canvasDiv',
			data: data,
			labels:["1月","2月","3月","4月","5月","6月","7月","8月","9月","10月","11月","12月"],
			title : 'BUG统计表',
			width : 980,
			height : 600,
			column_width: 30,
			background_color : '#ffffff',
			legend:{
				enable:true,
				background_color : null,
				border : {
					enable : false
				}
			},
			coordinate:{
				background_color : '#ffffff',
				scale:[{
					 position: 'left',	
					 start_scale: 0,
					 end_scale: 200,
					 scale_space: 20
				}],
				width: 800,
				height: 500,				
			}
	});
	chart.draw();
});			