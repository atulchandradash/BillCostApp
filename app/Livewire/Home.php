<?php

namespace App\Livewire;

use App\Models\Cost;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Home extends Component
{

    public $user;

    public $now;

    public $getTodayCost;

    public $tommorowDateCost;

    public $thisMonthCost;


    public function mount()
    {
        $this->user = Auth::user();

        // getTime
        date_default_timezone_set('Asia/Shanghai');
        $timezone = date_default_timezone_get();
        $this->now = Carbon::now('Asia/Shanghai');
        // --------

        // TdoayCostGet()
        $this->getTodayCost = Cost::where('userid', $this->user->id)->where('date', $this->now->format('Y-m-d'))->sum('cost');
        // $getTodayCostGet = Cost::where('userid', $this->user->id)->where('date', $this->now->format('Y-m-d'))->get();
        // ---------

        //tommorowdayCost
        $tommorowDate = $this->now->subDay()->format('Y-m-d');
        $this->tommorowDateCost = Cost::where('userid', $this->user->id)->where('date', $tommorowDate)->sum('cost');
        // ----

        //thisMonthCost
        $thisMonth = $this->now->format('m');
        $this->thisMonthCost = Cost::where('userid', $this->user->id)->WhereMonth('created_at', $thisMonth)->sum('cost');
        // ----
    }

    public function render()
    {
        return view('livewire.home');
    }
}