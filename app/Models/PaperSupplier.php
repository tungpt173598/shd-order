<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaperSupplier extends Model
{
    use HasFactory, SoftDeletes;

    public $fillable = ['name', 'phone', 'address', 'price'];
}
