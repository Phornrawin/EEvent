<?php

use EEvent\Category;
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
        DB::table('categories')->delete();
        $names = ['Adventure', 'Dance', 'Movement', 'Food', 'Movie', 'Other'];
        $colors = ['#FF4136', '#F012BE', '#0074D9', '#FF851B', '#001f3f', '#AAAAAA'];
        for ($i = 0; $i < count($names); $i++) {
            Category::create([
                'name' => $names[$i],
                'color' => $colors[$i]]);
        }

    }
}
