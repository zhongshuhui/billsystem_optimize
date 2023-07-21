<?php

namespace App\Tool;

use ClickHouseDB\Client;

class Clickhouse
{
    protected static $_instance = null;
    protected static $dbConfig;
    protected static $db;


    private static function setDbConfig($dbConfig){
        self::$dbConfig = [
            'database' => isset($dbConfig['database'])??'default',
            'executeTimeout' => isset($dbConfig['executeTimeout'])??'7200',
            'connectTimeOut' => isset($dbConfig['connectTimeOut'])??'3',
        ];
    }

    private function __construct()
    {
        self::$db = new Client(config('database.connections.clickhouse'));
        self::$db->database(self::$dbConfig['database']);
        self::$db->setTimeout(self::$dbConfig['executeTimeout']);       // 7200 seconds
        self::$db->setConnectTimeOut(self::$dbConfig['connectTimeOut']); // 3 seconds
    }



    /**
     * 单例模式创建Clickhouse类
     * @return Clickhouse
     */
    private static function getInstance($dbConfig)
    {
        if (self::$_instance === null) {
            self::setDbConfig($dbConfig);
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * 开放数据库名信息，写sql语句有时候需要数据库名，具体看个人需求
     * @return  string  返回数据库名
     */
    public static function getDb($dbConfig = [])
    {
        return self::getInstance($dbConfig)::$db;
    }

}
