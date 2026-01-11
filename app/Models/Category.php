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
        return $this->hasMany(Concert::class, 'category_id', 'idgroup');
    }

    public function latestConcert()
    {
        return $this->hasOne(Concert::class, 'category_id', 'idgroup')->latestOfMany('concert_date');
    }
}