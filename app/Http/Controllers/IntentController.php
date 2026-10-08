<?php

namespace App\Http\Controllers;

use App\Models\IntentRequest;
use App\Services\MatchingService;

class IntentController extends Controller
{
    protected $matcher;

    public function __construct(MatchingService $matcher)
    {
        $this->matcher = $matcher;
    }

    public function showMatches($id)
{
    $intent = DB::table('buyer_requests')->where('id', $id)->first();

    if (!$intent) {
        return back()->with('error', 'Request not found');
    }

    $matches = DB::table('produces')
        ->join('farmers', 'produces.farmer_id', '=', 'farmers.id')
        ->where('produces.crop_name', $intent->crop_name)
        ->where('produces.quantity_kg', '>=', $intent->required_quantity_kg)
        ->orderByRaw('ABS(produces.quantity_kg - ?)', [$intent->required_quantity_kg])
        ->orderBy('produces.harvest_date', 'desc')
        ->select(
            'farmers.name',
            'farmers.village',
            'produces.crop_name',
            'produces.quantity_kg',
            'produces.harvest_date'
        )
        ->get();

    return view('buyer.matches', compact('intent', 'matches'));
}
}
