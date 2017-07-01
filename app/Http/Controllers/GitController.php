<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GitController extends Controller
{
    //

    public function checkConflict()
    {
        echo '在test_confict分支下我又修改了这个文件';
        echo '再次在test_conflict分支下修改了这个文件';
        return '测试文件冲突是怎么产生的';
    }
}
