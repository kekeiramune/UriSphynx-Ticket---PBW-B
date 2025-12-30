<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seating extends Model
{
    protected $table = 'seating';
<<<<<<< HEAD
    protected $primaryKey = 'id_seating';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'name_seating',
    ];
     public function prices()
    {
        return $this->hasMany(Concert_Price::class, 'id_seating');
    }
=======

    protected $fillable = [
        'name',
    ];
>>>>>>> be5e30b4674e3d786da31ab2198c4a1d96e2effa
}
