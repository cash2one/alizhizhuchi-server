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
        $mysqli->query($sql);
        return json_encode($result->fetch_assoc());
    }else{
        return "5pyq5o6I5p2D";//未授权或已关闭
    }
}
//获取vip级别,域名数量,模板数量
function get_vip_jibie(){
    global $mysqli;
    $sql="select title,domain,templates,dingzhi,zhichi,yuejia,nianjia,url from vip order by paixu asc";
    $result=$mysqli->query($sql);
    if($result->num_rows>0){
        while($row=$result->fetch_assoc()){
            if($row['title']=='SVIP'){
                $row['domain']='无限';
                $row['templates']='无限';
            }
            $data[0][]=$row;
        }
        $data['shuoming']=array("VIP级别","域名数量","模板数量","定制模板","技术支持","月售价","年售价");
        return json_encode($data);
    }
}
//获取公告列表
function get_gonggao_list(){
    global $mysqli;
    $sql="select * from gonggao order by id desc limit 6";
    $result=$mysqli->query($sql);
    if($result->num_rows>0){
        while($row=$result->fetch_assoc()){
            $data[]=$row;
        }
        return json_encode($data);
    }
}
//升级列表
function get_update_list($ver_title){
    global $mysqli;
    $sql = "select * from gengxin where id>(select id from gengxin where title='".$ver_title."') limit 1";//获取最新数据
    $result = $mysqli->query($sql);
    if ($result->num_rows > 0) {
        return json_encode($result->fetch_assoc());
    }
}
//模板列表
function get_templates_list(){
    global $mysqli;
    $sql = "select * from templates order by id desc";
    $result = $mysqli->query($sql);
    if ($result->num_rows > 0) {
        while($row=$result->fetch_assoc()){
            $data[]=$row;
        }
        return json_encode($data);
    }
}
//接收客户端数据
function update_domain_data($domain,$domain_num,$spider_num,$ver_title=''){
    global $mysqli;
    $domain=base64_encode($domain);
    $domain_id=$mysqli->query("select id from domain where title='" . $domain . "'")->fetch_object()->id;
    if($domain_id){
        //更新域名数量
        $mysqli->query("update domain set domain_num=".$domain_num.",ver='".$ver_title."' where title='".$domain."'");
        //更新蜘蛛数量,日期为昨日
        $res=$mysqli->query("select id from spider where domain_id=".$domain_id." DATE_FORMAT(FROM_UNIXTIME(date),'%Y-%m-%d') = date_sub(current_date(),interval 1 day)")->fetch_object()->id;
        if(!$res) {
            $mysqli->query("insert into spider (domain_id,spider_num,date) values(" . $domain_id . "," . $spider_num . "," . strtotime("-1 day") . ")");
            return true;
        }
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
function info_list($from,$page,$where=''){
    global $mysqli;
    $page_size=30;
    $sql="select id from ".$from;
    if($where){
        $sql.=" where ".$where;
    }
    $result=$mysqli->query($sql);
    $total=$result->num_rows;
    $pagenum=ceil($total/$page_size);
    if($page<1||!is_numeric($page)||$page>$pagenum)$page=1;
    $min=($page-1)*$page_size;
    $sql="select * from ".$from;
    if($where){
        $sql.=" where ".$where;
    }
    $sql.=" order by id desc limit ".$min.",".$page_size;
    $result=$mysqli->query($sql);
    if($result->num_rows>0){
        while($row = $result->fetch_assoc())
        {
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
//$from:数据表;$num:统计天数;$day:具体某天;$type:搜索引擎;
function data_num($from,$num='',$day='',$domain_id=''){
    global $mysqli;
    $sql="select count(*) as count from ".$from;
    if($from=='spider'){
        $sql="select SUM(spider_num) as count from ".$from;
        if($num && is_numeric($num)){
            $num='-'.$num.' day';
            $riqi=strtotime(date('Y-m-d',strtotime($num)));
            //$riqi=time()-$num*24*3600;
            $sql.=" where date>$riqi";
        }
        if($day){
            $sql.=" where DATE_FORMAT(FROM_UNIXTIME(date),'%Y-%m-%d') = '".date('Y-m-d',strtotime($day))."'";
        }
        if($domain_id){
            $sql.=" where domain_id=".$domain_id;
        }
    }
    $num_all=$mysqli->query($sql)->fetch_object()->count;
    return $num_all;
}
function info_add($from,$data){
    global $mysqli;
    if(is_array($data)){
        $result=$mysqli->query("select id from ".$from." where title=".$data['title']);
        if($result->num_rows){
            return false;//已存在
        }else{
            $key=implode(",",array_keys($data));
            $value=implode(",",array_values($data));
            $mysqli->query("insert into ".$from." (".$key.") values(".$value.")");
            if($from=='vip') {//如果是vip,更新排序为当前id
                $new_id = $mysqli->insert_id;
                $mysqli->query("update vip set paixu=".$new_id." where id=".$new_id);
            }
        }
    }else{
        $mysqli->query("insert into ".$from." (`title`) values('".$data."')");
    }
    header("Location: ".$from.".php");
}
function info_del($from,$page,$id){
    global $mysqli;
    $mysqli->query("delete from ".$from." where id=".$id);
    header("Location: ".$from.".php?page=".$page);
}
?>