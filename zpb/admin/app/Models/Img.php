<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Img extends Model
{
	protected $table = 'img';
	protected $primaryKey = "mid";
    protected function get_aa()
    {
    	$ar = Img::get();
    	foreach($ar as $v)
    	{
    		$arr[] = $v->original;
    	}
    	return $arr;
    }
}
