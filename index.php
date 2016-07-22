<?php
header("HTTP/1.1 200 OK");
error_reporting(0);
require("admin/inc/data.php");

$act=isset($_REQUEST['act'])?$_REQUEST['act']:"";//正式上线,换为POST接受
$domain=isset($_REQUEST['domain'])?$_REQUEST['domain']:"";
$domain=!empty($domain)?$domain:"";

switch($act){
	case "shouquan":
		echo get_vip_shouquan($domain);
		break;
	case "vipjibie":
		echo get_vip_jibie();
		break;
	case "update":
		echo get_update_list();
		break;
	case "templates":
		echo get_templates_list();
		break;
//	case "login":
//		echo update_domain_login($domain);
//		break;
	default:
		header("Location: http://www.alizhizhuchi.top");
		break;
}
?>