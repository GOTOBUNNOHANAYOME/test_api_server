<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'english_name',
        'sector_17_code',
        'sector_33_code',
        'scale_category',
        'market_code',
        'listed_at',
    ];
}
