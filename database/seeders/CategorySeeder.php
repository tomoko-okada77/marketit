<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;


class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    private $category;

    public function __construct(Category $category) {
        $this->category = $category;
    }
    
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Fashion',
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ],
            [
                'name' => 'Game',
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ],
            [
                'name' => 'Hobby',
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ],
            [
                'name' => 'Book',
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ],
            [
                'name' => 'Sports',
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ],
            [
                'name' => 'Food',
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ],
        ];
        $this->category->insert($categories);
    }
}
