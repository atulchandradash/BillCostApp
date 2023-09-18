<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Cost;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Vtiful\Kernel\Format;

class HomeController extends Controller
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
        $getTodayCostGet = Cost::where('userid', $user->id)->where('date', $now->format('Y-m-d'))->get();
        // ---------

        //tommorowdayCost
        $tommorowDate = $now->subDay()->format('Y-m-d');
        $tommorowDateCost = Cost::where('userid', $user->id)->where('date', $tommorowDate)->sum('cost');
        // ----

        //thisMonthCost
        $thisMonth = $now->format('m');
        $thisMonthCost = Cost::where('userid', $user->id)->WhereMonth('created_at', $thisMonth)->sum('cost');
        // ----

        $categoriesShow = Categorie::where('userid', 'ALL')->orWhere('userid', $user->id)->get();




        return view(
            'home',
            compact(
                'user',
                'timezone',
                'now',
                'getTodayCost',
                'getTodayCostGet',
                'categoriesShow',
                'tommorowDateCost',
                'thisMonthCost'
            )
        );
    }

    public function addCost(Request $request)
    {
        $data = $request->validate([
            'userid' => 'required',
            'cost' => 'required',
            'date' => 'required',
            'categories_id' => 'required'

        ]);

        if (Cost::create($data)) {
            return redirect()->back();
        } else {
            return redirect()->back()->with("error", "Having Some issues!!");
        }

    }

    public function deleteCost($id)
    {
        $data = Cost::find($id);

        if ($data) {
            $data->delete();
            return redirect()->route('welcome');
        }
    }

    public function addcCategories()
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

        $getCategories = Categorie::where('userid', $user->id)->get();

        return view('addcCategories', compact('user', 'getTodayCost', 'getCategories'));
    }


    public function addCategoriePost(Request $request)
    {
        $data = $request->validate([
            'categorie_name' => 'required',
            'userid' => 'required'
        ]);

        if (Categorie::create($data)) {
            return redirect()->route('addcCategories')->with('success', "Categories Added Successfully");
        }


    }


    public function deleteCategories($id)
    {
        $data = Categorie::find($id);

        if ($data) {
            $data->delete();
            return redirect()->route('addcCategories')->with('success', "Categories Delete Succesfully");
        }
    }

    public function addCostPage()
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

        // categoriesShow()
        $categoriesShow = Categorie::where('userid', 'ALL')->orWhere('userid', $user->id)->get();
        // ------

        //get Last Record
        $costRecord = Cost::Where('userid', $user->id)->latest()->limit(5)->get();
        //-----



        return view('addCost', compact('user', 'getTodayCost', 'categoriesShow', 'costRecord'));
    }
}