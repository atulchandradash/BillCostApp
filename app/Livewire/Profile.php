<?php

namespace App\Livewire;

use App\Models\Cost;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Profile extends Component
{
    public $user;

    public $now;

    public $getTodayCost;


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
        // ---------
    }

    public function render()
    {
        return view('livewire.profile');
    }
}