<?php

use Illuminate\Database\Seeder;

class GoodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       /* DB::table('goods')->insert([
            'goods_name' => str_random(10),
            'inventory' => 100,
        ]);*/
        
        factory('App\Models\Goods', 50)->create()->make();
    }
    
}
