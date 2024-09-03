<?php

namespace Database\Seeders;

use App\Models\ProductType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'HỘP BỒI SÓNG B',
            'HỘP BỒI SÓNG E',
            'HỘP GIẤY I 350 CÁN MỜ',
            'KẸP FILE A4 IN 1 CÁN 1',
            'KẸP FILE A4 IN 2 CÁN 2',
            'KẸP FILE A4 IN 2 CÁN 1',
            'TEM DE CAN GIẤY CÁN MỜ',
            'TỜ RƠI A4',
            'TÚI GIẤY -C 300 cán mờ',
            'TÚI GIẤY I250',
            'TÚI GIẤY KRAP',
            'CATALOG 20 x 20 bìa c250 r c 150',
            'CATALOG A4, B C250 M 1',
            'CATALOG A4, Bìa cứng',
            'CATALOG A5 Bìa C250 ruột C 150',
            'CATALOG A5, Bìa cứng',
            'PHONG BÌ A 4 OF 150',
            'PHONG BÌ A 5 OFF 120',
            'PHONG BÌ A 6 OFF 120'
        ];
        ProductType::truncate();
        foreach ($data as $i => $type) {
            ProductType::create(['name' => $type, 'code' => $i + 1]);
        }
    }
}
