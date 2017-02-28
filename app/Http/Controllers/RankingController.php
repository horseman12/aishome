<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Cookie;
use DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;
use Illuminate\Pagination;
use App\Models\Ais_music;
use App\Models\Ais_actor;
use Session,Redirect;
use Cache;
class RankingController extends Controller
{
	/**
	 * 排行榜
	 */
	public function  rank_index(){
		//查询新歌榜
		$musicModel = new Ais_music();//歌曲表
		$data1 = $musicModel::join('actor', 'music.actor_id', '=', 'actor.actor_id')
		->orderBy('lssue_time','desc')
		->limit(3)
		->get()
		->toArray();

		//查询热歌榜
		$data2 = $musicModel::join('actor', 'music.actor_id', '=', 'actor.actor_id')
		->orderBy('play','desc')
		->limit(3)
		->get()
		->toArray();

       	//查询原创榜
       	$data3 = $musicModel::join('actor', 'music.actor_id', '=', 'actor.actor_id')
       	->limit(3)
       	->get()
       	->toArray();
       

       	//欧美单曲榜
		$data4 = $musicModel::join('actor', 'music.actor_id', '=', 'actor.actor_id')
		->join('languages', 'music.language', '=', 'languages.id')
		->where(['language'=>"4"])
		->orderBy('play','desc')
		->limit(3)
		->get()
		->toArray();

		//日语激情榜
		$data5 = $musicModel::join('actor', 'music.actor_id', '=', 'actor.actor_id')
		->join('languages', 'music.language', '=', 'languages.id')
		->where(['language'=>"2"])
		->orderBy('play','desc')
		->limit(3)
		->get()
		->toArray();

		//韩国MNET音乐排行榜
		$data6 = $musicModel::join('actor', 'music.actor_id', '=', 'actor.actor_id')
		->join('languages', 'music.language', '=', 'languages.id')
		->where(['language'=>"1"])
		->orderBy('play','desc')
		->limit(3)
		->get()
		->toArray();

		//Hito 中文排行榜
		$data7 = $musicModel::join('actor', 'music.actor_id', '=', 'actor.actor_id')
		->join('languages', 'music.language', '=', 'languages.id')
		->where(['language'=>"3"])
		->orderBy('play','desc')
		->limit(3)
		->get()
		->toArray();
		/*
		*风格
		 */
		//流行 Pop
		$data8 = $musicModel::join('actor', 'music.actor_id', '=', 'actor.actor_id')
		->join('style', 'music.style_id', '=', 'style.style_id')
		->where(['music.style_id'=>"1"])
		->orderBy('play','desc')
		->limit(3)
		->get()
		->toArray();

		//摇滚 Rock
		$data9 = $musicModel::join('actor', 'music.actor_id', '=', 'actor.actor_id')
		->join('style', 'music.style_id', '=', 'style.style_id')
		->where(['music.style_id'=>"2"])
		->orderBy('play','desc')
		->limit(3)
		->get()
		->toArray();

		//民谣 Folk
		$data10 = $musicModel::join('actor', 'music.actor_id', '=', 'actor.actor_id')
		->join('style', 'music.style_id', '=', 'style.style_id')
		->where(['music.style_id'=>"3"])
		->orderBy('play','desc')
		->limit(3)
		->get()
		->toArray();

		//电子 Electronic
		$data11 = $musicModel::join('actor', 'music.actor_id', '=', 'actor.actor_id')
		->join('style', 'music.style_id', '=', 'style.style_id')
		->where(['music.style_id'=>"4"])
		->orderBy('play','desc')
		->limit(3)
		->get()
		->toArray();

		//节奏布鲁斯 R&b
		$data12 = $musicModel::join('actor', 'music.actor_id', '=', 'actor.actor_id')
		->join('style', 'music.style_id', '=', 'style.style_id')
		->where(['music.style_id'=>"5"])
		->orderBy('play','desc')
		->limit(3)
		->get()
		->toArray();

		//爵士 Jazz
		$data13 = $musicModel::join('actor', 'music.actor_id', '=', 'actor.actor_id')
		->join('style', 'music.style_id', '=', 'style.style_id')
		->where(['music.style_id'=>"6"])
		->orderBy('play','desc')
		->limit(3)
		->get()
		->toArray();

		//轻音乐 Easy Listen
		$data14 = $musicModel::join('actor', 'music.actor_id', '=', 'actor.actor_id')
		->join('style', 'music.style_id', '=', 'style.style_id')
		->where(['music.style_id'=>"7"])
		->orderBy('play','desc')
		->limit(3)
		->get()
		->toArray();

		return view("ranking.rank_index",['data1'=>$data1,
											'data2'=>$data2,
											'data3'=>$data3,
											'data4'=>$data4,
											'data5'=>$data5,
											'data6'=>$data6,
											'data7'=>$data7,
											'data8'=>$data8,
											'data9'=>$data9,
											'data10'=>$data10,
											'data11'=>$data11,
											'data12'=>$data12,
											'data13'=>$data13,
											'data14'=>$data14
											]);
    }


    //排行榜详情展示
    public function rank_lisk(){
    	//接收值
    	$get = Request::all();
    	$ifid       = $get['ifid'];
    	$musicModel = new Ais_music();//歌曲表
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
    	}else if($ifid=="8"){
    			//流行 Pop
				$data = $musicModel::join('actor', 'music.actor_id', '=', 'actor.actor_id')
				->join('style', 'music.style_id', '=', 'style.style_id')
				->where(['music.style_id'=>"1"])
				->orderBy('play','desc')
				->limit(3)
				->get()
				->toArray();
				$dta["ran_img"]="流行 Pop";
            $dta["ran_id"]="8";
    	}else if($ifid=="9"){
    			//摇滚 Rock
				$data = $musicModel::join('actor', 'music.actor_id', '=', 'actor.actor_id')
				->join('style', 'music.style_id', '=', 'style.style_id')
				->where(['music.style_id'=>"2"])
				->orderBy('play','desc')
				->limit(3)
				->get()
				->toArray();
				$dta["ran_img"]="摇滚 Rock";
            $dta["ran_id"]="9";
    	}else if($ifid=="10"){
    			//民谣 Folk
				$data = $musicModel::join('actor', 'music.actor_id', '=', 'actor.actor_id')
				->join('style', 'music.style_id', '=', 'style.style_id')
				->where(['music.style_id'=>"3"])
				->orderBy('play','desc')
				->limit(3)
				->get()
				->toArray();
				$dta["ran_img"]="民谣 Folk";
            $dta["ran_id"]="10";
    	}else if($ifid=="11"){
    			//电子 Electronic
				$data = $musicModel::join('actor', 'music.actor_id', '=', 'actor.actor_id')
				->join('style', 'music.style_id', '=', 'style.style_id')
				->where(['music.style_id'=>"4"])
				->orderBy('play','desc')
				->limit(3)
				->get()
				->toArray();
				$dta["ran_img"]="电子 Electronic";
            $dta["ran_id"]="11";
    	}else if($ifid=="12"){
    			//节奏布鲁斯 R&b
    			$data = $musicModel::join('actor', 'music.actor_id', '=', 'actor.actor_id')
				->join('style', 'music.style_id', '=', 'style.style_id')
				->where(['music.style_id'=>"5"])
				->orderBy('play','desc')
				->limit(3)
				->get()
				->toArray();
				$dta["ran_img"]="节奏布鲁斯 R&b";
            $dta["ran_id"]="12";
    	}else if($ifid=="13"){
    			//爵士 Jazz
    			$data = $musicModel::join('actor', 'music.actor_id', '=', 'actor.actor_id')
				->join('style', 'music.style_id', '=', 'style.style_id')
				->where(['music.style_id'=>"6"])
				->orderBy('play','desc')
				->limit(3)
				->get()
				->toArray();
				$dta["ran_img"]="爵士 Jazz";
            $dta["ran_id"]="13";
    	}else if($ifid=="14"){
    			//轻音乐 Easy Listen
    			$data = $musicModel::join('actor', 'music.actor_id', '=', 'actor.actor_id')
				->join('style', 'music.style_id', '=', 'style.style_id')
				->where(['music.style_id'=>"7"])
				->orderBy('play','desc')
				->limit(3)
				->get()
				->toArray();
				$dta["ran_img"]="轻音乐 Easy Listen";
            $dta["ran_id"]="14";
    	}

    	$dta["musci_count"] = count($data);
    	return view("ranking.rank_list",['data'=>$data,'dta'=>$dta]);

    }


    
}
?>