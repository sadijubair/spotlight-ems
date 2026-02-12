<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BlogCategory;

class BlogCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Education',
                'slug' => 'education',
                'description' => 'Educational tips and insights',
                'color' => 'primary',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Technology',
                'slug' => 'technology',
                'description' => 'Technology in education',
                'color' => 'info',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Teaching Methods',
                'slug' => 'teaching-methods',
                'description' => 'Innovative teaching approaches',
                'color' => 'success',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'Student Life',
                'slug' => 'student-life',
                'description' => 'Student experiences and stories',
                'color' => 'warning',
                'order' => 4,
                'is_active' => true,
            ],
            [
                'name' => 'Parenting',
                'slug' => 'parenting',
                'description' => 'Parenting tips and guidance',
                'color' => 'danger',
                'order' => 5,
                'is_active' => true,
            ],
            [
                'name' => 'General',
                'slug' => 'general',
                'description' => 'General blog posts',
                'color' => 'secondary',
                'order' => 6,
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            BlogCategory::create($category);
        }
    }
}
