<?php

namespace App\Http\Model;

use DB;

class Mongodb

{
    //创建mongodb数据库连接
    protected $mongoHandle;

    public function __construct()
    {
        /* @var $mongo \Jenssegers\Mongodb\Connection */
        $mongo  = DB::connection('mongodb');
        $this->mongoHandle = $mongo;
    }
    /**
     * 选择集合
     * @param $table
     * @return \Jenssegers\Mongodb\Query\Builder
     */
    public function table($table)
    {
        $table = $this->mongoHandle->collection($table);
        return $table;
    }
    /**
     * 切换到指定的mongodb数据库的集合
     * @param $db
     * @param $col
     * @return \MongoDB\Collection
     */
    public function switchDb($db,$col)
    {
        return $this->mongoHandle->getMongoClient()->selectDatabase($db)->selectCollection($col);
    }

    /**
     * 取得mongodb数据库实例
     * @return \MongoDB\Database
     */
    protected function getMgObject()
    {
        $mongoDB = $this->mongoHandle->getMongoDB();
        return $mongoDB;
    }

    /**
     * 取得mongodb数据库中的集合
     * @param $tbName
     * @return \MongoDB\Collection
     */
    public function getTable($tbName)
    {
        return $this->getMgObject()->selectCollection($tbName);
    }

}
