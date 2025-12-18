<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Concert extends Model
{
    protected $primaryKey = 'id_concert';
    protected $fillable = [
        'concert_name',
        'concert_date',
        'concert_time',
        'venue',
        'city',
        'status_concert',
        'category_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}