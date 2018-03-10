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

        foreach ($names as $name) {
            Category::create([
                'name' => $name]);
        }
    }
}
