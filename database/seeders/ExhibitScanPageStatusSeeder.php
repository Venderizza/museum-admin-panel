<?php

namespace Database\Seeders;

use App\Models\ExhibitScanPageStatus;
use Illuminate\Database\Seeder;

class ExhibitScanPageStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            'ожидает обработки',
            'в обработке',
            'ошибка',
            'на рассмотрении',
            'одобрено',
            'отклонено'
        ];

        foreach ($statuses as $status) {
            ExhibitScanPageStatus::firstOrCreate(['name' => $status]);
        }
    }
}
