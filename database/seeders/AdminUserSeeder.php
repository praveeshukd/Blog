<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([

            'name'    => 'Admin',
            'email'   => 'admin@admin.com',
            'password'=> Hash::make('password'),
            'is_admin'=> true
     
        ]);

        
    }
}
