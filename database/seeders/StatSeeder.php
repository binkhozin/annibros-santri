<?php

namespace Database\Seeders;

use App\Models\Stat;
use Illuminate\Database\Seeder;

class StatSeeder extends Seeder
{
    public function run(): void
    {
        Stat::create([
            'label' => 'Proyek Selesai',
            'value' => 50,
            'icon' => 'check-circle',
            'sort_order' => 1,
            'is_active' => true,
        ]);

        Stat::create([
            'label' => 'Klien Puas',
            'value' => 30,
            'icon' => 'users',
            'sort_order' => 2,
            'is_active' => true,
        ]);

        Stat::create([
            'label' => 'Tahun Pengalaman',
            'value' => 5,
            'icon' => 'award',
            'sort_order' => 3,
            'is_active' => true,
        ]);
    }
}
