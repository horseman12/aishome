<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use DB;
//用户管理
class MemberController extends Controller
{
    //修改头像
    public function changeimg()
    {
        session_start();
        $userData = $_SESSION['userInfo'];
        $data = Input::get();
        if($data)
        {
            $content = $data['image'];
            if(strlen($content) <100)
            {
                //没有更换直接跳回
                return redirect('/memberindex');
            }
            $content = base64_decode($content);
            $file = './userImg/';
            if(!is_dir($file))
            {
                mkdir($file,0777,true);
            }
            $imagePath = $file.time().'.jpg';
            $re = file_put_contents($imagePath,$content);
            if($re)
            {
                //入库
                $re = DB::table('user')->where("user_id",'=',$userData['user_id'])->update(['img'=>$imagePath]);
                //换session
                $_SESSION['userInfo']['img'] = $imagePath;
                return redirect('/memberindex');
            }else{
                echo '修改失败';
            }
        }else{
            return view('changeimg',['userData'=>$userData]);
        }
    }
    //个人中心
    public function memberindex()
    {
        session_start();
        $userData = $_SESSION['userInfo'];
        $userInfo = DB::table('user')->where("user_id",'=',$userData['user_id'])->first();
        return view('memberindex',['userInfo'=>$userInfo]);
    }
    //签到
    public function qiandao()
    {
        session_start();
        $userId = $_SESSION['userInfo']['user_id'];
        //如果没有签过到就添加 签到过没有断就修改
        $qiandaoList = DB::table('qiandao')->where("user_id",'=',$userId)->first();
        if($qiandaoList)
        {
            $strtime = $this->strtime($qiandaoList->end_time,date('Y-m-d'));
            //当天签到
            if( $strtime == 0 )
            {
                $result['status'] = 0;
                $result['msg']    = '亲!今天已经签过到了';
                echo json_encode($result);die;
            }else if($strtime > 1 )
            {
                //一天之后签到  //删除以前签到 重新添加
                $re = DB::table('qiandao')->where("user_id",'=',$userId)->delete();
                if($re)
                {
                    $data['user_id'] = $userId;
                    $data['end_time'] = date("Y-m-d");
                    $data['count'] = 1;
                    $res = DB::table('qiandao')->insert($data);
                    if($res)
                    {
                        $userInfo = DB::table('user')->select('score')->where("user_id",'=',$userId)->first();
                        $score = $userInfo->score + $data['count'] * 2;
                        $res = DB::table('user')->where("user_id",'=',$userId)->update(['score'=>$score]);
                        if($res)
                        {
                            $result['status'] = 0;
                            $result['msg']    = '亲!你'.$strtime.'天没有签到,重新签到!';
                            echo json_encode($result);die;
                        }
                    }
                }
            }else{
                //如果没有断
                $data['count'] = $qiandaoList->count + 1;
                $data['end_time'] = date("Y-m-d");
                $re = DB::table('qiandao')->where("user_id",'=',$userId)->update($data);
                if($re)
                {
                    $userInfo = DB::table('user')->select('score')->where("user_id",'=',$userId)->first();
                    $score = $userInfo->score + $data['count'] * 2;
                    $res = DB::table('user')->where("user_id",'=',$userId)->update(['score'=>$score]);
                    if($res)
                    {
                        $result['status'] = 1;
                        $result['msg']    = '签到成功,已经连续签到'.$data['count'] . '天!加积分'.$data['count'] * 2;
                    }else
                    {
                        $result['status'] = 0;
                        $result['msg']    = '签到失败';
                    }
                    echo json_encode($result);die;
                }
            }

        }else{
            $data['user_id'] = $userId;
            $data['end_time'] = date("Y-m-d");
            $data['count'] = 1;
            $re = DB::table('qiandao')->insert($data);
            if($re)
            {
                //如果签到成功 积分加 签到次数*2
                $userInfo = DB::table('user')->select('score')->where("user_id",'=',$userId)->first();
                $score = $userInfo->score + $data['count'] * 2;
                $res = DB::table('user')->where("user_id",'=',$userId)->update(['score'=>$score]);
                if($res)
                {
                    $result['status'] = 1;
                    $result['msg']    = '签到成功,已经连续签到'.$data['count'] . '天!加积分'.$data['count'] * 2;
                }else
                {
                    $result['status'] = 0;
                    $result['msg']    = '签到失败';
                }
                echo json_encode($result);die;
            }
        }
    }
    //计算日期差距
    public function strtime($date1,$date2)
    {
        $Date_List_a1=explode("-",$date1);
        $Date_List_a2=explode("-",$date2);
        $d1=mktime(0,0,0,$Date_List_a1[1],$Date_List_a1[2],$Date_List_a1[0]);
        $d2=mktime(0,0,0,$Date_List_a2[1],$Date_List_a2[2],$Date_List_a2[0]);
        $Days=round(($d2-$d1)/3600/24);
        return $Days;
    }
    //会员管理
    public function member()
    {
        //查询用户是否是会员 会员查询到期时期
        session_start();
        if(!isset($_SESSION['userInfo']))
        {
            echo "<script>alert('请先登录');location.href='/login'</script>";
        }
        $userId = $_SESSION['userInfo']['user_id'];
        //如果没有签过到就添加 签到过没有断就修改
        $userInfo = DB::table('user')->where("user_id",'=',$userId)->first();
        if($userInfo->is_vip == 1)
        {
            $endtime = date('Y-m-d',strtotime("{$userInfo->vip_start_time} +{$userInfo->vip_month} day"));
        }else
        {
            $endtime = '';
        }
        return view('member',['endtime'=>$endtime]);
    }
    //支付页面
    public function open_member()
    {
        session_start();
        $month = Input::get('month');
        switch ($month) {
            case '30':
                //订单号以 用户id 和 4位随机数组成
                $userData = $_SESSION['userInfo'];
                $rand = rand(1111,9999);
                $url  =  $this->order_pay($userData['user_id'].$rand,'0.01','开通一个月会员',30);
                echo "<a href=". $url ."><img src='./images/pay.jpg'/></a>";
                break;

            default:
                # code...
                break;
        }
    }
    //支付宝回调地址
    public function paycomplted()
    {
        session_start();
        $data = Input::get();
        if(isset($data['is_success']))
        {
            $userData = $_SESSION['userInfo'];
            $userInfo = DB::table('user')->where("user_id",'=',$userData['user_id'])->first();
            //如果第一个开通会员
            if($userInfo->is_vip == 0)
            {
                $update['vip_start_time'] = date('Y-m-d');
                $update['is_vip'] = 1;
                $update['vip_month'] = $data['subject'];
                $re = DB::table('user')->where("user_id",'=',$userData['user_id'])->update($update);
                if($re)
                {
                    echo "<script>alert('开通成功');location.href='/'</script>";
                }
            }else
            {
                $date = date('Y-m-d');
                //消耗了的天数
                $haodate = $this->strtime($userInfo->vip_start_time,$date);
                //剩余的天数
                $newcount = $userInfo->vip_month - $haodate;
                $update['vip_start_time'] = $date;
                //新的剩余天数 是当前开通天数加剩余天数
                $update['vip_month']      = $newcount + $data['subject'];
                $re = DB::table('user')->where("user_id",'=',$userData['user_id'])->update($update);
                if($re)
                {
                    echo "<script>alert('续费成功');location.href='/'</script>";
                }
            }
        }
        else
        {
            echo '妈了个巴子';
        }
    }
    //支付
    public function  order_pay($sn,$price,$con,$month)
    {
        $alipay_config['partner']		= '2088121321528708';
        $alipay_config['seller_email']	= 'itbing@sina.cn';
        $alipay_config['key']			= '1cvr0ix35iyy7qbkgs3gwymeiqlgromm';
        $alipay_config['sign_type']    = strtoupper('MD5');
        $alipay_config['transport']    = 'http';
        $parameter = array(
            "service" => "create_direct_pay_by_user",
            "partner" => $alipay_config['partner'],
            "seller_email" => $alipay_config['seller_email'],
            "payment_type"	=> '1', // 支付类型
            "notify_url"	=> "http://localhost/res.php",
            "return_url"	=> "http://www.aishang.com/paycomplted",
            "out_trade_no"	=> $sn,
            "subject"	=> $month,
            "app_pay"	=> "Y",
            "total_fee"	=> $price,
            "body"	=> $con,
            "_input_charset"	=> 'utf-8',
        );
        foreach ($parameter as $k => $v) {
            if (empty($v)) {
                unset($parameter[$k]);
            }
        }
        ksort($parameter);
        reset($parameter);
        $str = "";
        foreach ($parameter as $k => $v) {
            if (empty($str)) {
                $str .= $k . "=" . $v;
            } else {
                $str .= "&" . $k . "=" . $v;
            }
        }
        $parameter['sign'] = md5($str . $alipay_config['key']);	// 签名
        $parameter['sign_type'] = $alipay_config['sign_type'];
        $html = "https://mapi.alipay.com/gateway.do?".$str.'&sign='.$parameter['sign'].'&sign_type='.$parameter['sign_type'];
        return  $html;
    }
}
