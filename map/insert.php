<?php
include_once("./connect.php");
if(isset($_GET['type'])){
    $route=$_GET['type'];
    $openid=$_GET['openid'];
    $m = new MongoClient();    // 连接到mongodb
    $db = $m->weixin;         // 选择一个数据库
    $collection = $db->map; // 选择集合
    $where=array( '$and' => array( array('type' =>$route), array('openid'=>$openid ) ));
    // 选择返回的字段内容  
    $field = array('_id');
    $find = $collection->findOne($where,$field );
    if($find){
        $result=array('status'=>'0','des'=>'您添加的路线已经存在，请重新添加');
         echo json_encode($result);
    }
    
    $document = array( 
            'openid'=>$openid,
            "type" => $route, 
            "position"=>array()
    );
    $collection->insert($document);
    $result=array('status'=>'1','des'=>'新建路线成功');
     echo json_encode($result);
   }

$result=array('status'=>'0','des'=>'新建路线失败');
echo json_encode($result);


