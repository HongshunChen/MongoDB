
<?php

include_once("./connect.php");
$marker=$_GET['marker'];
$openid=$_GET['openid'];
$m = new MongoClient();    // 连接到mongodb
$db = $m->weixin;            // 选择一个数据库
$collection = $db->map; // 选择集合

$where=array( '$and' => array( array('marker' =>$marker), array('openid'=>$openid ) ));
//$where=array( '$and' => array( array('type' =>'mongo'), array('openid'=>'abc' ) ));
// 选择返回的字段内容  
$field = array('position');
 
$find = $collection->findOne($where,$field);

echo json_encode($find['position']);
exit;


