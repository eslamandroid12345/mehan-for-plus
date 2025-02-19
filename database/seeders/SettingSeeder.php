<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::query()->updateOrCreate(
            ['key' => 'default_profile_image'],
            ['value' => null]
        );
//        Setting::query()->updateOrCreate(
//            ['key' => 'ad_price'],
//            ['value' => null]
//        );
    }
}
