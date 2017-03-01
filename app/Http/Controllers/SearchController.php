<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use DB;
use Illuminate\Support\Facades\Input;
use App\Models\Ais_carousel;

/**
 * Class SearchController
 * @package App\Http\Controllers
 * @foo 搜索功能
 * @author hhj <1137727711@163.com>
 * @date 2017-03-01
 */
class SearchController extends Controller{

    /**
     * 搜索页面
     */
    public function index(){

        //热门歌曲
        $hot_songs = DB::table('music')
            ->join('actor', 'actor.actor_id', '=', 'music.actor_id')
            ->limit(12)
            ->orderBy('play','desc')
            ->get();

        //热门分类
        $hot_type = DB::table('type')
            ->limit(8)
            ->where('parent_id','!=','0')
            ->where('is_hot','=','1')
            ->get();
//        print_r($hot_type);die;
        
        $search = $this->search_complete(); //联想搜索内容
        
        return view('search/search',[
            'hot_songs'=>$hot_songs,
            'hot_type'=>$hot_type,
            'search'=>$search
        ]);
    }

    /**
     * 联想搜索内容
     */
    private function search_complete(){

        $actor = DB::table('actor')
            ->select('actor_name')
            ->get();    //全部歌手名
        $music = DB::table('music')
            ->select('music_name')
            ->get();    //全部歌曲名

        $actor = json_decode( json_encode($actor),true );
        $music = json_decode( json_encode($music),true );   //转为数组
        
        $str = "";
        foreach($actor as $v){
            $str .= '"'.$v['actor_name'].'",';
        }
        foreach($music as $v){
            $str .= '"'.$v['music_name'].'",';
        }   //转为所需格式

        return $str;
    }
    
    /**
     * 进行搜索
     */
    public function search(){
        $keyword = Input::get('keyword');

        //查歌手表
        $actor = DB::table('actor')
            ->select('actor_name','actor_id')
            ->where('actor_name','like',"%$keyword%")
            ->limit(3)
            ->get();

        //查歌曲表
        $music = DB::table('music')
            ->join('actor', 'actor.actor_id', '=', 'music.actor_id')
            ->select('music_name','music_id','actor_name')
            ->where('music_name','like',"%$keyword%")
            ->orWhere('actor_name','like',"%$keyword%")
            ->limit(10)
            ->get();

        $msg['actor'] = $actor;
        $msg['music'] = $music;

        die( json_encode($msg) );
    }

}
