<?php
header("HTTP/1.1 200 OK");
error_reporting(0);
require("admin/inc/data.php");

$act=isset($_REQUEST['act'])?$_REQUEST['act']:"";//正式上线,换为POST接受
$domain_num=isset($_REQUEST['domain_num'])?$_REQUEST['domain_num']:0;
$spider_num=isset($_REQUEST['spider_num'])?$_REQUEST['spider_num']:0;
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
	case "data"://接收客户端反馈的数据
		if($domain&&$spider_num&&is_numeric($spider_num)&&$domain_num&&is_numeric($domain_num)){
			update_domain_data($domain,$domain_num,$spider_num);
		}
		break;
	default:
		header("Location: http://www.alizhizhuchi.top");
		break;
}
?>