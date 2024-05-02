<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
    ];

}
