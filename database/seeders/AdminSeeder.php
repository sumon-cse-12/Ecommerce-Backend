<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = new User();    
        $admin->name = 'Admin';
        $admin->email = 'admin@gmail.com';
        $admin->password = Hash::make('123456');
        $admin->save();
    }
}
