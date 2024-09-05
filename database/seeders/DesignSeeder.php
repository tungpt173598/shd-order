<?php

namespace Database\Seeders;

use App\Models\Design;
use App\Models\PaperSupplier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DesignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'Có sẵn',
            'SHD'
        ];
        foreach ($data as $name) {
            Design::create(['name' => $name]);
        }
    }
}
