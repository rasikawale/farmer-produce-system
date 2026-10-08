<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FarmerController extends Controller
{
    /* ================= DASHBOARD ================= */
public function dashboard()
{
    $farmerId = session('farmer_id');
$produces = DB::table('produces')
    ->where('farmer_id', session('farmer_id'))
    ->get();

$matches = DB::table('matches')
    ->join('buyer_requests', 'matches.request_id', '=', 'buyer_requests.id')
    ->join('buyers', 'buyer_requests.buyer_id', '=', 'buyers.id')
    ->join('produces', 'matches.produce_id', '=', 'produces.id')
    ->where('produces.farmer_id', session('farmer_id'))
    ->select(
        'matches.id as match_id',
        'matches.status',
        'matches.match_score',
        'buyer_requests.crop_name',
        'buyer_requests.required_quantity_kg',
        'buyer_requests.required_date',
        'buyers.name as buyer_name',
        'buyers.mobile'
    )
    ->get();



    return view('farmer.dashboard', compact('produces', 'matches'));
}




    /* ================= ADD PRODUCE FORM ================= */
    public function produce()
    {
        return view('farmer.produce');
    }

    /* ================= STORE PRODUCE ================= */
    public function storeProduce(Request $request)
    {
        $request->validate([
            'crop_name'     => 'required',
            'quantity_kg'   => 'required|integer',
            'harvest_date'  => 'required|date',
            'available_date'=> 'required|date',
        ]);

  DB::table('produces')->insert([
    'farmer_id'      => session('farmer_id'),
    'crop_name'      => strtolower(trim($request->crop_name)),
    'quantity_kg'    => $request->quantity_kg,
    'harvest_date'   => $request->harvest_date,
    'available_date' => $request->harvest_date, // 🔥 VERY IMPORTANT
    'status'         => 'available',
    'created_at'     => now(),
    'updated_at'     => now(),
]);





        return redirect()->route('farmer.dashboard')
            ->with('success', 'Produce added successfully');
    }

    /* ================= ACCEPT MATCH ================= */
public function acceptMatch($id)
{
    $match = DB::table('matches')->where('id',$id)->first();

    DB::table('matches')
        ->where('id',$id)
        ->update(['status'=>'accepted']);

    // 🔼 Increase farmer reliability
    $produce = DB::table('produces')->where('id',$match->produce_id)->first();

    DB::table('farmers')
        ->where('id',$produce->farmer_id)
        ->increment('reliability_score', 5);

    return back()->with('success','Match Accepted');
}




    /* ================= REJECT MATCH ================= */
    public function rejectMatch($id)
    {
        DB::table('matches')
            ->where('id', $id)
            ->update(['status' => 'rejected']);

        return back()->with('success', 'Match rejected');
    }
}
