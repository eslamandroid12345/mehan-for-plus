<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countries = [
            [
                'name_en' => 'Saudi Arabia',
                'name_ar' => 'المملكة العربية السعودية'
            ],
            [
                'name_en' => 'Egypt',
                'name_ar' => 'مصر'
            ],
        ];
        Country::query()->insert($countries);
    }
}
