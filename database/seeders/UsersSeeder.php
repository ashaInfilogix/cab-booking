<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminUser = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'contact_number' => '9898989898',
            'password' => Hash::make('123456'),
        ]);
        $adminUser->assignRole('Admin');

        $regularUser = User::create([
            'name' => 'Demo Customer',
            'email' => 'customer@gmail.com',
            'contact_number' => '9898989898',
            'password' => Hash::make('123456'),
        ]);
        $regularUser->assignRole('Customer');
    }
}
