<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Buyer extends Model
{
    public function intents()
    {
        return $this->hasMany(IntentRequest::class);
    }
}

