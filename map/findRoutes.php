<?php

include_once("./connect.php");

$openid=$_GET['openid'];
$m = new MongoClient();    // 连接到mongodb
$db = $m->weixin;            // 选择一个数据库
$collection = $db->map; // 选择集合

$where=array('openid'=>$openid );
//$where=array( '$and' => array( array('type' =>'mongo'), array('openid'=>'abc' ) ));
// 选择返回的字段内容  
$field =array("type");
 
$cursor = $collection->find($where,$field)->sort(array('_id' => -1, ));

 //循环显示文档标题
foreach ($cursor as $document) {
    $routes[]=$document['type'];
}
echo json_encode($routes);
exit;


