<?php 

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use DB;
class LoginController extends Controller
{
	public function login()
	{
		$error = Input::get('error');
		$user = Input::get('user');
		return view('login',['error'=>$error,'user'=>$user]);
	}
	//新浪登录 回调地址
	public function login_sina()
	{
		session_start();
		$code = $_GET['code'];
		$url = "https://api.weibo.com/oauth2/access_token";
		$data = "client_id=481872047&client_secret=c3f49093781f11a9cc19c0424b022bd4&grant_type=authorization_code&code=$code&redirect_uri=http://www.itkaikai.cn/callback";
		$token = $this->posts($url,$data);
		$token = json_decode($token,true);
		if(isset($token['error']) && isset($token['error_code']))
		{
			echo '错误,跳回登录页面';die;
		}
		$userMess = file_get_contents("https://api.weibo.com/2/users/show.json?access_token=".$token['access_token'].'&uid='.$token['uid']);
		//入库
		$userMess = json_decode($userMess,true);
		//查询新浪唯一标识 ( regist_method = 1 )是否存在用户表中
		$auth_id = $userMess['idstr'];
		$isExit = DB::table('user')->select(['user_id','nickname','img'])->where(['regist_method'=>1,'auth_id'=>$auth_id])->first();
		if($isExit)
		{
			//直接登录
			$isExit = json_decode(json_encode($isExit),true);
			$_SESSION['userInfo'] = $isExit;
			return redirect('index');
		}else{
			//入库
			$userInfo = array();
			$userInfo['auth_id']         = $userMess['idstr'];
			$userInfo['nickname']        = $userMess['screen_name'];
			$userInfo['regist_method']  = 1;
			$userInfo['img']  = $userMess['profile_image_url'];
			$re = DB::table('user')->insert($userInfo);
			if($re)
			{
				$userData = DB::table('user')->select(['user_id','nickname','img'])->where("auth_id",'=',$userInfo['auth_id'])->first();
				$userData = json_decode(json_encode($userData),true);
				$_SESSION['userInfo'] = $userData;
				return redirect('index');
			}else{
				echo '入库失败';
				die();
			}
		}

	}

	//Q登录 回调地址
	public function login_qq()
	{
		session_start();
		$code = $_GET['code'];
		$url = "https://graph.qq.com/oauth2.0/token?grant_type=authorization_code&client_id=101384456&client_secret=6e5d00b0d0775c56f9d8d7f577547f0c&code=$code&redirect_uri=http://www.itkaikai.cn";
		//通过code获取token
		$data = file_get_contents($url);
	    $data = explode('&',$data);
		if(count($data) < 3 )
		{
			echo '错误,跳回登录页面';die;
		}
		foreach ($data as $k=>$v)
		{
			$data[$k] = substr($v,strrpos($v,'=')+1);
		}
		$token = $data[0];
		//通过token获取 openid
		$opnUrl = "https://graph.qq.com/oauth2.0/me?access_token=".$token;
		$openMess = file_get_contents($opnUrl);
		$preg = '#.*\((.*)\)#isU';
		preg_match($preg,$openMess,$b);
		$openMess = json_decode($b['1'],true);
		$openid = $openMess['openid'];
		// 以open查询数据库是否存在该用户
		$isExit = DB::table('user')->select(['user_id','nickname','img'])->where(['regist_method'=>2,'auth_id'=>$openid])->first();
		if($isExit)
		{
			//直接登录
			$isExit = json_decode(json_encode($isExit),true);
			$_SESSION['userInfo'] = $isExit;
			return redirect('index');
		}else{
			//通过token 和 openid 和 APPid 获取用户信息
			$userUrl  = "https://graph.qq.com/user/get_user_info?access_token=$token&oauth_consumer_key=101384456&openid=$openid";
			$userMess = file_get_contents($userUrl);
			$userMess = json_decode($userMess,true);
			// 入库
			$userInfo = array();
			$userInfo['auth_id']         = $openid;
			$userInfo['nickname']        = $userMess['nickname'];
			$userInfo['regist_method']  = 2;
			$userInfo['img']  = $userMess['figureurl_1'];
			//print_r($userInfo);die;
			$re = DB::table('user')->insert($userInfo);
			if($re)
			{
				$userData = DB::table('user')->select(['user_id','nickname','img'])->where("auth_id",'=',$userInfo['auth_id'])->first();
				$userData = json_decode(json_encode($userData),true);
				$_SESSION['userInfo'] = $userData;
				return redirect('index');
			}else{
				echo '错误入库';
			}
		}
	}
	
	public function posts( $url, $post_data ){

		$obj = curl_init();
		curl_setopt( $obj, CURLOPT_URL, $url);
		curl_setopt( $obj, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt( $obj, CURLOPT_HEADER, 0 );
		curl_setopt( $obj , CURLOPT_POST, 1);
		curl_setopt( $obj, CURLOPT_POSTFIELDS, $post_data);
		$output = curl_exec( $obj );
		return $output;
	}
	public function login_pro()
	{
		session_start();
		$data = Input::get();
		//表单验证
		if(empty($data['username']))
		{
			return redirect('login?error=账号不能为空');
		}
		if(empty($data['password']))
		{
			return redirect('login?error=密码不能为空');
		}
		$res = DB::table('user')->select(['user_id','nickname','img','password'])->where('username',$data['username'])->first();
		if($res)
		{
			$pwd = md5($data['password'].'aishang');
			if($pwd != $res->password)
			{
				return redirect('login?error=密码不正确&user='.$data['username']);
			}else
			{
				$userData = json_decode(json_encode($res),true);
				//删除密码
				unset($userData['password']);
				$_SESSION['userInfo'] = $userData;
				return redirect('index');
			}
		}else{
			return redirect('login?error=账号不正确&user='.$data['username']);
		}
	}
	public function loginout()
    {
        session_start();
        session_destroy();
        return redirect('index');
    }
}
?>
