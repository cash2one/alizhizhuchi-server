<?php
header("HTTP/1.1 200 OK");
error_reporting(0);
require("admin/inc/data.php");

$act=isset($_GET['act'])?$_GET['act']:"";
$domain=isset($_GET['domain'])?$_GET['domain']:"";
$domain=!empty($_GET['domain'])?$_GET['domain']:"";

switch($act){
	case "shouquan":
		echo get_vip_shouquan($domain);
		break;
	case "vipjibie":
		echo get_vip_jibie($domain);
		break;
	case "update":
		echo get_update_list($domain);
		break;
	case "login":
		echo update_domain_login($domain);
		break;
	default:
		header("Location: http://www.alizhizhuchi.top");
		break;
}
?>