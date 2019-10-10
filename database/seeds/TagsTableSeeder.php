<?php

use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('tags')->truncate();
        
        DB::table('tags')->insert([
            ['id' => 1, 'name' => '手ごろ'],
            ['id' => 2, 'name' => '高級感'],
            ['id' => 3, 'name' => '大人数に'],
            ['id' => 4, 'name' => '見た目重視'],
            ['id' => 5, 'name' => '定番'],
            ['id' => 6, 'name' => '新しい'],
            ['id' => 7, 'name' => '限定品'],
            ['id' => 8, 'name' => '日持ちする'],
        ]);
    }
}
