<?php

namespace Database\Seeders;

use App\Models\Deliver;
use App\Models\Design;
use App\Models\Machining;
use App\Models\Pack;
use App\Models\PaperSupplier;
use App\Models\PrintingHouse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RemoveOtherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Design::where('name', 'Khác')->delete();
        Machining::where('name', 'Khác')->delete();
        PaperSupplier::where('name', 'Khác')->delete();
        Deliver::where('name', 'Khác')->delete();
        Pack::where('name', 'Khác')->delete();
        PrintingHouse::where('name', 'Khác')->delete();
    }
}
