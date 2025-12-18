<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seating extends Model
{
    protected $table = 'seat_types';

    protected $fillable = [
        'name',
    ];
}
