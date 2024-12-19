<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Traits\StorePermissionTrait;

class PermissionSeeder extends Seeder
{
    use StorePermissionTrait;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'role_access',
            'role_create',
            'role_edit',
            'role_delete',
            'user_access',
            'user_create',
            'user_edit',
            'user_delete',
            'officeSetting_access',
            'officeSetting_edit',
            'officeHeader_edit',
            'officeHeader_delete',
            'employee_access',
            'employee_create',
            'employee_edit',
            'employee_delete',
            'video_access',
            'video_create',
            'video_edit',
            'video_delete',
            'notice_access',
            'notice_create',
            'notice_edit',
            'notice_delete',
            'news_access',
            'news_create',
            'news_edit',
            'news_delete',
            'popup_access',
            'popup_create',
            'popup_edit',
            'popup_delete',
            'hall_program_access',
            'hall_program_create',
            'hall_program_edit',
            'hall_program_delete',
            'hall_access',
            'hall_create',
            'hall_edit',
            'hall_delete',


        ];

        $this->storePermission($permissions);
    }
}
