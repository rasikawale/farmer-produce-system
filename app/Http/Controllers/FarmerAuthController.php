<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class FarmerAuthController extends Controller
{
    // Show Register Form
    public function showRegister()
    {
        return view('farmer.register');
    }

    // Register Farmer
    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required',
            'mobile'   => 'required|unique:farmers,mobile',
            'village'  => 'required',
            'password' => 'required|min:6',
        ]);
      


        DB::table('farmers')->insert([
            'name'              => $request->name,
            'mobile'            => $request->mobile,
            'village'           => $request->village,
            'password'          => Hash::make($request->password),
            'latitude' => $request->latitude,
    'longitude' => $request->longitude,
            'status'            => 'pending',
            'approved'          => false,
            'reliability_score' => 0,
            'created_at'        => now(),
            'updated_at'        => now(),
        ]);

        return redirect()->route('farmer.login')
            ->with('success', 'Registration successful. Waiting for admin approval.');
    }

    // Show Login Form
    public function showLogin()
    {
        return view('farmer.login');
    }

    // Login Farmer
    public function login(Request $request)
{
    $request->validate([
        'mobile' => 'required',
        'password' => 'required',
    ]);

    $farmer = DB::table('farmers')
        ->where('mobile', $request->mobile)
        ->first();

    if (!$farmer || !Hash::check($request->password, $farmer->password)) {
        return back()->with('error', 'Invalid mobile or password');
    }

    session([
        'farmer_id'   => $farmer->id,
        'farmer_name' => $farmer->name,
    ]);


    return redirect()->route('farmer.dashboard');
}


    // Logout
    public function logout()
    {
        Session::forget(['farmer_id', 'farmer_name']);
        return redirect()->route('farmer.login');
    }
}
