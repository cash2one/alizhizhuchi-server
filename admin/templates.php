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
		$data['detail']=isset($_POST['detail'])?"'".$_POST['detail']."'":"";
		$data['date']=time();
		if(!empty($data['title'])&&!empty($data['detail'])&&$_FILES['zip']['type']=='application/zip'&&$_FILES['thumb']['type']=='image/jpeg'){
			if ($_FILES["zip"]["error"] > 0&&$_FILES["thumb"]["error"] > 0)
			{
				echo "文件错误,上传失败";exit;
			}
			else
			{
//		echo "Upload: " . $_FILES["zip"]["name"] . "";
//		echo "Type: " . $_FILES["zip"]["type"] . "";
				move_uploaded_file($_FILES["zip"]["tmp_name"],"../templates/" . $_FILES["zip"]["name"]);
				$data['zip']="'/templates/". $_FILES["zip"]["name"]."'";
				move_uploaded_file($_FILES["thumb"]["tmp_name"],"../templates/" . $_FILES["thumb"]["name"]);
				$data['thumb']="'/templates/". $_FILES["thumb"]["name"]."'";
				if(info_add('templates',$data)==false){
					echo "数据已存在";exit;
				}
			}
		}
		break;
	case "edit":
		$id = isset($_GET['id']) ? $_GET['id'] : "";
		break;
	case "save":
		$detail=isset($_POST['detail'])?"'".$_POST['detail']."'":"";
		$id = isset($_GET['id']) ? $_GET['id'] : "";
		if(!empty($detail)&&is_numeric($id)) {
			$mysqli->query("update templates set detail=".$detail." where id=".$id);
			header("Location: templates.php?page=".$page);
		}
		break;
	case "del":
		$id = isset($_GET['id']) ? $_GET['id'] : "";
		if(!empty($act)&&!empty($id)&&is_numeric($id)) {
			info_del($act,$page,$id);
		}
		break;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>模板管理-<?=SYSTEM_NAME?></title>
	<link rel="stylesheet" type="text/css" href="css/css.css" />
	<link rel="stylesheet" type="text/css" href="css/pageGroup.css" />
</head>

<body>
<div id="pageAll">
	<div class="pageTop">
		<div class="page">
			<img src="img/coin02.png" style="float:left;margin-top:10px;" /><span><a href="main.php">首页</a>&nbsp;-&nbsp;-</span>&nbsp;模板管理
		</div>
	</div>

	<div class="page">
		<div class="connoisseur">
			<div class="conform clear">
				<div class="cfD">
					<form action="?action=add" method="post" enctype="multipart/form-data">
						<input class="userinput vpr" style="width:100px;" type="text" name="title" placeholder="名称"/>
						<input class="userinput vpr" style="width:100px;" type="text" name="detail" placeholder="说明"/>
						模板包:<input type="file" name="zip"/>
						缩略图:<input type="file" name="thumb"/>
						<button class="userbtn">添加</button>
					</form>
				</div>
			</div>
			<div class="conShow">
				<span style="float:right">合计(<?=data_num('templates')?>)</span>
				<table border="1" cellspacing="0" cellpadding="0" width="100%">
					<tr>
						<td width="66px" class="tdColor tdC">序号</td>
						<td width="100px" class="tdColor">名称</td>
						<td class="tdColor">说明</td>
						<td width="200px" class="tdColor">模板包</td>
						<td width="200px" class="tdColor">图片</td>
						<td width="100px" class="tdColor">添加时间</td>
						<td width="100px" class="tdColor">操作</td>
					</tr>
					<?php
					if(info_list('templates',$page)){
						foreach(info_list('templates',$page) as $row){
							if (isset($id)&&$id == $row['id']&&$action=="edit") {
								?>
								<tr bgcolor="#999">
									<form action='?action=save&page=<?= $page ?>&id=<?= $id ?>' method='post'>
										<td height="40px"><?= $row['id'] ?></td>
										<td style="text-align:left;padding-left:20px;"><?= $row['title'] ?></td>
										<td><input type="text" name="detail" value="<?= $row['detail'] ?>"/></td>
										<td><?= $row['zip'] ?></td>
										<td><img src="<?= $row['thumb'] ?>" width="100"></td>
										<td><?= date('Y-m-d H:i:s',$row['date']) ?></td>
										<td>
											<button><img src="img/ok.png"></button><a href="?act=<?= $act ?>&page=<?= $page ?>"><img src="img/no.png"></a></td>
									</form>
								</tr>
								<?php
							}else {
								?>
								<tr>
									<td height="40px"><?= $row['id'] ?></td>
									<td style="text-align:left;padding-left:20px;"><?= $row['title'] ?></td>
									<td><?= $row['detail'] ?></td>
									<td><?= $row['zip'] ?></td>
									<td><img src="<?= $row['thumb'] ?>" width="100"></td>
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
						<?=list_page('templates',$page)?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>