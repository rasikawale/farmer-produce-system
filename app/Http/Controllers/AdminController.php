<?php

namespace App\Http\Controllers;
use App\Models\Contact;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
class AdminController extends Controller
{
    /* ================= ADMIN LOGIN ================= */

    public function showLogin()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        if (
            $request->email === env('ADMIN_EMAIL') &&
            $request->password === env('ADMIN_PASSWORD')
        ) {
            session(['admin_logged_in' => true]);
            return redirect()->route('admin.dashboard');
        }
        

        return back()->with('error', 'Invalid Admin Credentials');
    }

    public function logout()
    {
        session()->forget('admin_logged_in');
        return redirect()->route('admin.login');
    }

    /* ================= DASHBOARD ================= */

public function dashboard()
{
    $farmersCount = DB::table('farmers')->count();
    $buyersCount  = DB::table('buyers')->count();
    $totalMatches = DB::table('matches')->count();
    $accepted     = DB::table('matches')->where('status','accepted')->count();

    // Match status
    $matchesByStatus = [
        'accepted' => DB::table('matches')->where('status','accepted')->count(),
        'rejected' => DB::table('matches')->where('status','rejected')->count(),
        'pending'  => DB::table('matches')->where('status','pending')->count(),
    ];

    // Monthly analytics
    $monthlyMatches = DB::table('matches')
        ->selectRaw("to_char(created_at,'Mon YYYY') as month, COUNT(*) as total")
        ->groupBy('month')
        ->orderByRaw('MIN(created_at)')
        ->get();

    // Map data
    $farmerLocations = DB::table('farmers')
        ->whereNotNull('latitude')
        ->whereNotNull('longitude')
        ->get(['name','mobile','village','latitude','longitude']);

    $buyerLocations = DB::table('buyers')
        ->whereNotNull('latitude')
        ->whereNotNull('longitude')
        ->get(['name','mobile','city','latitude','longitude']);

    // ✅ LIST DATA (THIS WAS MISSING)
    $farmersList = DB::table('farmers')->get();
    $buyersList  = DB::table('buyers')->get();

    return view('admin.dashboard', compact(
        'farmersCount',
        'buyersCount',
        'totalMatches',
        'accepted',
        'matchesByStatus',
        'monthlyMatches',
        'farmerLocations',
        'buyerLocations',
        'farmersList',
        'buyersList'   // ✅ FIXED
    ));
}






    /* ================= LISTS ================= */

    public function farmers()
{
    $farmers = DB::table('farmers')->get();
    return view('admin.farmers', compact('farmers'));
}

public function approveFarmer($id)
{
    DB::table('farmers')
        ->where('id', $id)
        ->update(['approved' => true]);

    return back()->with('success', 'Farmer approved successfully');
}



    public function buyers()
    {
        $buyers = DB::table('buyers')->get();
        return view('admin.buyers', compact('buyers'));
    }

    public function analytics()
    {
        $stats = DB::table('matches')
            ->select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->get();

        return view('admin.analytics', compact('stats'));
    }
    /* ================= CONTACT / SUPPORT ================= */

    public function contacts()
    {
        $contacts = Contact::latest()->get();
        return view('admin.contacts', compact('contacts'));
    }

    public function replyContact(Request $request, $id)
    {
        $request->validate([
            'admin_reply' => 'required'
        ]);

        Contact::where('id', $id)->update([
            'admin_reply' => $request->admin_reply,
            'status' => 'replied',
            'replied_at' => now()
        ]);

        return back()->with('success', 'Reply sent successfully');
    }


}
