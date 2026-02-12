<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\NewsCategory;

class NewsCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'School News',
                'slug' => 'school-news',
                'description' => 'News and updates about school activities',
                'color' => 'primary',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Sports',
                'slug' => 'sports',
                'description' => 'Sports achievements and events',
                'color' => 'success',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Achievements',
                'slug' => 'achievements',
                'description' => 'Student and school achievements',
                'color' => 'warning',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'Community',
                'slug' => 'community',
                'description' => 'Community news and outreach',
                'color' => 'info',
                'order' => 4,
                'is_active' => true,
            ],
            [
                'name' => 'Events',
                'slug' => 'events',
                'description' => 'Upcoming and past events coverage',
                'color' => 'danger',
                'order' => 5,
                'is_active' => true,
            ],
            [
                'name' => 'Updates',
                'slug' => 'updates',
                'description' => 'General school updates',
                'color' => 'secondary',
                'order' => 6,
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            NewsCategory::create($category);
        }
    }
}
