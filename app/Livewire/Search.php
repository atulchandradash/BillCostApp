<?php

namespace App\Livewire;

use App\Models\Cost;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Search extends Component
{
    public $user;

    public $now;

    public $getTodayCost;

    public $month = 1;

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
        return view('livewire.search');
    }


    public function search()
    {

        $mounthCostShow = Cost::Where('userid', Auth::user()->id)->WhereMonth('created_at', $this->month)->get();

        $mounthTotalCost = Cost::Where('userid', Auth::user()->id)->WhereMonth('created_at', $this->month)->sum('cost');

        session()->flash('monthCosts', $mounthCostShow);
        session()->flash('totalCost', $mounthTotalCost);



    }

    public function deleteCost($id)
    {
        if (isset($id)) {
            $data = Cost::find($id);
            $data->delete();

            $this->dispatch('successAlert', "Cost Delete successfully!");

            $this->search();
        }
    }
}