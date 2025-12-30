<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
<<<<<<< HEAD
    protected $table = 'category';
    protected $primaryKey = 'idgroup';
=======
>>>>>>> be5e30b4674e3d786da31ab2198c4a1d96e2effa
    protected $fillable = [
        'groupname',
        'type',
        'debut',
        'agency',
        'popular'
    ];
<<<<<<< HEAD

    public function concerts()
    {
        return $this->hasMany(Concert::class, 'idgroup', 'idgroup');
    }
=======
>>>>>>> be5e30b4674e3d786da31ab2198c4a1d96e2effa
}