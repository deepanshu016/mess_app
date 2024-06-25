<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
                'advertisement-create',
                'advertisement-delete',
                'advertisement-edit',
                'advertisement-list',
                'advertisement-update',
                'blogs-create',
                'blogs-delete',
                'blogs-edit',
                'blogs-list',
                'blogs-update',
                'customer-filter',
                'customer-list',
                'dashboard',
                'faq-create',
                'faq-delete',
                'faq-edit',
                'faq-list',
                'faq-update',
                'guest-login',
                'jobs-create',
                'jobs-delete',
                'jobs-edit',
                'jobs-list',
                'jobs-update',
                'messowner-create',
                'messowner-delete',
                'messowner-edit',
                'messowner-list',
                'messowner-update',
                'news-create',
                'news-delete',
                'news-edit',
                'news-list',
                'news-update',
                'role-create',
                'role-delete',
                'role-edit',
                'role-list',
                'role-update',
                'settings-update',
                'transaction-filter',
                'transaction-list',
                'users-create',
                'users-delete',
                'users-list',
                'users-update'
        ];
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission,'guard_name'=>'web']);
        }
    }
}
