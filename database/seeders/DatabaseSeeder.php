<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Statistic;
use App\Models\Budget;
use App\Models\Layanan;
use App\Models\Transparansi;
use App\Models\Berita;
use App\Models\Potensi;
use App\Models\Profil;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Tambahkan user admin/demo
        User::factory()->create([
            'name'  => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Statistik penduduk
        $statistics = [
            ['label' => 'Total Penduduk', 'value' => 8542],
            ['label' => 'Laki-Laki', 'value' => 4380],
            ['label' => 'Perempuan', 'value' => 4162],
            ['label' => 'Kepala Keluarga', 'value' => 2347],
            ['label' => 'Penduduk Sementara', 'value' => 127],
            ['label' => 'Mutasi Penduduk', 'value' => 89],
        ];
        foreach ($statistics as $item) {
            Statistic::create($item);
        }

        // Anggaran (gunakan angka saja, format Rp ditambahkan di view)
        $budgets = [
            ['label' => 'Pendapatan', 'amount' => 2500000000],
            ['label' => 'Belanja', 'amount' => 2300000000],
            ['label' => 'Surplus', 'amount' => 200000000],
            ['label' => 'Pembiayaan', 'amount' => 150000000],
        ];
        foreach ($budgets as $item) {
            Budget::create($item);
        }

        // Profil kelurahan
        Profil::create([
            'judul'  => 'Profil Kelurahan Sukahaji',
            'konten' => 'Kelurahan Sukahaji memiliki visi untuk membangun pelayanan publik yang cepat, transparan, dan akuntabel...',
        ]);

        // Layanan
        $layanans = [
            [
                'judul'     => 'Pembuatan KTP',
                'deskripsi' => 'Layanan pembuatan KTP elektronik bagi warga yang sudah memenuhi syarat.'
            ],
            [
                'judul'     => 'Pembuatan KK',
                'deskripsi' => 'Layanan penerbitan Kartu Keluarga untuk penduduk baru atau pindahan.'
            ],
            [
                'judul'     => 'Surat Keterangan Usaha',
                'deskripsi' => 'Layanan untuk pembuatan surat keterangan usaha (SKU).'
            ],
        ];
        foreach ($layanans as $item) {
            Layanan::create($item);
        }

        // Transparansi dana
        $transparansis = [
            ['jenis' => 'Dana Desa', 'jumlah' => 150000000],
            ['jenis' => 'Bantuan Sosial', 'jumlah' => 50000000],
            ['jenis' => 'Pembangunan Infrastruktur', 'jumlah' => 100000000],
        ];
        foreach ($transparansis as $item) {
            Transparansi::create($item);
        }

        // Berita
        $beritas = [
            [
                'judul'   => 'Gotong Royong Bersama Warga',
                'konten'  => 'Warga Kelurahan Sukahaji melaksanakan kegiatan gotong royong membersihkan lingkungan sekitar.',
                'tanggal' => Carbon::now()->subDays(2),
            ],
            [
                'judul'   => 'Pembagian BLT Tahap II',
                'konten'  => 'Pemerintah kelurahan menyalurkan Bantuan Langsung Tunai tahap II kepada masyarakat yang berhak menerima.',
                'tanggal' => Carbon::now()->subDays(5),
            ],
            [
                'judul'   => 'Peringatan HUT RI ke-80',
                'konten'  => 'Kegiatan perlombaan rakyat diselenggarakan dalam rangka memperingati Hari Ulang Tahun Republik Indonesia.',
                'tanggal' => Carbon::now()->subDays(10),
            ],
        ];
        foreach ($beritas as $item) {
            Berita::create($item);
        }

        // Potensi kelurahan
        $potensis = [
            [
                'judul'     => 'Pertanian',
                'deskripsi' => 'Wilayah Sukahaji memiliki potensi pertanian padi dan palawija yang melimpah.'
            ],
            [
                'judul'     => 'Peternakan',
                'deskripsi' => 'Warga banyak mengembangkan usaha peternakan sapi, kambing, dan ayam.'
            ],
            [
                'judul'     => 'Pariwisata',
                'deskripsi' => 'Terdapat potensi wisata alam berupa perbukitan dan sungai yang asri.'
            ],
        ];
        foreach ($potensis as $item) {
            Potensi::create($item);
        }
    }
}
