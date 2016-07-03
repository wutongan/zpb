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
class SortController extends Controller
{
	/**
	 * 文章分类列表
	 * @return [type] [description]
	 */
	public function sort()
	{
		$users = DB::table('zpb_article_sort')->paginate(5);
        		return view('sort.sort', ['users' => $users]);
	}
	//删除
	public function delt()
	{
		$id=$_GET['sort_id'];
		$str = DB::delete("delete from zpb_article_sort where sort_id = '$id'");
		return Redirect('Sort/sort');
	}

	//添加页面
	public function add()
	{
        $sql="select * from zpb_article_sort";
        $arr=DB::select($sql);

        if($arr['pid']=0){
            $sql="select * from zpb_article_sort where pid=0";
            $data=DB::select($sql);

            foreach ($data as $key => $value) {
                $sql1="select * from zpb_article_sort where pid=".$value->sort_id;
                $value->demo=DB::select($sql1);
            }
            return view('sort.add_list',['data'=>$data]);
        }else{
            return view('sort.add_list');
        }
	}

	public function add_list(Request $request)
	{
		$sort_name=$request->input('sort_name');
		$sort_id=$request->input('sort_id');
		$time=date('Y-m-d H:i:s',time());
		$str=DB::table('zpb_article_sort')->insert([
            'pid' => $sort_id,
            'sort_name' => $sort_name,
            'sort_add_time' => $time,
        ]);
        return redirect('Sort/sort');
	}
	//修改
	public function up()
	{
		$id=$_GET['id'];
		$value=$_GET['val'];
		$str=DB::update("update zpb_article_sort set sort_name='$value' where sort_id='$id'");
		if($str)
		{
			echo 1;
		}
		else
		{
			echo 0;
		}
	}
}