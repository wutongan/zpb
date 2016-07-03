<?php
namespace App\Http\Controllers;

use Validator,DB,Redirect;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;
use Input;
use App\Http\Models\Role_type;

class ArticleController extends Controller
{
	/**
	 * 文章列表
	 * @return [type] [description]
	 */
	public function article()
	{
		$users = DB::table('zpb_article')->paginate(5);
		return view('article.article', ['users' => $users]);

	}
	/**
	 * 文章删除
	 */
	public function delt()
	{
		$id=$_GET['art_id'];
		$str = DB::delete("delete from zpb_article where art_id = '$id'");
		return Redirect('Article/article');
	}
	/**
	 * 文章添加
	 */
	public function add()
	{
		return view('article.add_list');
	}

	public function add_list(Request $request)
	{
		$art_title=$request->input('art_title'); 
		$art_desc=$request->input('art_desc'); 
		$art_author=$request->input('art_author');
		$time=date('Y-m-d H:i:s',time());
		$str=DB::table('zpb_article')->insert([
			'art_title' => $art_title,
			'art_desc' => $art_desc,
			'art_author' => $art_author,
			'art_add_time' => $time,
		]);
		return redirect('Article/article');
	}
}