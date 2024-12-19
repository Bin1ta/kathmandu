<?php

namespace Database\Seeders;

use App\Traits\StoreSqlInDatabaseTrait;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AddressSeeder extends Seeder
{
    use StoreSqlInDatabaseTrait;
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $this->storeSql(app_path('Utils/sql/Address/address.sql'));
    }
}
