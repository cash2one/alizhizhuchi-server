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
		$data['title']=isset($_POST['title'])?"'".base64_encode($_POST['title'])."'":"";
		$data['vip_id']=isset($_POST['vip_id'])?$_POST['vip_id']:"";
		$data['enddate']=isset($_POST['enddate'])?strtotime($_POST['enddate']):time();
		$data['startdate']=time();
		$data['ok']=1;
		if(!empty($data['title'])&&!empty($data['vip_id'])){
			if(info_add('domain',$data)==false){
				echo "数据已存在";exit;
			}
			file_get_contents("http://".base64_decode($title)."/index.php?a=shouquan");
		}
		break;
	case "edit":
		$id = isset($_GET['id']) ? $_GET['id'] : "";
		break;
	case "save":
		$vip_id=isset($_POST['vip_id'])?$_POST['vip_id']:"";
		$enddate=isset($_POST['enddate'])?strtotime($_POST['enddate']):time();
		$ok=isset($_POST['ok'])?$_POST['ok']:0;
		$id = isset($_GET['id']) ? $_GET['id'] : "";
		if(!empty($vip_id)&&!empty($enddate)&&is_numeric($id)) {
			$mysqli->query("update domain set vip_id=".$vip_id.",enddate=".$enddate.",ok=".$ok." where id=".$id);
			//域名修改信息,发送强制授权更新
			$title=$mysqli->query("select title from domain where id=".$id)->fetch_object()->title;
			file_get_contents("http://".base64_decode($title)."/index.php?a=shouquan");
			header("Location: domain.php?page=".$page);
		}
		break;
	case "del":
		$id = isset($_GET['id']) ? $_GET['id'] : "";
		if(is_numeric($id)) {
			info_del('domain',$page,$id);
		}
		break;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>授权域名管理-<?=SYSTEM_NAME?></title>
	<link rel="stylesheet" type="text/css" href="css/css.css" />
	<link rel="stylesheet" type="text/css" href="css/pageGroup.css" />
</head>

<body>
<div id="pageAll">
	<div class="pageTop">
		<div class="page">
			<img src="img/coin02.png" style="float:left;margin-top:10px;" /><span><a href="main.php">首页</a>&nbsp;-&nbsp;-</span>&nbsp;授权域名管理
		</div>
	</div>

	<div class="page">
		<div class="connoisseur">
			<div class="conform clear">
				<div class="cfD">
					<form action="?action=add" method="post">
						<input class="userinput vpr" type="text" name="title" placeholder="域名"/>
						<select name="vip_id" id="vip">
							<option value="">VIP级别</option>
						<?php
						$sql="select * from vip order by id asc";
						$result=$mysqli->query($sql);
						while($row=$result->fetch_assoc()){
							echo "<option value='".$row['id']."'>".$row['title']."</option>";
						}
						?>
						</select>
						<input class="userinput vpr" style="width:150px;" type="text" name="enddate" placeholder="过期时间"/>
						<button class="userbtn">添加</button>
					</form>
				</div>
			</div>
			<div class="conShow">
				<span style="float:right">合计(<?=data_num('domain')?>)</span>
				<table border="1" cellspacing="0" cellpadding="0" width="100%">
					<tr>
						<td width="66px" class="tdColor tdC">序号</td>
						<td width="250px" class="tdColor">域名</td>
						<td class="tdColor">VIP</td>
						<td width="100px" class="tdColor">在线时间</td>
						<td width="50px" class="tdColor">状态</td>
						<td width="150px" class="tdColor">购买时间</td>
						<td width="150px" class="tdColor">过期时间</td>
						<td width="100px" class="tdColor">操作</td>
					</tr>
					<?php
					if(info_list('domain',$page)){
						foreach(info_list('domain',$page) as $row){
							if (isset($id)&&$id == $row['id']&&$action=="edit") {
								?>
								<tr bgcolor="#999">
									<form action='?action=save&page=<?= $page ?>&id=<?= $id ?>' method='post'>
										<td height="40px"><?= $row['id'] ?></td>
										<td style="text-align:left;padding-left:20px;"><?= base64_decode($row['title']) ?></td>
										<td><select name="vip_id" id="vip">
												<option value="">VIP级别</option>
												<?php
												$sql="select * from vip order by id asc";
												$result=$mysqli->query($sql);
												while($row2=$result->fetch_assoc()){
													$selected=$row2['id']==$row['vip_id']?"selected":"";
													echo "<option value='".$row2['id']."' ".$selected.">".$row2['title']."</option>";
												}
												?>
											</select></td>
										<td><?= $row['login_time']?date('m-d H:i:s',$row['login_time']):"" ?></td>
										<td>
											<select name="ok">
												<option value="1">开启</option>
												<option value="0"<?if($row['ok']==0){echo " selected";}?>>关闭</option>
											</select>
										</td>
										<td><?= date('Y-m-d H:i:s',$row['startdate']) ?></td>
										<td><input type="text" name="enddate" value="<?= date('Y-m-d H:i:s',$row['enddate']) ?>"/></td>
										<td>
											<button><img src="img/ok.png"></button><a href="?page=<?= $page ?>"><img src="img/no.png"></a></td>
									</form>
								</tr>
								<?php
							}else {
								?>
								<tr>
									<td height="40px"><?= $row['id'] ?></td>
									<td style="text-align:left;padding-left:20px;"><?= base64_decode($row['title']) ?></td>
									<td><?= $mysqli->query("select title from vip where id=".$row['vip_id'])->fetch_object()->title ?></td>
									<td><?= $row['login_time']?date('m-d H:i:s',$row['login_time']):"" ?></td>
									<td><?= $row['ok']?"开启":"关闭" ?></td>
									<td><?= date('Y-m-d H:i:s',$row['startdate']) ?></td>
									<td><?= date('Y-m-d H:i:s',$row['enddate']) ?></td>
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
						<?=list_page('domain',$page)?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>