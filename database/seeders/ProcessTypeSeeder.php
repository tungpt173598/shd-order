<?php

namespace Database\Seeders;

use App\Models\ProcessType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProcessTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();
        try {
            ProcessType::truncate();
            ProcessType::create(['id' => 1, 'name' => 'Túi']);
            ProcessType::create(['id' => 2, 'name' => 'Sách']);
            ProcessType::create(['id' => 3, 'name' => 'Hàng khác']);
            $bagChildren = ['Cán bóng', 'Cán mờ', 'Dây'];
            foreach ($bagChildren as $bagChild) {
                ProcessType::create(['name' => $bagChild, 'parent_id' => 1]);
            }
            $bookHard = ProcessType::create(['name' => 'Bìa cứng', 'parent_id' => 2]);
            ProcessType::insert([
                [
                    'name' => 'Cán bóng',
                    'parent_id' => $bookHard->id
                ],
                [
                    'name' => 'Cán mờ',
                    'parent_id' => $bookHard->id
                ]
            ]);
            $bookSoft = ProcessType::create(['name' => 'Bìa mềm', 'parent_id' => 2]);
            ProcessType::insert([
                [
                    'name' => 'Cán bóng',
                    'parent_id' => $bookSoft->id
                ],
                [
                    'name' => 'Cán mờ',
                    'parent_id' => $bookSoft->id
                ]
            ]);
            ProcessType::create(['name' => 'Quy cách', 'parent_id' => 2]);
            $otherChildren = ['Cán bóng', 'Cán mờ', 'Bế thành phẩm', 'Xén thành phẩm'];
            foreach ($otherChildren as $otherChild) {
                ProcessType::create(['name' => $otherChild, 'parent_id' => 3]);
            }
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
        }

    }
}
