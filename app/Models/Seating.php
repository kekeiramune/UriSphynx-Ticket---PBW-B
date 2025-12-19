<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seating extends Model
{
    protected $table = 'seating';

    protected $fillable = [
        'name',
    ];
}
