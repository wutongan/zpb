<?php
namespace App\Http\Controllers;

use Validator,DB,Redirect;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;
use Input;
use App\Http\Models\Search;
use Illuminate\Http\RedirectResponse;


class SearchController extends Controller
{
	/**
	 * 热词列表
	 * @return [type] [description]
	 */
	public function search(Request $request)
	{
        $userinput=$request->input('userinput');
        $page=$request->input('page');
        $search=new Search;
        if(empty($userinput)){
            $arr=$search->s_list();
        }else{
            $arr=$search->s_search($userinput);
        }
        $arr->search = $userinput;
        return view('search.search',['list' => $arr]);
	}

    /**
     * 热词删除
     * @return [type] [description]
     */
    public function delete(Request $request){
        $id = $request->input('id');
        $last_id = $request->input('last_id');
        $search=new Search;
        $re=$search->s_delete($id);
        if($re){
            echo 1;
            /*$res=$search->l_select($last_id,$re);
            echo json_encode($res);*/
        }
    }

    /**
     * 热词修改
     * @return [type] [description]
     */
    public function update(Request $request){
        $id = $request->input('id');
        $search=new Search();
        $arr=$search->s_select($id);
        return view('search.search_up',['list' => $arr]);
    }

    /**
     * 执行热词修改
     * @return [type] [description]
     */
    public function e_update(Request $request){
        $arr=$request->input();
        $search=new Search();
        $re=$search->s_update($arr);
        if($re){
            echo 1;
        }
    }
}