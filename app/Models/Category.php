<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';
    protected $primaryKey = 'idgroup';
    protected $fillable = [
        'groupname',
        'type',
        'debut',
        'agency',
        'popular'
    ];

    public function concerts()
    {
        return $this->hasMany(Concert::class, 'idgroup', 'idgroup');
    }
}