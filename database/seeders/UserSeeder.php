<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('users')->delete();

        $adminUser = \App\Models\User::create([
            'email' => 'admin@correo.com',
            'name'  =>  'Soy El Amdin',
            'email_verified_at' =>  '2019-12-02 12:04:46',
            'password'  =>  Hash::make('admin1234'),
        ]);
        $adminUser->assignRole('admin');
        $customer = \App\Models\User::create([
            'email' => 'customer@correo.com',
            'name'  =>  'Soy El Cliente',
            'email_verified_at' =>  '2019-12-02 12:04:46',
            'password'  =>  Hash::make('client1234'),
        ]);
        $customer->assignRole('client');
    }
}
