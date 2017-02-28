<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Ais_carousel;
use DB;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Input;
use Symfony\Component\HttpFoundation\Session\Session;
use App\Models\Ais_actor;
use App\Models\Ais_attention;
class YirenController extends CommonController
{
    public function index(Request $request){
        $actor_id = $request::get('actor_id');
        //根据id查找演员id
        $actor = new Ais_actor();
        $data =$actor
            ->where(['actor.actor_id'=>$actor_id])
            ->first()->toArray();
        $music = $actor::join('music', 'actor.actor_id', '=', 'music.actor_id')
            ->where(['actor.actor_id'=>$actor_id])
            ->get()->toArray();
        if(isset($_SESSION['userInfo']) && !empty($_SESSION['userInfo']))
        {
            $user_id = $_SESSION['userInfo']['user_id'];
            $actor_id = $request::get('actor_id');
            $attentionModel = new Ais_attention();
            $atte = $attentionModel::where(['user_id'=>$user_id])->where(['be_atte_id'=>$actor_id])->get()->toArray();
            if(isset($atte) && !empty($atte))
            {
                $is_atte = "1";
            }
            else{
                $is_atte = 0;
            }
        }
        else
            {
                $is_atte = 0;
            }
//        print_r($data);die;
        return view('yiren',['data'=>$data,'music'=>$music,'is_atte'=>$is_atte]);
    }
    /**
     * 关注
     *
     */
    public function attention(Request $request)
    {
        if(isset($_SESSION['userInfo']) && !empty($_SESSION['userInfo']))
        {
            $user_id = $_SESSION['userInfo']['user_id'];
            $actor_id = $request::get('actor_id');
            $attentionModel = new Ais_attention();
            $atte = $attentionModel::where(['user_id'=>$user_id])->where(['be_atte_id'=>$actor_id])->get()->toArray();
            if(isset($atte) && !empty($atte))
            {
                $bool = $attentionModel::where(['user_id'=>$user_id])->where(['be_atte_id'=>$actor_id])->delete();
                if($bool){
                    echo json_encode(['code'=>1,'msgs'=>"已经取消关注！"]);
                }
               else{
                   echo json_encode(['code'=>3,'msgs'=>"操作失败！"]);
               }
            }
            else
                {
                    $bool = $attentionModel->insert(['user_id'=>$user_id,'be_atte_id'=>$actor_id]);
                    if($bool){
                        echo json_encode(['code'=>2,'msgs'=>"关注成功！"]);
                    }
                    else{
                        echo json_encode(['code'=>3,'msgs'=>"操作失败！"]);
                    }
                }
        }
        else
            {
                echo json_encode(['code'=>0,'msgs'=>"请先登录！"]);
            }
    }
}
