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
use Symfony\Component\HttpFoundation\Session\Session;
use App\Models\Ais_music;
class JxController extends Controller
{
	public function index()
	{
		header("content-type:text/html;charset=utf-8");
		$id=$_GET['id'];
        $one=DB::select("select * from ais_special where spe_id='$id' ");
       $data =DB::select("SELECT * from `ais_music` INNER JOIN `ais_special` on ais_music.spe_id = ais_special.spe_id inner join ais_actor on ais_actor.actor_id=ais_music.actor_id where ais_special.spe_id = $id" );
//print_r($data);die;
        $data = json_decode(json_encode($data),true);
	 $count=DB::select("select count(*) as con from ais_music;");
        $data = json_decode(json_encode($data),true);
        return view('jx',['data'=>$data,'one'=>$one,'count'=>$count,'spe_id'=>$id]);
	}

    //修改paly字段
    public function play(Request $request)
    {
        $music_id = $request::get('music_id');
        $music_play = DB::select("UPDATE `ais_music` set play=play+1 where music_id = 1");
        if($music_play)
        {
            echo 1;
        }
        else
        {
            echo 0;
        }
    }

	public function chajian(Request $request)
	{
		//接值
		$spe_id = $request::get('spe_id');
		$ifid = $request::get('ifid');
        $musicModel = new Ais_music();//歌曲表

        if(isset($spe_id) && !empty($spe_id)){
            //查询
            $music = DB::table('special')
                ->join('music','special.spe_id','=','music.spe_id')
                ->join('actor','music.actor_id','=','actor.actor_id')
                ->where('special.spe_id',$spe_id)->get();
            $data = json_decode(json_encode($music),true);
        }
        if($ifid=="1"){
            //查询新歌榜
            $data = $musicModel::join('actor', 'music.actor_id', '=', 'actor.actor_id')
                ->orderBy('lssue_time','desc')
                ->limit(100)
                ->get()
                ->toArray();
//            print_r($data);die;
            $dta["ran_img"]="新歌榜";
            $dta["ran_id"]="1";
        }else if($ifid=="2"){
            //查询热歌榜
            $data = $musicModel::join('actor', 'music.actor_id', '=', 'actor.actor_id')
                ->orderBy('play','desc')
                ->limit(100)
                ->get()
                ->toArray();
            $dta["ran_img"]="热歌榜";
            $dta["ran_id"]="2";
        }else if($ifid=="3"){
            //查询原创榜
            $data = $musicModel::join('actor', 'music.actor_id', '=', 'actor.actor_id')
                ->limit(100)
                ->get()
                ->toArray();
            $dta["ran_img"]="原创榜";
            $dta["ran_id"]="3";
        }else if($ifid=="4"){
            //欧美单曲榜
            $data = $musicModel::join('actor', 'music.actor_id', '=', 'actor.actor_id')
                ->join('languages', 'music.language', '=', 'languages.id')
                ->where(['language'=>"4"])
                ->orderBy('play','desc')
                ->limit(100)
                ->get()
                ->toArray();
            $dta["ran_img"]="欧美单曲榜";
            $dta["ran_id"]="4";
        }else if($ifid=="5"){
            //日语激情榜
            $data = $musicModel::join('actor', 'music.actor_id', '=', 'actor.actor_id')
                ->join('languages', 'music.language', '=', 'languages.id')
                ->where(['language'=>"2"])
                ->orderBy('play','desc')
                ->limit(100)
                ->get()
                ->toArray();
            $dta["ran_img"]="日语激情榜";
            $dta["ran_id"]="5";
        }else if($ifid=="6"){
            //韩国MNET音乐排行榜
            $data = $musicModel::join('actor', 'music.actor_id', '=', 'actor.actor_id')
                ->join('languages', 'music.language', '=', 'languages.id')
                ->where(['language'=>"1"])
                ->orderBy('play','desc')
                ->limit(100)
                ->get()
                ->toArray();
            $dta["ran_img"]="韩国MNET音乐排行榜";
            $dta["ran_id"]="6";
        }else if($ifid=="7"){
            //Hito 中文排行榜
            $data = $musicModel::join('actor', 'music.actor_id', '=', 'actor.actor_id')
                ->join('languages', 'music.language', '=', 'languages.id')
                ->where(['language'=>"3"])
                ->orderBy('play','desc')
                ->limit(100)
                ->get()
                ->toArray();
            $dta["ran_img"]="Hito 中文排行榜";
            $dta["ran_id"]="7";
        }


		return view('chajian',['music'=>$data,'ran_id'=>$dta]);
	}





    //收藏
    public function shoucang()
    {
        //接值
        $music_id = $_POST['music_id'];
        //判断用户是否
        session_start();

//        print_r($session_info);die;
        if(isset($_SESSION['userInfo']) && !empty($_SESSION['userInfo']))
        {
//            print_r($_SESSION['userInfo']);die;
            $user_id = $_SESSION['userInfo']['user_id'];
            //查询
            $sel_result = DB::table('collect')->where(['user_id'=>$user_id,'music_id'=>$music_id])->first();
            if($sel_result)
            {
                echo 2;
            }
            else
            {
                $shou_result=DB::table('collect')->insert(['user_id'=>$user_id,'music_id'=>$music_id]);
                if($shou_result)
                {
                    echo 0;
                }
                else
                {
                    echo 1;
                }

            }
        }
        else
        {
            echo 3;
        }


    }
    //下载
    public function songload()
    {
        //接值
        $music_id = $_POST['music_id'];
        //判断用户是否
        $session = new Session;
        $session_info = $session->get('session_key');
        if($session_info)
        {
            $user_id = $session_info->user_id;
            //查询
            $music_show = DB::table('music')->where('music_id',$music_id)->first();
            $music_path = $music_show->lyric_path;
            $music_name = $music_show->music_name.'.mp3';
//            print_r($music_name);die;
            //$file_dir = $_SERVER['SERVER_NAME'].'/aishang/ais_image/';
            //检查文件
            if(!file_exists($music_path))
            {
                echo '文件找不到';
                exit;
            }
            else
            {
                //打开文件
                $file = fopen($music_path,"r");
                //输入文件标签
                Header( "Content-type:  application/octet-stream ");
                Header( "Accept-Ranges:  bytes ");
                Header( "Accept-Length: " .filesize($music_path));
                header( "Content-Disposition:  attachment;  filename= $music_name");
                echo fread($file,$music_path);
                fclose($file);
                exit;
            }
        }
        else
        {
            echo 3;
        }
    }
}
 ?>
