<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuantsMethod extends Model
{
    use HasFactory;

    protected $fillable = [
        'finance_user_id',
        'status',
        'refresh_token',
        'refresh_token_expired_at',
        'id_token',
    ];

    public function financeUser()
    {
        return $this->belongsTo(FinanceUser::class);
    }
}
