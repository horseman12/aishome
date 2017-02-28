<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Controllers;
use DB;
use Request,Input;
use App\Http\Requests;

use App\Http\Controllers\Cookie;
use Illuminate\Pagination;
use App\Models\Ais_special;
use App\Models\Ais_actor;
use Session,Redirect;
use Cache;





class QualityController extends Controller
{
    //推荐
    public function index()
    {
        $musicModel = new ais_special();//歌曲表
    	$data =DB::select('select * from ais_special order by spe_id desc limit 0,6 ');
        return view('quality',['data'=>$data]);
    }
    //最新
    public function xin(){

       $musicModel = new ais_special();//歌曲表
        //$data = $musicModel::join('music', 'music.spe_id', '=', 'music.spe_id')
        //->orderBy('lssue_time','desc')
        //->limit(12)
        //->get()
        //->toArray();
        //print_r($data);die;
	$data = DB::select('select * from ais_special order by issue_time desc limit 0,6');
        return view('quality',['data'=>$data]);
    }
    //最热
    public function hot(){
        $musicModel = new ais_special();//歌曲表

        $data = DB::select('select * from ais_special order by five desc limit 0,6');
        //print_r($data);die;
        return view('quality',['data'=>$data]);
    }
    //专区
    public function zhuan(){
        $musicModel = new ais_special();//歌曲表
         $data =DB::select('select * from ais_special order by spe_id desc limit 0,6 ');
        //print_r($data);die;
        return view('quality',['data'=>$data]);
    }
    //专辑详情
    public function z_xiang(){
        $id=$_GET['music_id'];
        $data=DB::table('special')->join('music','special.spe_id','=','music.spe_id')
            ->join('actor','music.actor_id','=','actor.actor_id')
            ->where('music_id','=',$id)->get();

//        print_r($data);die;
        return view('zhuanji',['data'=>$data,'spe_id'=>$id]);
    }
    //精选集页面
    public function jing()
    {
        //判断用户是否登录
        session_start();
        if(isset($_SESSION['userInfo']) && !empty($_SESSION['userInfo']))
        {
            $user_id = $_SESSION['userInfo']['user_id'];
            $id = $_POST['id'];
            $data = DB::table('music')->where('music_id', '=', $id)->get();
            if (empty($data))
            {
                echo 1;
            } else
            {
                echo 2;
            }
        }else
        {
            echo 0;
        }
    }
}
?>
