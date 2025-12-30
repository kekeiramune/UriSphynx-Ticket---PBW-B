<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
<<<<<<< HEAD
use App\Models\Concert_Price;


class Concert extends Model
{
    protected $table = 'concerts';
=======

class Concert extends Model
{
>>>>>>> be5e30b4674e3d786da31ab2198c4a1d96e2effa
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
<<<<<<< HEAD
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


=======
        return $this->belongsTo(Category::class);
    }
>>>>>>> be5e30b4674e3d786da31ab2198c4a1d96e2effa
}