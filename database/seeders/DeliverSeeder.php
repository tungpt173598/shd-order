<?php

namespace Database\Seeders;

use App\Models\Deliver;
use App\Models\Design;
use App\Models\PaperSupplier;
use App\Models\PrintingHouse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DeliverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'Trường',
            'Quyến',
            'Anh Hùng',
            'Grab'
        ];
        foreach ($data as $name) {
            Deliver::create(['name' => $name]);
        }
    }
}
