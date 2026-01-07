<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Concert_Price;


class Concert extends Model
{
    protected $table = 'concerts';
    public $timestamps = false;
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
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function prices()
    {
        return $this->hasMany(Concert_Price::class, 'id_concert', 'id_concert');
    }
    public function seatings()
    {
        return $this->belongsToMany(
            Seating::class,
            'concert_seating',   // pivot table
            'concert_id',
            'seating_id'
        )->withPivot('price');
    }


}