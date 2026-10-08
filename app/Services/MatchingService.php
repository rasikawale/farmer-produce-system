<?php

namespace App\Services;

use App\Models\IntentRequest;
use App\Models\Produce;

class MatchingService
{
    public function matchIntent(IntentRequest $intent)
    {
        return Produce::where('crop_name', $intent->crop_name)
            ->where('quantity_kg', '>=', $intent->required_quantity)
            ->orderByRaw('ABS(quantity_kg - ?)', [$intent->required_quantity])
            ->orderBy('harvest_date', 'desc') // freshness priority
            ->get();
    }
}
