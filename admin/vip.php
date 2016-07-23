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
		$data['domain']=isset($_POST['domain'])?$_POST['domain']:"";
		$data['templates']=isset($_POST['templates'])?$_POST['templates']:"";
		if(!empty($data['title'])&&is_numeric($data['domain'])&&is_numeric($data['templates'])){
			if(info_add('vip',$data)==false){
				echo "数据已存在";exit;
			}
		}
		break;
	case "edit":
		$id = isset($_GET['id']) ? $_GET['id'] : "";
		break;
	case "save":
		$title=isset($_POST['title'])?"'".$_POST['title']."'":"";
		$domain=isset($_POST['domain'])?$_POST['domain']:"";
		$templates=isset($_POST['templates'])?$_POST['templates']:"";
		$id = isset($_GET['id']) ? $_GET['id'] : "";
		if(is_numeric($domain)&&is_numeric($templates)&&is_numeric($id)) {
			$mysqli->query("update vip set title=".$title.",domain=".$domain.",templates=".$templates." where id=".$id);
			header("Location: vip.php?page=".$page);
		}
		break;
	case "del":
		$id = isset($_GET['id']) ? $_GET['id'] : "";
		if(is_numeric($id)) {
			info_del('vip',$page,$id);
		}
		break;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>VIP级别管理-<?=SYSTEM_NAME?></title>
	<link rel="stylesheet" type="text/css" href="css/css.css" />
	<link rel="stylesheet" type="text/css" href="css/pageGroup.css" />
</head>

<body>
<div id="pageAll">
	<div class="pageTop">
		<div class="page">
			<img src="img/coin02.png" style="float:left;margin-top:10px;" /><span><a href="main.php">首页</a>&nbsp;-&nbsp;-</span>&nbsp;VIP级别管理
		</div>
	</div>

	<div class="page">
		<div class="connoisseur">
			<div class="conform clear">
				<div class="cfD">
					<form action="?action=add" method="post">
						<input class="userinput vpr" style="width:200px;" type="text" name="title" placeholder="级别"/>
						<input class="userinput vpr" style="width:100px;" type="text" name="domain" placeholder="域名数量"/>
						<input class="userinput vpr" style="width:100px;" type="text" name="templates" placeholder="模板数量"/>
						<button class="userbtn">添加</button>
					</form>
				</div>
			</div>
			<div class="conShow">
				<span style="float:right">合计(<?=data_num('vip')?>)</span>
				<table border="1" cellspacing="0" cellpadding="0" width="100%">
					<tr>
						<td width="66px" class="tdColor tdC">序号</td>
						<td width="300px" class="tdColor">级别</td>
						<td class="tdColor">域名数量</td>
						<td width="100px" class="tdColor">模板数量</td>
						<td width="100px" class="tdColor">操作</td>
					</tr>
					<?php
					if(info_list('vip',$page)){
						foreach(info_list('vip',$page) as $row){
							if (isset($id)&&$id == $row['id']&&$action=="edit") {
								?>
								<tr bgcolor="#999">
									<form action='?action=save&page=<?= $page ?>&id=<?= $id ?>' method='post'>
										<td height="40px"><?= $row['id'] ?></td>
										<td style="text-align:left;padding-left:20px;"><input type="text" name="title" value="<?= $row['title'] ?>"/></td>
										<td><input type="text" name="domain" value="<?= $row['domain'] ?>"/></td>
										<td><input type="text" name="templates" value="<?= $row['templates'] ?>"/></td>
										<td>
											<button><img src="img/ok.png"></button><a href="?page=<?= $page ?>"><img src="img/no.png"></a></td>
									</form>
								</tr>
								<?php
							}else {
								?>
								<tr>
									<td height="40px"><?= $row['id'] ?></td>
									<td style="text-align:left;padding-left:20px;"><?= $row['title'] ?></td>
									<td><?= $row['domain'] ?></td>
									<td><?= $row['templates'] ?></td>
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
						<?=list_page('vip',$page)?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>