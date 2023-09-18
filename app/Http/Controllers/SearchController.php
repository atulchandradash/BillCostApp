<?php

namespace App\Http\Controllers;

use App\Models\Cost;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    //
    public function index()
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

        return view('search', compact('user', 'getTodayCost'));
    }

    public function searchResult(Request $request)
    {

        $request->validate([
            'month' => 'required'
        ]);

        $month = $request->input('month');


        $mounthCostShow = Cost::Where('userid', Auth::user()->id)->WhereMonth('created_at', $month)->get();

        $mounthTotalCost = Cost::Where('userid', Auth::user()->id)->WhereMonth('created_at', $month)->sum('cost');

        $datas = [
            'monthCosts' => $mounthCostShow,
            'totalCost' => $mounthTotalCost
        ];


        return back()->with($datas)->withInput();


    }
}