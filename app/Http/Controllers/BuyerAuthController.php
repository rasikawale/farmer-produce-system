<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class BuyerAuthController extends Controller
{
    /* ================= REGISTER ================= */

    public function showRegister()
    {
        return view('buyer.register');
    }

    public function register(Request $request)
    {
        // ✅ VALIDATION (GPS NOT REQUIRED)
        $request->validate([
            'name'       => 'required|string|max:100',
            'mobile'     => 'required|string|max:15|unique:buyers,mobile',
            'buyer_type' => 'required|string',
            'city'       => 'required|string|max:100',
            'password'   => 'required|min:6',
        ]);

        // ✅ CITY → COORDINATE FALLBACK
        $cityCoords = [
            'pune'       => [18.5204, 73.8567],
            'sangamner'  => [19.5678, 74.2115],
            'mumbai'     => [19.0760, 72.8777],
            'nashik'     => [19.9975, 73.7898],
        ];

        $lat = $request->latitude;
        $lng = $request->longitude;

        // If GPS denied or unavailable
        if (!$lat || !$lng) {
            $city = strtolower(trim($request->city));

            if (isset($cityCoords[$city])) {
                [$lat, $lng] = $cityCoords[$city];
            } else {
                // Default safe location (Pune)
                $lat = 18.5204;
                $lng = 73.8567;
            }
        }

        // ✅ INSERT (NO NULL VALUES EVER)
        DB::table('buyers')->insert([
            'name'       => $request->name,
            'mobile'     => $request->mobile,
            'buyer_type' => $request->buyer_type,
            'city'       => $request->city,
            'password'   => Hash::make($request->password),
            'latitude'   => $lat,
            'longitude'  => $lng,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('buyer.login')
            ->with('success', 'Buyer registered successfully');
    }

    /* ================= LOGIN ================= */

    public function showLogin()
    {
        return view('buyer.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'mobile'   => 'required',
            'password' => 'required',
        ]);

        $buyer = DB::table('buyers')
            ->where('mobile', $request->mobile)
            ->first();

        if (!$buyer || !Hash::check($request->password, $buyer->password)) {
            return back()->with('error', 'Invalid mobile or password');
        }

        // ✅ STORE LOCATION IN SESSION
        Session::put('buyer_id', $buyer->id);
        Session::put('buyer_name', $buyer->name);
        Session::put('buyer_latitude', $buyer->latitude);
        Session::put('buyer_longitude', $buyer->longitude);
        

        return redirect()->route('buyer.dashboard');
    }

    /* ================= LOGOUT ================= */

    public function logout()
    {
        Session::forget([
            'buyer_id',
            'buyer_name',
            'buyer_latitude',
            'buyer_longitude'
        ]);

        return redirect()->route('buyer.login');
    }
}
