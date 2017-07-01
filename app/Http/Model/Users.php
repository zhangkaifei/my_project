<?php

namespace App\Http\Model;

use App\Http\Model\Mongodb;

class Users extends Mongodb
{
    //
    private $col;
    public function __construct()
    {
        parent::__construct();

        $class_name = strtolower(get_class($this));
        if(($name = strrchr($class_name,'\\')) !== false)
        {
            $table = substr($name , 1 );
            $col = $this->table($table);
        }else{
            $col = $this->table($class_name);
        }
        $this->col = $col;
    }

    public function getUsers()
    {
        return $this->col->get(['name','age']);
    }

    public function findUser($id)
    {
        return $this->col->find($id);
    }

    public function searchUser($name)
    {
        $user = $this->col->where(['name'=>$name])->first();
        return $user;
    }
}
