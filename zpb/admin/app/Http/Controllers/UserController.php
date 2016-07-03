<?php
namespace App\Http\Controllers;

use Validator,DB,Redirect;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;
use Input;
use App\Http\Models\Role_type;

class UserController extends Controller
{
	/**
	 * 管理员列表
	 * @return [type] [description]
	 */
	public function user()
	{
		$arr = DB::table('zpb_admin')->paginate(5);
		return view('user.user',['arr'=>$arr]);
	}
}