<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Cookie;
use DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;
use Illuminate\Pagination;
use App\Models\Ais_actor;
use Session,Redirect;
use Cache;
class ActorController extends Controller
{
    public function ac_index()
    {
        //查询所有歌手
        $actorModel = new Ais_actor();
        $data = $actorModel::orderBy('actor_id','desc')
        ->get()
        ->toArray();
        return view('actor.ac_index',['data'=>$data]);
    }
        

}