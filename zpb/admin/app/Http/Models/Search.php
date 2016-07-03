<?php
namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Validator,DB,Redirect;
use Illuminate\Pagination\paginate;

class Search extends Model
{
    /*
     * 查询表数据
     * @return mixed
     */
    public function s_list(){
        return DB::table('zpb_search')->paginate(5);
    }

    /*
     * 删除数据
     * @return mixed
     */
    public function s_delete($id){
        return DB::table('zpb_search')->where('sea_id', '=', $id)->delete();
    }

    /*
   * 节点删除数据, 查询最后一条数据
   * @return mixed
   */
    public function l_select($last_id,$re){
        return DB::table('zpb_search')->where('sea_id', '>', $last_id)->orderBy('sea_id', 'desc')->take($re)->first();
    }

    /*
    * 修改数据
    * @return mixed
    */
    public function s_select($id){
        return DB::table('zpb_search')->where('sea_id', '=', $id)->first();
    }

    /*
    * 执行修改数据
    * @return mixed
    */
    public function s_update($arr){
        return DB::table('zpb_search')->where('sea_id', '=', $arr['sea_id'])->update($arr);
    }

    /*
  * 搜索数据
  * @return mixed
  */
    public function s_search($userinput){
        return DB::table('zpb_search')->where('sea_name', 'like', "%$userinput%")->paginate(5);
    }
}
