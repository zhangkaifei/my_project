<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GitController extends Controller
{
    //

    public function checkConflict()
    {
        echo '在主分支下修改git文件';
        return '测试文件冲突是怎么产生的';
    }
}
