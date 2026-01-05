<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transactions';
    protected $primaryKey = 'id_transaction';
    protected $fillable = [
        'user_id',
        'id_concert',
        'id_price',
        'name',
        'payment_method',
        'total_price',
        'status',
        'payment_proof'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function concert()
    {
        return $this->belongsTo(Concert::class, 'id_concert', 'id_concert');
    }

    public function price()
    {
        return $this->belongsTo(Concert_Price::class, 'id_price', 'id_price');
    }

}