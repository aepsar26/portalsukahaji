<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Statistic;

class StatisticSeeder extends Seeder {
    public function run(): void {
        $data = [
            ['label' => 'Total Penduduk', 'value' => 8542],
            ['label' => 'Laki-Laki', 'value' => 4380],
            ['label' => 'Perempuan', 'value' => 4162],
            ['label' => 'Kepala Keluarga', 'value' => 2347],
            ['label' => 'Penduduk Sementara', 'value' => 127],
            ['label' => 'Mutasi Penduduk', 'value' => 89],
        ];
        foreach ($data as $item) {
            Statistic::create($item);
        }
        
    }
}   