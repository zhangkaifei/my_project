<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Model\Mongodb;
use App\Http\Model\Users;

class MongodbController extends Controller
{
    //
    public function index()
    {
        $mongodb = new Mongodb();
        $doc = $mongodb->table('articles');

        dd($doc->paginate(2));

        return '查看article文档中的全部内容';
    }
    public function insertPosts()
    {
        $mg = new Mongodb();
        $doc = $mg->switchDb('blog','comments');
        $ins_data = [
            'post_id' => '333666',
            'comment_content'=>'这条新闻确实够二儿的',
            'comment_time'   => time()
        ];
        $ins_id= $doc->insertOne($ins_data)->getInsertedId();
        return $ins_id ? '评论发表成功，插入评论的ID：'.$ins_id : '评论失败';
    }

    public function insertArticle()
    {
        $db = new Mongodb();
        $doc = $db->table('articles');
        $ins_data = [
            'title' => '罗湖致力打造医养融合示范区',
            'content' => '昨天上午，市区卫计部门在罗湖老年医院召开“第三届全国敬老文明号授牌仪式暨深圳市医养结合工作罗湖座谈会”。市卫计委家庭处处长叶江霞、罗湖区卫计局副局长刘岭、罗湖医院集团院长孙喜琢等围绕医养融合主题分别发言。',
            'author' =>'张洁',
            'create_time'=>time()
        ];
        $ins_status = $doc->insert($ins_data);
        return $ins_status ? '插入文章成功' : '写入失败';
    }

    public function insertUser()
    {
        $db = new Mongodb();
        $doc = $db->table('users');
        $ins_data =[
            'name' => '邓九',
            'age'  => '29',
            'card' => '15026952166021616',
            'gender'=> '女',
            'phone'=> '13462235968',
            'country' => '中国',
            'isMarried' => '0'
        ];
        $mongo_id = $doc->insertGetId($ins_data);
        return $mongo_id ? '插入用户信息成功，用户id:'.$mongo_id : '添加用户信息失败';
    }

}
