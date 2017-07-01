<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class XdebugController extends Controller
{
    //
    public function index()
    {
        $a = 0;
        $b = 5;
        $c = &$a;
        $info = self::getData();
        return $info . $c * ($a + $b);

    }

    public static function getData()
    {
        return '今天我们来学习一下Xdebug的使用';
    }

    /*
     * 目录及文件迭代
     */

    public function dir()
    {
        $dir = '../app';
        //$dir = dirname(dirname(__FILE__)).'/';
        $dir_array = scan_dir($dir);
        dd($dir_array);
        return '<hr>遍历目录下所有文件及文件夹';
    }

    /**
     * 环境检测
     */
    public function env()
    {
        checkEnv();
        return;
    }

    /**
     * 排序及常见算法
     */
    public function sort()
    {
        $arr = range(0, 30);
        //shuffle($arr);

        $key = sequence_sort($arr, 15);
        echo '查找到键为：' . $key . '值为:' . $arr[$key];
        dd($arr);
        return '<hr>加载自定义类';
    }

    /**
     *找到最后的猴子的编号
     */
    public function getLastMonkey(Request $request, $n, $m)
    {
        return '最后的猴子编号是：' . monkey($n, $m);
    }

    /**
     * 二维数组排序
     * @return string
     */
    public function sortMutiArray()
    {
        $arr2 = [
            ['name' => '张三', 'age' => '15'],
            ['name' => '李四', 'age' => '25'],
            ['name' => '猴七', 'age' => '63'],
            ['name' => '马九', 'age' => '28'],
            ['name' => '王六', 'age' => '5'],
            ['name' => '赵四', 'age' => '60'],
        ];
        $sort_ok = arr2_sort($arr2, 'age');
        dd($sort_ok);
        return '对二维数组排序的自定义函数';
    }

    public function getOrderdArray()
    {
        $array = [
            ['id' => 1,
                'pid' => 0,
                'name' => '水果'
            ],
            ['id' => 2,
                'pid' => 0,
                'name' => '蔬菜'
            ],
            ['id' => 3,
                'pid' => 1,
                'name' => '香蕉'
            ],
            ['id' => 4,
                'pid' => 2,
                'name' => '黄瓜'
            ],
            ['id' => 5,
                'pid' => 1,
                'name' => '苹果'
            ],
            ['id' => 6,
                'pid' => 2,
                'name' => '茄子'
            ],
            ['id' => 7,
                'pid' => 3,
                'name' => '小香蕉'
            ],
            ['id' => 8,
                'pid' => 6,
                'name' => '圆茄子'
            ],
            ['id' => 9,
                'pid' => 6,
                'name' => '长茄子'
            ],

        ];

        $ret = iterate($array);

        dd($ret);
        return '按分类排序数组';
    }

}
