<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Statistic;
use App\Models\Budget;
use App\Models\Berita;
use App\Models\Layanan;
use App\Models\Pemerintahan;

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
        Pemerintahan::create([
        'name' => 'AGUS RIYADI, S.E',
        'nip' => '19720823 2003 1 001',
        'position' => 'Kepala Kelurahan',
        'description' => 'Dengan pengalaman lebih dari 15 tahun dalam pelayanan publik...',
        'photo' => null, 
        ]);
         // Sekretaris
        Pemerintahan::create([
            'name' => 'HANDRIYANA, SH.',
            'nip' => '19761230 201001 1 004',
            'position' => 'Sekretaris Kelurahan',
            'description' => 'Membantu Kepala dalam administrasi',
            'photo' => null,
        ]);

        // Kepala Seksi
        Pemerintahan::create([
            'name' => 'HANDRIYANA, SH.',
            'nip' => '19761230 201001 1 004',
            'position' => 'PLT. Kepala Seksi Pemerintahan',
            'description' => null,
            'photo' => null,
        ]);

        Pemerintahan::create([
            'name' => 'BONDAN IRAWAN, SE.',
            'nip' => '19710505 200801 1 008',
            'position' => 'Kepala Seksi ekonomi dan Pembangunan',
            'description' => null,
            'photo' => null,
        ]);

        Pemerintahan::create([
            'name' => 'TUTY MASITOH, S.Sos',
            'nip' => '19721201 200701 2 011',
            'position' => 'Kepala Seksi kesejahteraan Sosial',
            'description' => null,
            'photo' => null,
        ]);

        // Staff (contoh saja)
        Pemerintahan::create([
            'name' => 'Staff A',
            'nip' => '19981208 202001 2 004',
            'position' => 'Bendahara Kelurahan',
            'description' => null,
            'photo' => null,
        ]);

        Pemerintahan::create([
            'name' => 'Staff B',
            'nip' => '19901105 199101 2 002',
            'position' => 'Staff Administrasi',
            'description' => null,
            'photo' => null,
        ]);
    }
}