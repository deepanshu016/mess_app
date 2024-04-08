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
            'role-list',
            'role-create',
            'role-edit',
            'role-update',
            'guest-login',
            'transaction-list',
            'transaction-filter',
            'customer-list',
            'customer-filter',
            'role-delete',
            'dashboard',
            'messowner-list',
            'messowner-delete',
            'messowner-edit',
            'messowner-update',
            'messowner-create',
            'advertisement-list',
            'advertisement-delete',
            'advertisement-edit',
            'advertisement-update',
            'advertisement-create',
            'news-list',
            'news-delete',
            'news-edit',
            'news-update',
            'news-create',
            'faq-list',
            'faq-delete',
            'faq-edit',
            'faq-update',
            'faq-create',
            'jobs-list',
            'jobs-delete',
            'jobs-edit',
            'jobs-update',
            'jobs-create',
            'blogs-list',
            'blogs-delete',
            'blogs-edit',
            'blogs-update',
            'blogs-create',
            'setting-list',
            'setting-update'
        ];
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission,'guard_name'=>'web']);
        }
    }
}
