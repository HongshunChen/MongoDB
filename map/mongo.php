<?php
include_once("./connect.php");
$data['latitude']=$_GET['x'];
$data['longitude']=$_GET['y'];
$route=$_GET['route'];
$openid=$_GET['openid'];
//$data['s']=$_GET['s'];
if(!isset($_GET['x'])){
    echo '暂无数据';
    exit;
}
$m = new MongoClient();    // 连接到mongodb
$db = $m->weixin;            // 选择一个数据库
$collection = $db->map; // 选择集合
$where=array( '$and' => array( array('type' =>$route), array('openid'=>$openid ) ));
//$where=array( '$and' => array( array('type' =>'mongo'), array('openid'=>'abc' ) ));
// 选择返回的字段内容  
$field = array('position');
$cursor = $collection->findOne($where,$field);
//var_dump($cursor);
$position=$cursor['position'];
//// 循环显示文档标题
//foreach ($cursor as $document) {
//	$position=$document["position"] ;
//        
//}

$position[]=$data;

// 更新文档
$collection->update($where, array('$set'=>array("position"=>$position)));
//$collection->update(array("type"=>"mongo"), array('$set'=>array("position"=>$position)));
// 显示更新后的文档
$cursor = $collection->find();
// 循环显示文档标题
//foreach ($cursor as $document) {
//    print_r($document);
//}
