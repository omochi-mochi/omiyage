<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('categories')->truncate();
        
        DB::table('categories')->insert([
            ['id' => 1, 'name' => '和菓子'],
            ['id' => 2, 'name' => '洋菓子'],
            ['id' => 3, 'name' => '飲み物'],
            ['id' => 4, 'name' => '食材'],
            ['id' => 5, 'name' => '惣菜・調味料'],
            ['id' => 6, 'name' => '雑貨'],
            ['id' => 7, 'name' => 'その他（食品）'],
            ['id' => 8, 'name' => 'その他（食品以外）'],
        ]);
        
    }
}
