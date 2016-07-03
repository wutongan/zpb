<?php
namespace App\Http\Controllers;

use Validator,DB,Redirect;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;
use Input;
use App\Http\Models\Role_type;

header("content-type:text/html;charset=utf-8");

class LoginController extends Controller
{
	/**
	 * 登录页面
	 * @return [type] [description]
	 */
	public function index(Request $request)
	{
		if(empty($request->input()))
		{
			return view('login.login');
		}
		else
		{
			$adm_user=$request->input('user');
			$adm_pwd=$request->input('pwd');
			$re = DB::table('zpb_admin')->where(['adm_user'=>$adm_user])->first();
			if($re)
			{
				if($re->adm_pwd == $adm_pwd)
				{
					// 登录成功
					session_start(); 
					$_SESSION['adm_user']=$adm_user;
					$_SESSION['adm_id'] = $re->adm_id;
					$_COOKIE['adm_user'] = $adm_user;
					$_COOKIE['adm_id'] = $re->adm_id;
					$ip = '192.168.1.1';
					$res = DB::table('zpb_admin')->where(['adm_id'=>$re->adm_id])->update(['adm_last_time'=>$re->adm_now_time,'adm_now_time'=>time(),'adm_last_ip'=>$re->adm_now_ip,'adm_now_ip'=>$ip]);
					if($res)
					{
						$json['status'] = 1;
					}
				}
				else
				{
					$json['status'] = 0;
					$json['msg'] = '密码错误';
				}
			}
			else
			{
				$json['status'] = 0;
				$json['msg'] = '账号不存在';
			}
			echo json_encode($json);
		}
	}
}
