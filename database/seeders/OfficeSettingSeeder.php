<?php

namespace Database\Seeders;

use App\Models\OfficeSetting;
use Illuminate\Database\Seeder;

class OfficeSettingSeeder extends Seeder
{
    public function run()
    {
        OfficeSetting::create([
            'name' => 'text'
        ]);
    }
}
