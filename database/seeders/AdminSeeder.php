<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        return Admin::query()->create([
            'name' => 'Ameer Ahmed',
            'email' => 'ameer@mehan.com',
            'password' => bcrypt('mehanplus'),
        ]);
    }
}
