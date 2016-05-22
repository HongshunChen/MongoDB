<?php

 // 连接到mongodb
   $m = new MongoClient();
   //print_r($m);
   echo "Connection to database successfully<br>";
   // 选择一个数据库,没有会创建
   $db = $m->djtushop;
   //print_r($db);
   echo "Database mydb selected<br>";
   $collection = $db->createCollection("user");
   echo "Collection created succsessfully<br>";
   $document = array( 
      'username'=>'admin',
      'password'=>md5('1'),
      'sex'=>'男',
      'face'=>'data/admin.png',
      'regTime'=>time(),
      'activeFlag'=>1,
      'email'=>'admin@qq.com',
   );
   $b=$collection->insert($document);
   print_r($b);
   echo "Document inserted successfully";
   $cursor = $collection->find();
   print_r($cursor);
   // 迭代显示文档标题
   foreach ($cursor as $document) {
      print_r($document) . "\n";
   }
   // 更新文档
   $collection->update(array("username"=>"admin"), array('$set'=>array("username"=>"MongoDB")));//注意这里只会更新一一条
   echo "Document updated successfully";
   // 显示更新后的文档
   $cursor = $collection->find();
   // 循环显示文档标题
   echo "Updated document";
   foreach ($cursor as $document) {
      echo $document["username"] . "\n";
   }

    // 移除文档
   $collection->remove(array("username"=>"admin"), array("justOne" => true));
   echo "Documents deleted successfully";
   
   // 显示可用文档数据
   $cursor = $collection->find();
   // iterate cursor to display title of documents
   echo "Updated document";
   foreach ($cursor as $document) {
      echo $document["username"] . "\n";
   }