<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use DB;
use Illuminate\Support\Facades\Input;


/**
 * Class TypeController
 * @package App\Http\Controllers
 * 分类
 */
class TypeController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * shh
     * 前台分类页面
     */
    public function index()
    {
        $type= DB::table('type')
            ->select("*")
            ->get();
        $type = json_decode(json_encode($type),true);
        foreach($type as $k=>$v){
            if($v['parent_id']==0){
                $arr[$k] = $v;
                foreach($type as $kk=>$vv){
                    if($vv['parent_id']==$v['type_id']){
                        $arr[$k]['son'][]=$vv;
                    }
                }
            }
        }
        sort($arr);
        return view('class',array('type'=>$arr));
    }

    /**
     * shh
     * 查询精选集的数据，并进行展示
     */
    public function omnibus(){
        $type_id=Input::get('type_id');
        $data = DB::table('desc')
            ->select('*')
            ->where('type_id', '=', $type_id)
            ->get();
        return view('omnibus',['data'=>$data]);
    }

    /**
     * shh
     * 精选集下的音乐
     */
    public function music(){
        $music_id=Input::get("id");
        $img=Input::get('img');
        $title=Input::get('title');
        $data=explode(',',$music_id);
        for($i=0;$i<count($data);$i++){
            $music[] = DB::table('music')
                ->join('actor', 'music.actor_id', '=', 'actor.actor_id')
                ->where("music_id",'=',$data[$i])
                ->select("*")
                ->get();
        }
        return view('music_info',[
            'music'=>$music,
            'img'=>$img,
            'title'=>$title
        ]);
    }
}
?>