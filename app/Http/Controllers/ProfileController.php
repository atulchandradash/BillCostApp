<?php

namespace App\Http\Controllers;

use App\Models\Cost;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    //

    public function profile()
    {
        $user = Auth::user();

        // getTime
        date_default_timezone_set('Asia/Shanghai');
        $timezone = date_default_timezone_get();
        $now = Carbon::now('Asia/Shanghai');
        // --------

        // TdoayCostGet()
        $getTodayCost = Cost::where('userid', $user->id)->where('date', $now->format('Y-m-d'))->sum('cost');
        // ---------

        return view('profile', compact('user', 'getTodayCost'));
    }


    public function update(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required'
        ]);

        $user = Auth::user();

        $user->name = $request->input('name');
        $user->email = $request->input('email');

        $user->save();

        return redirect()->route('profile')->with('success', "Profile Updated");
    }
}