<?php

include_once("./connect.php");
$route=$_GET['type'];
$openid=$_GET['openid'];
$m = new MongoClient();    // 连接到mongodb
$db = $m->weixin;            // 选择一个数据库
$collection = $db->map; // 选择集合

$where=array( '$and' => array( array('type' =>$route), array('openid'=>$openid) ));
//$where=array( '$and' => array( array('type' =>'aaa'), array('openid'=>'omSb80PDBy_lw-cvXwOSo-XF4MAw' ) ));
//$where=array('type'=>'mongo');
// 选择返回的字段内容  
$options =array("justOne" => true);
 
$result = $collection->remove($where,$options);

var_dump($result);
exit;


