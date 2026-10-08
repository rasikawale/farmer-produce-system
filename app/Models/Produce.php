<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Produce extends Model
{
    protected $fillable = ['farmer_id','crop_name','quantity_kg','harvest_date'];

    public function farmer()
    {
        return $this->belongsTo(Farmer::class);
    }
}

