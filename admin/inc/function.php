<?php
//验证域名授权,vip级别,域名数量,模板数量,结果写入到lic.php中
function get_vip_shouquan($domain){
    global $mysqli;
    $domain=base64_encode($domain);
    $sql="select d.title,d.enddate,v.title as vip,v.domain,v.templates from domain as d,vip as v where d.vip_id=v.id and d.title='".$domain."' and d.ok=1";
    $result=$mysqli->query($sql);
    if($result->num_rows>0){
        //更新验证时间
        $sql="update domain set login_time=".time()." where title='".$domain."'";
        $result=$mysqli->query($sql);
        return json_encode($result->fetch_assoc());
    }else{
        return false;//未授权或已过期
    }
}
////获取vip级别,域名数量,模板数量
//function get_vip_jibie($domain){
//    global $mysqli;
//    if(get_vip_shouquan($domain)){
//        $domain=base64_encode($domain);
//        $sql="select vip,domain,templates from vip where id=(select vip_id from domain where title='".$domain."')";
//        $result=$mysqli->query($sql);
//        if($result->num_rows>0){
//            return json_encode($result->fetch_assoc());
//        }
//    }else{
//        return false;
//    }
//}
//升级列表
function get_update_list(){
    global $mysqli;
    $sql="select * from update order by id desc";
    $result=$mysqli->query($sql);
    if($result->num_rows>0){
        return json_encode($result->fetch_assoc());
    }
}
//模板列表
function get_templates_list(){
    global $mysqli;
    $sql="select * from templates order by id desc";
    $result=$mysqli->query($sql);
    if($result->num_rows>0){
        return json_encode($result->fetch_assoc());
    }
}
////更新在线时间及判断是否过期
//function update_domain_login($domain){
//    global $mysqli;
//    if(get_vip_shouquan($domain)){
//        $domain=base64_encode($domain);
//        $enddate=$mysqli->query("select enddate from domain where title='".$domain."'")->fetch_object()->enddate;
//        $sql="update domain set login_time=".time();
//        if(time()>$enddate){
//            $sql.=",ok=0";
//        }
//        $sql.=" where title='".$domain."'";
//        $result=$mysqli->query($sql);
//        if($mysqli->affected_rows>0){
//            return true;
//        }
//    }else{
//        return false;//未授权,免费版
//    }
//}
//后台
//信息列表
function info_list($from,$page){
    global $mysqli;
    $page_size=30;
    $sql="select id from ".$from;
    $result=$mysqli->query($sql);
    $total=$result->num_rows;
    $pagenum=ceil($total/$page_size);
    if($page<1||!is_numeric($page)||$page>$pagenum)$page=1;
    $min=($page-1)*$page_size;
    $sql="select * from ".$from." order by id desc limit ".$min.",".$page_size;
    $result=$mysqli->query($sql);
    if($result->num_rows>0){
        while($row = $result->fetch_assoc())
        {
//            $row['title']=base64_decode($row['title']);
//            $row['vip']=$mysqli->query("select vip from vip where id=".$row['vip_id'])->fetch_object()->vip;
//            $row['startdate']=date('Y-m-d H:i:s',$row['startdate']);
//            $row['enddate']=date('Y-m-d H:i:s',$row['enddate']);
//            $row['login_time']=$row['login_time']?date('m-d H:i:s',$row['login_time']):"";
//            $row['ok']=$row['ok']?"开启":"关闭";
            $data[] = $row;
        }
        return $data;
    }
}
function list_page($from,$page,$type=''){
    global $mysqli;
    $page_size=30;
    $sql="select id from ".$from;
    $result=$mysqli->query($sql);
    $total=$result->num_rows;
    if($total>0){
        $pagenum=ceil($total/$page_size);
        if($page<1||!is_numeric($page)||$page>$pagenum)$page=1;
        $shang=$page>1?$page-1:1;
        $str="<div class=\"pageUp\"><a href=\"?page=".$shang."\">上一页</a></div>";
        $str.="<div class=\"pageList clear\"><ul>";
        $str.="<li class=\"on\">$page</li>";
        $str.="</ul></div>";
        $xia=$page>=$pagenum?$pagenum:$page+1;
        $str.="<div class=\"pageDown\"><a href=\"?page=$xia\">下一页</a></div>";
        $str.="<div class=\"pagejump\"><form action='' method='get'>共{$pagenum}页 | 跳转到<input type='text' name='page'/>页</form></div>";
        return $str;
    }
}
function data_num($from){
    global $mysqli;
    $sql="select count(*) as count from ".$from;
    $num_all=$mysqli->query($sql)->fetch_object()->count;
    return $num_all;
}
function info_add($from,$data){
    global $mysqli;
    if(is_array($data)){
        $result=$mysqli->query("select id from ".$from." where title=".$data['title']);
        if($result&&$result->num_rows>0){
            return false;//已存在
        }else{
            $key=implode(",",array_keys($data));
            $value=implode(",",array_values($data));
            $mysqli->query("insert into ".$from." (".$key.") values(".$value.")");
        }
    }else{
        $mysqli->query("insert into ".$from." (`title`) values('".$data."')");
    }
    header("Location: ".$from.".php");
}
function info_save($from,$data,$page,$id){
    global $mysqli;
    $mysqli->query("update ".$from." set title='".$title."' where id=".$id);
    header("Location: info.php?act=".$from."&page=".$page);
}
function info_del($from,$page,$id){
    global $mysqli;
    $mysqli->query("delete from ".$from." where id=".$id);
    header("Location: ".$from.".php?page=".$page);
}
?>