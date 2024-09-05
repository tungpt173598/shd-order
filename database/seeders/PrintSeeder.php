<?php

namespace Database\Seeders;

use App\Models\Design;
use App\Models\PaperSupplier;
use App\Models\PrintingHouse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PrintSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'PTVT',
            'SHD',
            'Bình Trần Gia'
        ];
        foreach ($data as $name) {
            PrintingHouse::create(['name' => $name]);
        }
    }
}
