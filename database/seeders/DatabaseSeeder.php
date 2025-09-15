<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Statistic;
use App\Models\Budget;
use App\Models\Berita;
use App\Models\Layanan;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Create sample statistics
        Statistic::create([
            'label' => 'Total Penduduk',
            'value' => 5432
        ]);

        Statistic::create([
            'label' => 'Kepala Keluarga',
            'value' => 1245
        ]);

        Statistic::create([
            'label' => 'Laki-laki',
            'value' => 2756
        ]);

        Statistic::create([
            'label' => 'Perempuan',
            'value' => 2676
        ]);

        // Create sample budgets
        Budget::create([
            'label' => 'Pendapatan Kelurahan',
            'amount' => 2500000000
        ]);

        Budget::create([
            'label' => 'Belanja Operasional',
            'amount' => 800000000
        ]);

        Budget::create([
            'label' => 'Belanja Modal',
            'amount' => 500000000
        ]);

        // Create sample news
        Berita::create([
            'title' => 'Gotong Royong Pembersihan Kelurahan',
            'content' => 'Kegiatan gotong royong dilaksanakan setiap hari Minggu untuk menjaga kebersihan lingkungan kelurahan.',
            'date' => now()->subDays(7)
        ]);

        Berita::create([
            'title' => 'Pelayanan Administrasi Diperpanjang',
            'content' => 'Jam pelayanan administrasi kependudukan diperpanjang hingga pukul 16:00 WIB untuk memudahkan masyarakat.',
            'date' => now()->subDays(3)
        ]);

        // Create sample services
        Layanan::create([
            'title' => 'Surat Keterangan Domisili',
            'description' => 'Layanan pembuatan surat keterangan domisili untuk keperluan administrasi penduduk.'
        ]);

        Layanan::create([
            'title' => 'Surat Keterangan Tidak Mampu',
            'description' => 'Layanan pembuatan surat keterangan tidak mampu untuk keperluan bantuan sosial.'
        ]);

        Layanan::create([
            'title' => 'Pengantar KTP',
            'description' => 'Layanan surat pengantar untuk pembuatan KTP baru atau perpanjangan.'
        ]);
    }
}