<?php
namespace App\Http\Controllers;

use Validator,DB,Redirect;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;
use Input;
use App\Http\Models\Role_type;

header("Content-type: text/html; charset=utf-8");
class TypeController extends Controller
{
	public function lists(Request $request)
	{
		$zhi=$request->input('zhi');
		if($zhi=="")
		{
	        $user=DB::table('zpb_type')->paginate(5);
	        $user->a = $zhi;
			foreach($user as $key=>$val)
			{
				if($val->type_pid!=0)
				{
					$val->pid_name = DB::table('zpb_type')->where('type_id',$val->type_pid)->value('type_name');
				}
				else
				{
					$val->pid_name = '顶级分类';
				}
			}
		}
		else
		{
            $user=DB::table('zpb_type')->where('type_name','like',"%$zhi%")->paginate(5);
            $user->a = $zhi;
			foreach($user as $key=>$val)
			{
				if($val->type_pid!=0)
				{
					$val->pid_name = DB::table('zpb_type')->where('type_id',$val->type_pid)->value('type_name');
				}
				else
				{
					$val->pid_name = '顶级分类';
				}
			}
		}
    	return view('type.list',['arr'=>$user]);
	}

	public function type()
	{
		if(!isset($_POST['type_name']))
		{
			$user = Role_type::get_type();
			return view('type.type',['arr'=>$user]);
		}
		else
		{
			$data = $_POST;
			$data['type_add_time'] = time();
			$re = DB::table('zpb_type')->insert($data);
			if($re)
			{
				echo 1;
			}
		}	
	}
	
	public function get_name(Request $request)
	{
		$type_name = $request->input('type_name');
		$rows = DB::table('zpb_type')->where('type_name',$type_name)->get();
		if($rows)
		{
			echo 1;
		}
	}
	
	public function del_type(Request $request)
	{
		$id = $request->input('id');
		$rows = DB::table('zpb_type')->where('type_pid',$id)->get();
		if($rows)
		{
			return "<script>alert('该分类下有子分类,不能进行是删除操作');location.href='lists';</script>";
		}
		else
		{
			$res = DB::table('zpb_type')->where('type_id',$id)->delete();
			if($res)
			{
				return redirect()->action('TypeController@lists');
			}
		}
	}
	
	public function up_type(Request $request)
	{
		$id = $request->input('id');
		$row = DB::table('zpb_type')->where('type_id',$id)->first();
	}
}