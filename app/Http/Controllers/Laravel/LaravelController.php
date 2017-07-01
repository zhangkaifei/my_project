<?php

namespace App\Http\Controllers\Laravel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Traint\CommonTraint;
use App\Http\Model\Mongodb;
use Illuminate\Support\Facades\App;
class LaravelController extends Controller
{
    use CommonTraint;
    private $db;
    public function __construct()
    {
        $this->db = new Mongodb();
    }
    //
    public function index()
    {
        $id = '5937c70bc67983098b4807e1';
        $col = $this->db->table('articles');
        $art = $col->find($id);
        if(!empty($art))
        {
            //$where['_id'] = $col->convertKey($art['_id']);
            $up_id = '5937ad89c67983105e20f501';
            $data = ['_id'=>$col->convertKey($up_id) , 'post_id'=>$id];
            $result = $this->db->table('comments')->update($data);
            if($result > 0)
            {
                return '更新成功';
            }
        }

        return '更新失败';
    }

    public function chkEnv()
    {
        $config = [
            'conf.app'=>[config('app.name')],
            'conf.database'=>[config('database.default')],
            'conf.services'=>[config('services.mailgun.domain')],
        ];

        echo __DIR__;
        return '取得当前应用的配置信息';
    }

}
