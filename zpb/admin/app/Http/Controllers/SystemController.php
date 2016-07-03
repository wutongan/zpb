<?php
namespace App\Http\Controllers;

use Validator,DB,Redirect;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;
use Input;
use Illuminate\Http\RedirectResponse;

class SystemController extends Controller
{
	/**
	 * 修改密码页面
	 * @return [type] [description]
	 */
	public function changepwd()
	{
		session_start();
		$id = $_SESSION['adm_id'];
		$arr = DB::table('zpb_admin')->where('adm_id',$id)->first();
		return view('system.changepwd',['arr'=>$arr]);
	}
	
	/**
	 * 获取原密码
	 * @return [type] [description]
	 */
	public function getpwd(Request $request)
	{
		$id = $request->input('id');
		$pwd = $request->input('pwd');
		$arr = DB::table('zpb_admin')->where('adm_id',$id)->value('adm_pwd');
		if($pwd == $arr)
		{
			echo 1;
		}
		else
		{
			echo 0;
		}
	}
	
	/**
	 * 修改密码
	 * @return [type] [description]
	 */
	public function pwd(Request $request)
	{
		$id = $request->input('id');
		$pwd = $request->input('pwd');
		$res = DB::table('zpb_admin')->where(['adm_id'=>$id])->update(['adm_pwd'=>$pwd]);
		if($res)
		{
			echo 1;
		}
		else
		{
			echo 0;
		}
	}
}