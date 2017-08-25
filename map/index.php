<?php
include_once("./connect.php");
$data['x']=$_GET['x'];
$data['y']=$_GET['y'];
$id=$_GET['id'];

$query=mysql_query("select `data` from map where id={$id}");

$rs=mysql_fetch_array($query);

$odata=unserialize($rs['data']);
$odata[]=$data;
print_r($odata);
$data=serialize($odata);

mysql_query("update map set data='{$data}' where id={$id}");
?>
