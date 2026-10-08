<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Farmer extends Model
{
    protected $table = 'farmers';

    protected $fillable = [
        'name',
        'mobile',
        'village',
        'taluka',
        'district',
        'latitude',
        'longitude',
        'password',
        'status',
        'approved',
        'reliability_score'
    ];

    protected $hidden = [
        'password',
    ];
}
