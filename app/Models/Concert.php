<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Concert_Price;


class Concert extends Model
{
    protected $table = 'concerts';
<<<<<<< HEAD
=======
    public $timestamps = false;
>>>>>>> main
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
            'concert_price',     // Correct table name
            'id_concert',        // Foreign key on pivot table for parent
            'id_seating'         // Foreign key on pivot table for related model
        )->withPivot(['id_price', 'ticket_price', 'quota', 'sold', 'status_seating']);
    }


}