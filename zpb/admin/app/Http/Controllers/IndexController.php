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

class IndexController extends Controller
{
	/**
	 * 首页显示
	 * @return [type] [description]
	 */
	public function index()
	{
		return view('admin.index');
	}

	/**
	 * 头部
	 * @return [type] [description]
	 */
	public function head()
	{
		return view('admin.head');
	}

	/**
	 * 左边
	 * @return [type] [description]
	 */
	public function left()
	{
		return view('admin.left');
	}

	/**
	 * 右边
	 * @return [type] [description]
	 */
	public function right()
	{
		return view('admin.right');
	}

	/**
	 * 退出页面
	 */
	public function loginout()
	{
		session_start();
		unset($_SESSION['adm_user']);
		return Redirect::to('Login/index');
	}
}