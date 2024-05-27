<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Superadmin',
            'email' => 'admin@mail.com',
            'password' => password_hash('asdasd', PASSWORD_DEFAULT)
        ]);

        DB::table('kategori')->insert([
            'nama_kategori' => 'Boy Group'
        ]);

        DB::table('artist')->insert([
            'nama_artist' => 'Exo',
            'id_kategori' => 1,
            'description' => 'Lorem Ipsum',
            'gambar_artist' => 'exo.jpg'
        ]);
        
    }
}
