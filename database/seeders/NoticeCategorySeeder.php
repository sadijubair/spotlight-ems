<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\NoticeCategory;

class NoticeCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'General',
                'slug' => 'general',
                'description' => 'General notices and announcements',
                'color' => 'primary',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Important',
                'slug' => 'important',
                'description' => 'Important notices requiring attention',
                'color' => 'danger',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Academic',
                'slug' => 'academic',
                'description' => 'Academic related notices and updates',
                'color' => 'success',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'Events',
                'slug' => 'events',
                'description' => 'School events and activities',
                'color' => 'info',
                'order' => 4,
                'is_active' => true,
            ],
            [
                'name' => 'Urgent',
                'slug' => 'urgent',
                'description' => 'Urgent notifications and alerts',
                'color' => 'warning',
                'order' => 5,
                'is_active' => true,
            ],
            [
                'name' => 'Holidays',
                'slug' => 'holidays',
                'description' => 'Holiday announcements and calendar',
                'color' => 'secondary',
                'order' => 6,
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            NoticeCategory::create($category);
        }
    }
}
