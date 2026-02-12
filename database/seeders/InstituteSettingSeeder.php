<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\InstituteSetting;

class InstituteSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        InstituteSetting::create([
            'name' => 'Spotlight School & College',
            'name_bangla' => 'স্পটলাইট স্কুল ও কলেজ',
            'short_form' => 'SSC',
            'motto' => 'Knowledge is Power',
            'medium' => 'Both',
            'establish_year' => 2020,
            'institute_type' => 'School & College',
            'board' => 'Dhaka',
        ]);
    }
}
