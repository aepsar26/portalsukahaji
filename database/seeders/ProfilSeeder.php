<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    \App\Models\Profil::create([
        'judul' => 'Profil Kelurahan Sukahaji',
        'konten' => 'Kelurahan Sukahaji memiliki visi untuk membangun pelayanan publik yang cepat, transparan, dan akuntabel...',
    ]);
}

}
