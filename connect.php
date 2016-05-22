<?php

// 连接到mongodb
$m = new MongoClient();
print_r($m);
$con=$m->connect();
if($con){
    echo "Connection to database successfully<br>";
    var_dump($con);
}


//$connections = $m->getConnections();
//print_r($connections);
 $db = $m->djtushop;// 选择一个数据库,没有会创建

$log = $db->createCollection(//相当于创建表
    "logger"
//    array(
//        'capped' => true,
//        'size' => 10*1024,
//        'max' => 10
//    )
);

for ($i = 0; $i < 20; $i++) {
    $log->insert(array("level" => 'warning', "msg" => "sample log message #$i",'i'=>$i, "ts" => new MongoDate()));
}
$log->insert(array('x'=>1));

//$msgs = $log->find(array('i' => array(
//                         '$gte'=>13,'$lte'=>20
//                         ),'level'=>'warning'
//        ));
//print_r($msgs->count());
//foreach ($msgs as $msg) {
//    print_r($msg);
////    print_r($msg['_id']);
////    echo $msg['_id']."\n";
//}
$test='{"likes":{"$ne":50}}';
print_r(json_decode($test,true));

$arr=array('i' => array(
                         '$lt'=>16,'$gt'=>20
                         ));
echo json_encode($arr);



$str='{"$or":[{"by":"菜鸟教程"},{"title": "MongoDB 教程"}]}';
print_r( json_decode($str,true));

$msgs = $log->find(array('$or'=>array(array('i' =>16,'level'=>'warning'),array('i' =>20,'level'=>'warning'))));
print_r($msgs->count());
foreach ($msgs as $msg) {
    print_r($msg);
//    print_r($msg['_id']);
//    echo $msg['_id']."\n";
}

