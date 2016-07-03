<?php
namespace App\Http\Controllers;

use Validator,DB,Redirect;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;
use Input;
use App\Http\Models\Role_type;
use Illuminate\Pagination\Paginator;

class AdvertController extends Controller
{
	/**
	 * 广告管理
	 * @return [type] [description]
	 */
	public function advert()
	{
        $arr=DB::table('zpb_advert')->join('zpb_firm','zpb_advert.firm_id', '=', 'zpb_firm.firm_id')->paginate(5);
        return view('advert.advert',['list' => $arr]);
	}

	/**
	 * 广告添加
	 * @return [type] [description]
	 */
	public function advertadd()
	{
		return view('advert.advertadd');
	}

    /**
     * 广告添加入库 ajax验证公司是否存在
     * @return [type] [description]
     */
    public function firm_name(){
        $firm_name=\Request::input('firm_name');
        $re=DB::table('zpb_firm')->where('firm_name', '=', $firm_name)->get();
        if($re){
            echo 1;
        }
    }

    /**
     * 广告添加入库
     * @return [type] [description]
     */
    public function add(){
        $file = \Request::file('adv_img');
        if($file){
            $newName=$this->file($file);
        }
        $post=\Request::input();
        $firm_id = DB::table('zpb_firm')->where('firm_name','=', $post['firm_name'])->pluck('firm_id');
        $time=time();
        $re=DB::table('zpb_advert')->insert(['firm_id' =>$firm_id['0'], 'adv_img' => $newName, 'adv_show' => $post['adv_show'], 'adv_time' => $time]);
        if($re){
            return redirect('Advert/advert');
        }
    }

    /**
     * 广告删除
     * @return [type] [descriptin]
     */
    public function delete(){
        $id = \Request::input('id');
        $re=DB::table('zpb_advert')->where('adv_id', '=', $id)->delete();
        if($re){
            echo 1;
        }
    }
    

    /**
     * 广告修改显示状态
     * @return [type] [description]
     */
    public function adv_show(Request $request){
        $adv_id=\Request::input('adv_id');
        $adv_show=$request->input('adv_show');
        $re=DB::table('zpb_advert')->where('adv_id', '=', $adv_id)->update(['adv_show' => $adv_show]);
        if($re){
            echo 1;
        }else{
            echo 0;
        }
    }

    /**
     * 广告修改
     * @return [type] [description]
     */
    public function update(){
        $id=\Request::input('id');
        $arr=DB::table('zpb_advert')->join('zpb_firm','zpb_advert.firm_id', '=', 'zpb_firm.firm_id')->where('adv_id', '=', $id)->first();
        return view('advert/advert_up',['list'=>$arr]);
    }

    /**
     * 广告执行修改
     * @return [type] [description]
     */
    public function up_update(){
        $file=\Request::file('adv_img');
        if($file){
            $newName=$this->file($file);
            $img=\Request::input('img');
            unlink("public/style/img/advert/".$img);
        }else{
            $newName=\Request::input('img');
        }
        $post=\Request::input();
        $firm_id = DB::table('zpb_firm')->where('firm_name','=', $post['firm_name'])->pluck('firm_id');

         //查询关联公司ID
        $data['adv_img']=$newName;
        $data['adv_time']=time();
        $data['firm_id']=$firm_id[0];
        $data['adv_show']=$post['adv_show'];
        $re=DB::table('zpb_advert')->where('adv_id', '=', $post['adv_id'])->update($data);
        if($re){
            echo "<script>alert('修改成功');location.href='advert'</script>";
        }
    }

    /**
     * 广告上传图片
     * @return [type] [description]
     */
    public function file($file){
        $clientName = $file -> getClientOriginalName();//客户端文件名称..
        $entension = $file -> getClientOriginalExtension(); //上传文件的后缀.

        //判断上传文件格式
        if(!in_array($entension,array('jpg','png','gif'))){
            echo "<script>alert('文件格式错误,仅支持jpg,png,gif');location.href='advertadd'</script>";
        }
        $newName = md5(date('ymdhis').$clientName).".".$entension;  //文件名称
        $path = $file -> move('public/style/img/advert/',$newName); //app_path()就是app文件夹所在的路径
        return $newName;
    }
}