<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Concert_Price extends Model
{
    protected $table = 'concert_price';
    protected $primaryKey = 'id_price';
    protected $fillable = [
        'id_concert',
        'id_seating',
        'ticket_price',
        'quota',
        'sold',
        'status_seating',
        'created_at',
        'updated_at'
    ];
    public function seating()
    {
        return $this->belongsTo(Seating::class, 'id_seating', 'id_seating');
    }

}