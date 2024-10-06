<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UpdateDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $orders = Order::all();
        foreach ($orders as $order) {
            $paper = '';
            if ($order->paper_type) $paper .= "Loại: {$order->paper_type}\n";
            if ($order->paper_size) $paper .= "Khổ: {$order->paper_size}\n";
            if ($order->paper_quantity) $paper .= "SL: {$order->paper_quantity}";
            $print = '';
            if ($order->print_zn) $print .= "Số kẽm: {$order->print_zn}\n";
            if ($order->print_type) $print .= "Quy cách: {$order->print_type}";
            $order->update(['paper_detail' => $paper, 'print_detail' => $print]);
        }
    }
}
