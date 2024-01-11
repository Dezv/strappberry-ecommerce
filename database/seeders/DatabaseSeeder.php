<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        /*Creation list of Devices Models*/
        $categories = [
            "Electrónicos",
            "Ropa",
            "Calzado",
            "Línea Blanca",
        ];

        foreach($categories as $c){
            \App\Models\Category::create([
                'name' => $c,
            ]);
        } 
    }
}
