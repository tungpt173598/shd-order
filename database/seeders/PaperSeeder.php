<?php

namespace Database\Seeders;

use App\Models\PaperSupplier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaperSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'Anh Đạt',
            'Thành Đạt',
            'Ngọc Hưng',
            'An Giang',
            'Nhật Linh',
            'Linh Hiếu',
            'Nam Hưng',
            'Khác'
        ];
        foreach ($data as $name) {
            PaperSupplier::create(['name' => $name]);
        }
    }
}
