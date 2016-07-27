<?php
require("inc/data.php");
session_start();
if(!isset($_SESSION['admin_id'])||!isset($_SESSION['is_login'])||empty($_SESSION['admin_id'])||empty($_SESSION['is_login'])){
	header("Location: log.php");
}
$id=isset($_GET['id'])?$_GET['id']:"";
$page=isset($_GET['page'])?$_GET['page']:1;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>授权域名详细-<?=SYSTEM_NAME?></title>
	<link rel="stylesheet" type="text/css" href="css/css.css" />
	<link rel="stylesheet" type="text/css" href="css/pageGroup.css" />
</head>

<body>
<div id="pageAll">
	<div class="pageTop">
		<div class="page">
			<img src="img/coin02.png" style="float:left;margin-top:10px;" /><span><a href="main.php">首页</a>&nbsp;-&nbsp;-</span>&nbsp;授权域名详细
		</div>
	</div>

	<div class="page">
		<div class="connoisseur">
			<div class="conform clear">
				<div class="cfD">
					<?=base64_decode($mysqli->query("select title from domain where id=".$id)->fetch_object()->title)?>
				</div>
			</div>
			<div class="conShow">
				<span style="float:right">合计(
					<?=$mysqli->query("select SUM(spider_num) as all_num from spider where domain_id=".$id)->fetch_object()->all_num?>
					)</span>
				<table border="1" cellspacing="0" cellpadding="0" width="100%">
					<tr>
						<td width="50px" class="tdColor tdC">序号</td>
						<td class="tdColor">蜘蛛数量</td>
						<td width="150px" class="tdColor">日期</td>
					</tr>
					<?php
					$where='domain_id='.$id;
					if(info_list('spider',$page,$where)){
						foreach(info_list('spider',$page,$where) as $row){
							?>
							<tr>
								<td height="40px"><?= $row['id'] ?></td>
								<td style="text-align:left;padding-left:20px;"><?= $row['spider_num']?></td>
								<td><?= date('Y-m-d',$row['date']) ?></td>
							</tr>
							<?php
						}
					}
					?>
				</table>

				<div class="paging">
					<div id="pageGro" class="cb clear">
						<?=list_page('spider',$page)?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>