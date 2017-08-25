<?php
include_once("./connect.php");
include_once("./function.php");
$appid="wxed772106d31c1e51";
$secret="03148d9c17bb5cc2d4077b7830c7999e";
$jscode=$_GET['code'];

$curl="https://api.weixin.qq.com/sns/jscode2session?appid={$appid}&secret={$secret}&js_code={$jscode}&grant_type=authorization_code";
$res=request($curl, $https = true, $method = 'GET', $data = null);
$content=json_decode($res);
$openid=$content->openid;

$sql="select `id` from map where openid='{$openid}'";
$query=mysql_query($sql);
//echo '操作数据库失败'.mysql_error()."<br>sql:{$sql}";

$rs=mysql_fetch_array($query);

if(empty($rs)){
    mysql_query("insert into map (openid,type,data) values('{$openid}','test','') ");
    

}
echo $openid;

