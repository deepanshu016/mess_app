<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use Spatie\Permission\Models\Role as ModelsRole;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $adminRole = ModelsRole::create(['name' => 'ADMIN','guard_name'=>'web']);
        $messRole = ModelsRole::create(['name' => 'MESS_OWNER','guard_name'=>'web']);
        $customerRole = ModelsRole::create(['name' => 'CUSTOMER','guard_name'=>'web']);
    }
}
