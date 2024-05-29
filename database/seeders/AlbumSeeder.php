<?php

namespace Database\Seeders;

use App\Models\Album;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AlbumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create('id_ID');
        $album = new Album();

        $album->name_album = 'XOXO';
        $album->gambar_album = 'xoxo.jpg';
        $album->genre = 'K-pop, Hip Hop, R&B, Mandopop';
        $album->barcode = $faker->numerify('######');
        $album->id_artist = 1;
        $album->price = 160000;
        $album->save();
    }
}
