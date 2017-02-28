<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
class CommentController extends Controller
{
    public function index(Request $request)
    {
        //判断用户是否
        session_start();
        if(isset($_SESSION['userInfo']) && !empty($_SESSION['userInfo']))
        {
            $user_id = $_SESSION['userInfo']['user_id'];
            //接值
            $music_id = $request->input('music_id');
            $music = DB::table('music')->where('music_id','=',$music_id)->select('music_name')->first();
            return view('comment',['user_id'=>$user_id,'music_id'=>$music_id,'music'=>$music]);
        }
        else
        {
            return redirect('login');
        }

    }
    //评论入库
    public function comment(Request $request)
    {
        //接值
        $comment = $request->input('comment');
        $user_id = $request->input('user_id');
        $music_id = $request->input('music_id');
        //时间
        $time = time();
        //入库
        $result=DB::table('comment')->insert(['comm_content'=>$comment,'user_id'=>$user_id,'comm_time'=>$time,'music_id'=>$music_id]);
        if($result)
        {
            echo 1;
        }
        else
        {
            echo 0;
        }
    }
    //回复页面
    public function reply($id)
    {
        $music_id = substr($id,0,strpos($id, ','));
       $user_id = substr($id,strpos($id, ',')+1);
        //查询音乐名称
        $music = DB::table('music')->where('music_id','=',$music_id)->select('music_name')->first();
        //查询用户名称
        $user = DB::table('user')->where('user_id','=',$user_id)->select('username','user_id')->first();
        //查询该音乐下的所有评论
        $comment = DB::table('comment')->where('music_id','=',$music_id)->get();
        //查询回复人信息
        $reply = DB::table('reply')->where(['music_id'=>$music_id,'user_id'=>$user_id])->get();

        return view('reply',['music'=>$music,'comment'=>$comment,'user'=>$user,'reply'=>$reply]);
    }

}