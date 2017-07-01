<?php
/**
 * Author: zhangkaifei
 * CreateTime: 18:50
 */
namespace App\Http\Traint;

trait CommonTraint
{
    /**
     * 打印输出调试信息
     * params $var array object
     */
    public function p($var)
    {
        dump($var);
    }
}