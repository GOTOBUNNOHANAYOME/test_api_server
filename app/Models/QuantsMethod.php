<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuantsMethod extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'status',
        'email',
        'password',
        'id_token',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
