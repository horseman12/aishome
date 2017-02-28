<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use DB;
use Illuminate\Support\Facades\Input;
use App\Models\Ais_carousel;
class IndexController extends Controller
{
    public function index()
    {
        session_start();

//找出6首下载最多歌曲作为为你推荐
        $topList = DB::table('music')->select(['music_id','music_img','music_name'])->orderBy(\DB::raw('RAND()'))->limit(6)->get();
        //找出6首最新的歌曲
        $hotList = DB::table('music')->select(['music_id','music_img','music_name'])->orderBy('lssue_time','desc')->limit(6)->get();
        //查询轮播图
        //实例化轮播图的M
        $carModel = new Ais_carousel();
        $car_data = $carModel::orderBy('car_id','desc')->limit(4)->get()->toArray();
//        print_r($car_data);die;
        //查看是否登录
        $userInfo = isset($_SESSION['userInfo']) ? $_SESSION['userInfo'] : '';
        $data = [
            'topList' => $topList,
            'hotList' => $hotList,
            'userInfo' => $userInfo,
            'car_data'=>$car_data,
        ];
        return view('index',$data);
    }
    //播放器
    public function listen()
    {
        //查看列表
        session_start();
        //查看是否是会员
        $user_id = isset($_SESSION['userInfo']['user_id']) ? $_SESSION['userInfo']['user_id'] : 0;

        $userInfo = DB::table('user')->where("user_id",'=',$user_id)->first();
        if(!isset($userInfo) || $userInfo->is_vip == 0)
        {
            //不是会员
            $is_vip = 0;
        }else
        {
            $is_vip = 1;
        }
        $musicList = $_SESSION['musicList'];
        $musicArr = [];
        foreach ($musicList as $key => $value) {
            $musicArr[$key] = DB::table('music')->where('music_id','=',$value)->join('actor', 'music.actor_id', '=', 'actor.actor_id')->first();
        }
        foreach ($musicArr as $key => $value) {
            $musicArr[$key]->music_path = trim($value->music_path,'.');
            $musicArr[$key]->tall_music_path = trim($value->tall_music_path,'.');
        }
        return view('listen',['musicList'=>$musicArr,'is_vip'=>$is_vip]);
    }
    //加入播放器
    public function joinlisten()
    {
        session_start();
        $music_id = Input::get('music_id');
        if(!$music_id)
        {
            echo 'NO';die();
        }
        //将音乐id存入播放列表 如果有返回错误
        $musicList = isset($_SESSION['musicList']) ? $_SESSION['musicList'] : [] ;
        $result = ['status'=>0,'msg'=>''];
        if(in_array($music_id, $musicList))
        {
            //如果存在 找到该id置顶
            foreach ($musicList as $key => $value) {
                if($value == $music_id)
                {
                    unset($musicList[$key]);
                }
            }
            array_unshift($musicList,$music_id);
            $_SESSION['musicList'] = $musicList;
        }else
        {
            array_unshift($musicList,$music_id);
            $_SESSION['musicList'] = $musicList;
        }
        $result['status'] = 1;
        $result['msg'] = '添加歌曲到列表成功!';
        echo json_encode($result);die;
    }
	//最新文章专辑的详情页
    public function new_article()
    {
        $data=DB::select("select * from ais_article ORDER BY art_starttime desc limit 1");
        return view('wenzhang',['data'=>$data]);
    }
}
?>
