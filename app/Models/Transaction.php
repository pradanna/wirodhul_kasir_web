<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id',
        'date',
        'no_reference',
        'sub_total',
        'discount',
        'total',
        'status'
    ];

    public function member()
    {
        return $this->belongsTo(Member::class,'member_id');
    }

    public function carts()
    {
        return $this->hasMany(Cart::class,'transaction_id');
    }
}
