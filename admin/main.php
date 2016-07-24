<?php
require("inc/data.php");
session_start();
if(!isset($_SESSION['admin_id'])||!isset($_SESSION['is_login'])||empty($_SESSION['admin_id'])||empty($_SESSION['is_login'])){
	header("Location: log.php");
}
for($i=6;$i>=0;$i--){
	$xAxisdata[]="'".date('n/j',time()-$i*24*3600)."'";
	$seriesdata[]=data_num('spider','',date('Y-m-d',time()-$i*24*3600));
}
$xAxisdata=implode(',',$xAxisdata);
$seriesdata=implode(',',$seriesdata);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>首页-<?=SYSTEM_NAME?></title>
<link rel="stylesheet" type="text/css" href="css/css.css" />
<script src="js/echarts.min.js"></script>
</head>

<body>
	<div id="pageAll">
		<div class="wellcom">欢迎使用<?=SYSTEM_NAME?></div>
		<div class="page">
			<div class="title">蜘蛛访问量<span>7日(<?=data_num('spider',7)?>) 30日(<?=data_num('spider',30)?>)</span></div>
			<div id="main" style="width: 900px;height:300px;"></div>
		</div>
	</div>
	<script type="text/javascript">
		// 基于准备好的dom，初始化echarts实例
		var myChart = echarts.init(document.getElementById('main'));
		// 指定图表的配置项和数据
		option = {
			tooltip: {
				trigger: 'axis'
			},
			toolbox: {
				show: true,
				feature: {
					saveAsImage: {}
				}
			},
			xAxis:  {
				type: 'category',
				boundaryGap: false,
				data: [<?=$xAxisdata?>]
			},
			yAxis: {
				type: 'value',
				axisLabel: {
					formatter: '{value}'
				}
			},
			series: [
				{
					name:'蜘蛛访问量',
					type:'line',
					data:[<?=$seriesdata?>],
					markPoint: {
						data: [
							{type: 'max', name: '最大值'},
							{type: 'min', name: '最小值'}
						]
					},
					markLine: {
						data: [
							{type: 'average', name: '平均值'}
						]
					}
				}
			]
		};
		myChart.setOption(option);
	</script>
</body>
</html>