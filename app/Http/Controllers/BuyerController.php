<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BuyerController extends Controller
{
    /* ================= DASHBOARD ================= */

    public function dashboard()
    {
        $buyerId = session('buyer_id');

        if (!$buyerId) {
            return redirect()->route('buyer.login');
        }

        $requests = DB::table('intent_requests') // ✅ FIXED
            ->where('buyer_id', $buyerId)
            ->get();

        return view('buyer.dashboard', compact('requests'));
    }

    /* ================= CREATE INTENT ================= */

    public function createIntent()
    {
        return view('buyer.create_intent');
    }

    /* ================= STORE INTENT ================= */

    public function storeIntent(Request $request)
    {
        $request->validate([
            'crop_name'         => 'required|string',
            'required_quantity' => 'required|integer',
            'required_date'     => 'required|date',
        ]);

        $requestId = DB::table('intent_requests')->insertGetId([ // ✅ FIXED
            'buyer_id'             => session('buyer_id'),
            'crop_name'            => strtolower(trim($request->crop_name)),
            'required_quantity_kg' => $request->required_quantity,
            'required_date'        => $request->required_date,
            'status'               => 'open',
            'created_at'           => now(),
            'updated_at'           => now(),
        ]);

        /* ================= AUTO MATCH ================= */

        $produces = DB::table('produces')
            ->whereRaw('LOWER(crop_name) = ?', [strtolower($request->crop_name)])
            ->where('quantity_kg', '>=', $request->required_quantity)
            ->where('status', 'available')
            ->get();

        foreach ($produces as $p) {

            $score = 50;

            $daysDiff = abs(
                strtotime($p->available_date) - strtotime($request->required_date)
            ) / 86400;

            if ($daysDiff <= 2)      $score += 30;
            else if ($daysDiff <= 5) $score += 20;
            else                     $score += 10;

            DB::table('match_results')->insert([ // ✅ FIXED
                'produce_id'  => $p->id,
                'request_id'  => $requestId,
                'match_score' => $score,
                'status'      => 'pending',
                'matched_on'  => now(),
            ]);
        }

        return redirect()->route('buyer.dashboard')
            ->with('success', 'Demand added & matched successfully');
    }

    /* ================= MATCHES ================= */

    public function matches()
    {
        $buyerId  = session('buyer_id');
        $buyerLat = session('buyer_latitude');
        $buyerLng = session('buyer_longitude');

        if (!$buyerLat || !$buyerLng) {
            return redirect()->route('buyer.dashboard')
                ->with('error', 'Buyer location not found. Please logout & login again.');
        }

        $radius = 60;

        $subQuery = DB::table('match_results') // ✅ FIXED
            ->join('intent_requests', 'match_results.request_id', '=', 'intent_requests.id') // ✅ FIXED
            ->join('produces', 'match_results.produce_id', '=', 'produces.id')
            ->join('farmers', 'produces.farmer_id', '=', 'farmers.id')
            ->select(
                'intent_requests.crop_name',
                'intent_requests.required_quantity_kg',
                'produces.quantity_kg as available_qty',
                'farmers.name as farmer_name',
                'farmers.village',
                'match_results.status',
                
                DB::raw("
                    6371 * acos(
                        cos(radians($buyerLat)) *
                        cos(radians(farmers.latitude)) *
                        cos(radians(farmers.longitude) - radians($buyerLng)) +
                        sin(radians($buyerLat)) *
                        sin(radians(farmers.latitude))
                    ) AS distance
                ")
            )
            ->where('intent_requests.buyer_id', $buyerId)
            ->whereNotNull('farmers.latitude')
            ->whereNotNull('farmers.longitude');

        $matches = DB::query()
            ->fromSub($subQuery, 't')
            ->where('distance', '<=', $radius)
            ->orderBy('distance')
            ->get();

        return view('buyer.matches', compact('matches'));
    }
}
