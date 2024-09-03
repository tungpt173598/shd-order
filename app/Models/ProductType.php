<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    use HasFactory;

    public $fillable = ['name', 'code'];

    const TYPE = [
        'song-b',
        'song-e',
        'i-350',
        'kep-file-a4-11',
        'kep-file-a4-22',
        'kep-file-a4-21',
        'de-can-giay-can-mo',
        'to-roi-a4',
        'c-300-can-mo',
        'tui-giay-i250',
        'tui-giay-krap',
        'catalog-20-x-20',
        'catalog-a4-b-c250',
        'catalog-a4-bia-cung',
        'catalog-a5-b-c250',
        'catalog-a5-bia-cung',
        'phong-bi-a-4-150',
        'phong-bi-a-5-120',
        'phong-bi-a-6-120',
    ];
}
