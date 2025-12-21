<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seating extends Model
{
    protected $table = 'seating';
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
}
