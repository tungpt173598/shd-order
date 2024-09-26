<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    const PRE_CHARGE = 1;
    const NOT_CHARGE = 2;
    protected $fillable = [
        'code',
        'customer',
        'price',
        'payment_status',
        'payment_type',
        'pre_charge',
        'paper_supplier',
        'paper_done',
        'printed_by',
        'print_done',
        'design',
        'design_done',
        'machining',
        'machining_done',
        'pack',
        'pack_done',
        'deliver',
        'deliver_done',
        'delivery_date',
        'mold',
        'mold_done',
        'paper_type',
        'paper_size',
        'paper_quantity',
        'print_zn',
        'print_type',
        'process_child_2',
        'process_child_1',
        'process_child_3',
        'process_detail',
        'done'
    ];
    protected function deliveryDate(): Attribute
    {
        return Attribute::make(
            get: fn (?string $value) => !empty($value) ? Carbon::createFromFormat('Y-m-d', $value)->format('d-m-Y') : null,
            set: fn (?string $value) => !empty($value) ? Carbon::createFromFormat('d-m-Y', $value)->format('Y-m-d') : null,
        );
    }
}
