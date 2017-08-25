<?php

/**
 * Description of mongoDB
 *
 * @author DOIT
 */
class mongod {

    static private $instance;
    static private $connectSourse;
    private $config = array(
        'host' => 'localhost',
        'user' => 'admin',
        'password' => 'ouzhou360',
        'database' => 'crm'
    );

           
           
    private function __construct() {
        
    }

    private function __clone() {
        //do something 
    }

    static public function getInstance() {     //单例模式使用
        if (!(self::$instance instanceof self)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * 
     * @return type
     */
    public function connect() {
          
        if (!self::$connectSourse) {
            self::$connectSourse = new MongoClient('mongodb://'.$this->config['user'].':'. $this->config['password'].'@'.$this->config['host']);
            if (!self::$connectSourse) {
                
                throw new Exception('mongodb connect error' );
            }
          
        }

        return self::$connectSourse;
    }

}

$connect=mongod::getInstance()->connect();
 
            $db = $connect->crm;            // 选择一个数据库
            $collection = $db->project; // 选择集合

            $where = array('cusId' => 4);

            $field = array('data');

           
            $cursor = $collection->find($where, $field)->sort(array('_id' => -1))->limit(1);
              //循环显示文档标题
            foreach ($cursor as $document) {
                $data=$document['data'];
                               
            }
          echo  json_encode($data);
           
//
//$sql="select * from t_user";
//$result=mysql_query($sql,$connect);
//var_dump($result);

