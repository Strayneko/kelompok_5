<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        User::create([
            'role_id' => 2,
            'name' => 'admin',
            'email' => 'admin123@gmail.com',
            'password' => 'admin12345',
            'image' => 'ikan_tongkol.jpg',
            'gender' => '0',
            'birth_date' => now(),
        ]);
        
        User::create([
            'role_id' => 1,
            'name' => 'User',
            'email' => 'user123@gmail.com',
            'password' => 'user12345',
            'image' => 'ikan_tongkol.jpg',
            'gender' => '1',
            'birth_date' => now(),
        ]);
    }
}
