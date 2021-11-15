<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings = [
            [
                'site_title' => 'Acme',
                'logo' => '/images/logo.png',
                'map' => '<iframe style="border:0; width: 100%; height: 350px;" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12097.433213460943!2d-74.0062269!3d40.7101282!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb89d1fe6bc499443!2sDowntown+Conference+Center!5e0!3m2!1smk!2sbg!4v1539943755621" frameborder="0" allowfullscreen></iframe>',
                'address' => 'A108 Adam Street<br>New York, NY 535022',
                'email' => 'info@example.com',
                'phone' => '+1 5589 55488 51',
                'copyright' => '&copy; Copyright <strong><span>Company</span></strong>. All Rights Reserved'
            ]
        ];

        Setting::insert($settings);
    }
}
