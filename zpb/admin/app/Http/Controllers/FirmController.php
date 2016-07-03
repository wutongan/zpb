<?php
namespace App\Http\Controllers;

use Validator,DB,Redirect;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;
use Input;
use App\Http\Models\Role_type;

class FirmController extends Controller
{
	/**
	 * 公司列表
	 * [add description]
	 */
	public function liebiao()
	{
		$posts = DB::table('zpb_firm')
            ->join('zpb_members', 'zpb_firm.m_id', '=', 'zpb_members.m_id')
            ->paginate(5);
		return view('firm.list',['posts'=>$posts]);
	}
    /**
     *认证
     *
     */
    public function rz()
    {
        $firm_id=$_GET['f_id'];
        $re = DB::table('zpb_firm')
              ->where('firm_id', $firm_id)
              ->update(array('firm_lock' => 2));
        if($re){
            echo "1";
        }else{
            echo "0";
        }
    }
    /**
     *不通过
     */
    public function fj(){
        $firm_id=$_GET['f_id'];
        $re = DB::table('zpb_firm')
            ->where('firm_id', $firm_id)
            ->update(array('firm_lock' => 0));
        if($re){
            echo "1";
        }else{
            echo "0";
        }
    }
    /**
     * 根据关键字搜索
     * */
    public function search(){
        $firm_name=$_GET['firm_name'];
        if($firm_name=="") {
             echo "<script>alert('请输入搜索值');location.href='liebiao'</script>";
        }else {
            $re = DB::table('zpb_firm')
                ->where('firm_name', 'like', "%$firm_name%")
                ->join('zpb_members', 'zpb_firm.m_id', '=', 'zpb_members.m_id')
                ->paginate(5);
            if ($re) {
                return view('firm.list',['posts'=>$re]);
            }
        }
    }
    /**
     *点击搜索未审核的
     */
    public function wsh(){
        $wsh=$_GET['wsh'];
        $re = DB::table('zpb_firm')
            ->where('firm_lock', 'like', "%$wsh%")
            ->join('zpb_members', 'zpb_firm.m_id', '=', 'zpb_members.m_id')
            ->paginate(5);
        if ($re) {
            $re->yrz = $wsh;
            return view('firm.list',['posts'=>$re]);
        }
    }
    /**
     *点击搜索已认证的
     */
    public function yrz(){
        $yrz=$_GET['yrz'];
        $re = DB::table('zpb_firm')
            ->where('firm_lock', 'like', "%$yrz%")
            ->join('zpb_members', 'zpb_firm.m_id', '=', 'zpb_members.m_id')
            ->paginate(5);
        if ($re) {
            $re->yrz = $yrz;
            return view('firm.list',['posts'=>$re]);
        }
    }
    /**
     *点击搜索未通过的
     */
    public function wtg(){
        $wtg=$_GET['wtg'];
        $re = DB::table('zpb_firm')
            ->where('firm_lock', 'like', "%$wtg%")
            ->join('zpb_members', 'zpb_firm.m_id', '=', 'zpb_members.m_id')
            ->paginate(5);
        if ($re) {
            $re->yrz = $wtg;
            return view('firm.list',['posts'=>$re]);
        }
    }
    /**
     *职位列表显示
     */
    public function show()
	{
        $m_id = $_GET['m_id'];
        $re=DB::table('zpb_recruit')
            ->where('m_id',$m_id)
            ->join('zpb_study', 'zpb_recruit.stu_id', '=', 'zpb_study.stu_id')
            ->join('zpb_suffer', 'zpb_recruit.suf_id', '=', 'zpb_suffer.suf_id')
            ->paginate(5);
		$re->a='';
        return view('firm.recruit',['re'=>$re]);
    }
    /**
     *职位列表搜索
     */
    public function ss(){
        $title = $_POST['title'];
		$m_id = $_POST['id'];
        if($title=="") {
            $re=DB::table('zpb_recruit')
            ->where('m_id',$m_id)
            ->join('zpb_study', 'zpb_recruit.stu_id', '=', 'zpb_study.stu_id')
            ->join('zpb_suffer', 'zpb_recruit.suf_id', '=', 'zpb_suffer.suf_id')
            ->paginate(5);
			$re->a='';
        }else {
            $re = DB::table('zpb_recruit')
                ->where('rec_title', 'like', "%$title%")
                ->join('zpb_study', 'zpb_recruit.stu_id', '=', 'zpb_study.stu_id')
                ->join('zpb_suffer', 'zpb_recruit.suf_id', '=', 'zpb_suffer.suf_id')
                ->paginate(5);
			$re->a=$title;
        }
		if ($re) {
            return view('firm.recruit',['re'=>$re]);
        }
    }
	/**
	 * 查看职位
	 *
	 */
	public function recruit() 
	{
		$id=$_GET['rec_id'];
		$arr = DB::table('zpb_recruit')->where('rec_id','=',$id)->join('zpb_study', 'zpb_recruit.stu_id', '=', 'zpb_study.stu_id')->join('zpb_suffer', 'zpb_recruit.suf_id', '=', 'zpb_suffer.suf_id')->first();

		return view('firm.see',['arr'=>$arr]);
	}

	/**
	 * 查看公司详细信息
	 *
	 */
	public function firm(Request $request) 
	{
		$id = $request->get('m_id');
		$arr = DB::table('zpb_firm')->where('m_id','=',$id)->join('zpb_field', 'zpb_firm.field_id', '=', 'zpb_field.field_id')->first();
		if(empty($arr))
		{
			echo "<script>alert('该公司信息尚未完善,不能查看');location.href='liebiao';</script>";
		}
		else 
		{
			return view('firm.firm',['arr'=>$arr]);
		}
	}
}
