<?php 

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use DB;
use Illuminate\Support\Facades\Input;
class RegistController extends Controller
{
	public function regist()
	{
		$tel = Input::get('tel');
		$error = Input::get('error');

		$data = ['tel'=>$tel,'error'=>$error];
		return view('regist',$data);
	}
	public function regist_pro()
	{
		session_start();
		$telphone = Input::get('telphone');
		$error = Input::get('error');
		if($error)
		{
			return view('regist_pro',['error'=>$error]);
		}
		if($telphone == '')
		{
			return redirect('regist?tel='.$telphone.'&error=手机号码不能为空');
		}
		if(!preg_match("/^1[34578]{1}\d{9}$/",$telphone)){
			return redirect('regist?tel='.$telphone.'&error=手机号有误');
		}
		//判断是否存在该手机号
		$info = DB::table('user')->where('username','=',$telphone)->get();
		if($info)
		{
			//如果存在返回错误信息
			return redirect('regist?tel='.$telphone.'&error=用户名已存在');
		}else{
			//是否发送验证码频繁
			if(isset($_SESSION['registMess']['tel']))
			{
				$time = time();
				//如果session存在该手机并且当前时间和存放时间小于1分钟 那么算恶意操作
				if($_SESSION['registMess']['tel'] == $telphone &&  $time - $_SESSION['registMess']['time'] < 180)
				{
					return redirect('regist?tel='.$telphone.'&error=验证码发送频繁');
				}
			}
			//如果可以注册发送短信
			$capth = rand(1111,9999);
			$nowapi_parm['app']='sms.send';
			$nowapi_parm['tempid']='50896';
			$nowapi_parm['param']='code='.$capth;
			$nowapi_parm['phone']=$telphone;
			$nowapi_parm['appkey']='21282';
			$nowapi_parm['sign']='b876b3dfe9ad8efa59cdbe84ecf59a28';
			$nowapi_parm['format']='json';
			$result= $this->nowapi_call($nowapi_parm);
			//将验证码和手机存入session
			$_SESSION['registMess'] = ['tel'=>$telphone,'capth'=>$capth,'time'=>time()];
			return view('regist_pro');
		}
	}

	public function regist_suc()
	{
		session_start();
		$data = Input::get();
		$capth = $_SESSION['registMess']['capth'];
		if(empty($data['capth']))
		{
			return redirect('regist_pro?error=验证码不能为空');
		}
		if(empty($data['password']))
		{
			return redirect('regist_pro?error=密码不能为空');
		}
		if(empty($data['nickname']))
		{
			return redirect('regist_pro?error=昵称不能为空');
		}
		if(strlen($data['password']) < 6 || strlen($data['password']) > 12)
		{
			return redirect('regist_pro?error=密码必须在6-12位');
		}
		if($data['capth'] == $capth)
		{
			$save = [];
			$save['username'] = $_SESSION['registMess']['tel'];
			$save['password'] = md5($data['password'].'aishang');
			$save['nickname'] = $data['nickname'];
			$re = DB::table('user')->insertGetId($save);
			if($re)
			{
				//注册成功销毁session
				unset($_SESSION['registMess']);
				//存session 跳登录页面
				$userData = DB::table('user')->select(['user_id','nickname','img'])->where("user_id",'=',$re)->first();
				$userData = json_decode(json_encode($userData),true);
				$_SESSION['userInfo'] = $userData;
				return redirect('/');
			}
		}else{
			return redirect('regist_pro?error=验证码错误');
		}
	}
	//发送短信方法
	public function nowapi_call($a_parm){
		if(!is_array($a_parm)){
			return false;
		}
		//combinations
		$a_parm['format']=empty($a_parm['format'])?'json':$a_parm['format'];
		$apiurl=empty($a_parm['apiurl'])?'http://api.k780.com:88/?':$a_parm['apiurl'].'/?';
		unset($a_parm['apiurl']);
		foreach($a_parm as $k=>$v){
			$apiurl.=$k.'='.$v.'&';
		}
		$apiurl=substr($apiurl,0,-1);
		if(!$callapi=file_get_contents($apiurl)){
			return false;
		}
		//format
		if($a_parm['format']=='base64'){
			$a_cdata=unserialize(base64_decode($callapi));
		}elseif($a_parm['format']=='json'){
			if(!$a_cdata=json_decode($callapi,true)){
				return false;
			}
		}else{
			return false;
		}
		//array
		if($a_cdata['success']!='1'){
			echo $a_cdata['msgid'].' '.$a_cdata['msg'];
			return false;
		}
		return $a_cdata['result'];
	}
}
?>
