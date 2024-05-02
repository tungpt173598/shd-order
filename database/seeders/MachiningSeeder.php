<?php

namespace Database\Seeders;

use App\Models\Design;
use App\Models\Machining;
use App\Models\PaperSupplier;
use App\Models\PrintingHouse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MachiningSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'Kiên Tuyết',
            'Chung BC',
            'Linh Trí Việt',
            'Ngọc',
            'H. Ngọc',
            'Toản Huệ',
            'Cô Trúc',
            'Duy Quân',
            'Hùng BIC',
            'Khác'
        ];
        foreach ($data as $name) {
            Machining::create(['name' => $name]);
        }
    }
}
