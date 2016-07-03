<?php
namespace App\Http\Controllers;

use Validator,DB,Redirect;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;
use Input;


class PresonController extends Controller
{
	/**
	 * 个人信息
	 * @return [type] [description]
	 */
	public function preson(Request $request)
	{
		$abc = $request->input('abc');
		if($abc=="")
		{
			$page = DB::table('zpb_members')->join('zpb_preson','zpb_members.m_id', '=', 'zpb_preson.m_id')->where(['m_type'=>'1'])->paginate(5);
		}
		else
		{
			$page = DB::table('zpb_members')->join('zpb_preson','zpb_members.m_id', '=', 'zpb_preson.m_id')->where(['m_type'=>1,'m_email'=>$abc])->orwhere(['m_type'=>1,'m_phone'=>$abc])->orwhere(['m_type'=>1,'m_user'=>$abc])->paginate(5);
		}
		$page->a = $abc;
		return view('preson.preson',['users'=>$page]);
	}
	
	/**
	 * 简历列表
	 * @return [type] [description]
	 */
	public function resume_list(Request $request)
	{
		$id = $request->input('id');
		$arr = DB::table('zpb_resume')->join('zpb_members','zpb_members.m_id', '=', 'zpb_resume.m_id')->join('zpb_preson','zpb_members.m_id', '=', 'zpb_preson.m_id')->join('zpb_study','zpb_preson.stu_id','=','zpb_study.stu_id')->join('zpb_suffer','zpb_preson.suf_id','=','zpb_suffer.suf_id')->where('zpb_resume.m_id',$id)->first();
		if($arr)
		{
			return view('preson.resume_list',['arr'=>$arr]);
		}
		else
		{
			return "<script>alert('还没有简历');location.href='preson';</script>";
			
		}
	}
	
	/**
	 * 个人信息查看
	 * @return [type] [description]
	 */
	public function see(Request $request)
	{
		$id = $request->input('id');
		$arr = DB::table('zpb_members')->join('zpb_preson','zpb_members.m_id', '=', 'zpb_preson.m_id')->join('zpb_study','zpb_preson.stu_id','=','zpb_study.stu_id')->join('zpb_suffer','zpb_preson.suf_id','=','zpb_suffer.suf_id')->where('zpb_members.m_id',$id)->first();
		return view('preson.see',['arr'=>$arr]);
	} 
}