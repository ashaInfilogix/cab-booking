<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = Setting::create([
            'email' => 'admin@gmail.com',
            'phone_number' => '+2 123 654 7898',
            'address' => '25/B Milford Road, New York',
            'about_us' => "There are many variations of passages available sure there majority have suffered alteration in some form by injected humour or randomised words which don't look even slightly believable.",
            'facebook_url' => null,
            'twitter_url' => null,
            'instagram_url' => null,
            'linkedin_url' => null
        ]);
    }
}
