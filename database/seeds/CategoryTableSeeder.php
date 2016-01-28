<?php

use Learner\Models\Category;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'name' => 'php',
                'image' => '/img/category/php.png'
            ],
            [
                'name' => 'javascript',
                'image' => '/img/category/javascript.png'
            ]
        ];

        foreach ($categories as $c) {
            Category::create([
                'name' => $c['name'],
                'image' => $c['image'],
            ]);
        }
    }
}
