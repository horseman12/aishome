<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use DB;


class FaController extends Controller
{
    public function index()
    {
        $one=DB::select('select * from ais_article');
        //截取简介字段
        for($i=0;$i<count($one);$i++){
            $jianjie=$one[$i]->art_content;
            $one[$i]->jian=substr($jianjie,0,50);
        }

        return view('wen',['data'=>$one]);
    }
    public function wen()
    {
        $id = $_GET['id'];
        $data = DB::select("select * from ais_article where art_id= '$id'");
        return view('wenzhang', ['data' => $data]);
    }
}
?>