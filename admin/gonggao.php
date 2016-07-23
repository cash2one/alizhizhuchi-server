<?php
require("inc/data.php");
session_start();
if(!isset($_SESSION['admin_id'])||!isset($_SESSION['is_login'])||empty($_SESSION['admin_id'])||empty($_SESSION['is_login'])){
	header("Location: log.php");
}
$action=isset($_GET['action'])?$_GET['action']:"";
$page=isset($_GET['page'])?$_GET['page']:1;
$data=array();

switch($action){
	case "add":
		$data['title']=isset($_POST['title'])?"'".$_POST['title']."'":"";
		$data['url']=isset($_POST['url'])?"'".$_POST['url']."'":"";
		$data['date']=time();
		if(!empty($data['title'])&&!empty($data['url'])){
			if(info_add('gonggao',$data)==false){
				echo "数据已存在";exit;
			}
		}
		break;
	case "edit":
		$id = isset($_GET['id']) ? $_GET['id'] : "";
		break;
	case "save":
		$url=isset($_POST['url'])?"'".$_POST['url']."'":"";
		$id = isset($_GET['id']) ? $_GET['id'] : "";
		if(!empty($url)&&is_numeric($id)) {
			$mysqli->query("update gonggao set url=".$url." where id=".$id);
			//域名修改信息,发送强制授权更新
			header("Location: gonggao.php?page=".$page);
		}
		break;
	case "del":
		$id = isset($_GET['id']) ? $_GET['id'] : "";
		if(is_numeric($id)) {
			info_del('gonggao',$page,$id);
		}
		break;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>公告管理-<?=SYSTEM_NAME?></title>
	<link rel="stylesheet" type="text/css" href="css/css.css" />
	<link rel="stylesheet" type="text/css" href="css/pageGroup.css" />
</head>

<body>
<div id="pageAll">
	<div class="pageTop">
		<div class="page">
			<img src="img/coin02.png" style="float:left;margin-top:10px;" /><span><a href="main.php">首页</a>&nbsp;-&nbsp;-</span>&nbsp;公告管理
		</div>
	</div>

	<div class="page">
		<div class="connoisseur">
			<div class="conform clear">
				<div class="cfD">
					<form action="?action=add" method="post">
						<input class="userinput vpr" type="text" name="title" placeholder="标题"/>
						<input class="userinput vpr" type="text" name="url" placeholder="url地址"/>
						<button class="userbtn">添加</button>
					</form>
				</div>
			</div>
			<div class="conShow">
				<span style="float:right">合计(<?=data_num('gonggao')?>)</span>
				<table border="1" cellspacing="0" cellpadding="0" width="100%">
					<tr>
						<td width="66px" class="tdColor tdC">序号</td>
						<td width="400px" class="tdColor">标题</td>
						<td class="tdColor">url地址</td>
						<td width="150px" class="tdColor">添加时间</td>
						<td width="100px" class="tdColor">操作</td>
					</tr>
					<?php
					if(info_list('gonggao',$page)){
						foreach(info_list('gonggao',$page) as $row){
							if (isset($id)&&$id == $row['id']&&$action=="edit") {
								?>
								<tr bgcolor="#999">
									<form action='?action=save&page=<?= $page ?>&id=<?= $id ?>' method='post'>
										<td height="40px"><?= $row['id'] ?></td>
										<td style="text-align:left;padding-left:20px;"><?= $row['title'] ?></td>
										<td><input type="text" name="url" value="<?= $row['url'] ?>"/></td>
										<td><?= date('Y-m-d H:i:s',$row['date']) ?></td>
										<td>
											<button><img src="img/ok.png"></button><a href="?page=<?= $page ?>"><img src="img/no.png"></a></td>
									</form>
								</tr>
								<?php
							}else {
								?>
								<tr>
									<td height="40px"><?= $row['id'] ?></td>
									<td style="text-align:left;padding-left:20px;"><?=$row['title']?></td>
									<td><?= $row['url'] ?></td>
									<td><?= date('Y-m-d H:i:s',$row['date']) ?></td>
									<td>
										<a href="?action=edit&page=<?=$page?>&id=<?= $row['id'] ?>"><img class="operation" src="img/update.png"></a> <a href="?action=del&page=<?=$page?>&id=<?=$row['id']?>"><img class="operation delban" src="img/delete.png"></a></td>
								</tr>
								<?php
							}
						}
					}
					?>
				</table>

				<div class="paging">
					<div id="pageGro" class="cb clear">
						<?=list_page('gonggao',$page)?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>