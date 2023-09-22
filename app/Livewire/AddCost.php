<?php

namespace App\Livewire;

use App\Models\Categorie;
use App\Models\Cost;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AddCost extends Component
{
    public $user;
    public $getTodayCost;

    public $categoriesShow;
    public $costRecord;

    ////

    public $btn = true;
    //form
    public $cost;
    public $categories_id = '1';
    public $date;

    public $userid;



    public function addCost()
    {

        if ($this->cost != 0) {
            $data = $this->validate([
                'userid' => 'required',
                'categories_id' => 'required',
                'date' => 'required',
                'cost' => 'required'
            ]);
            Cost::create($data);

            $this->dispatch('successAlert', 'Cost added successfully!');

            $this->cost = '';
            $this->costRecord();
        } else {

            session()->flash('message', 'Cost should not be 0 Or Blank');
            session()->flash('messageType', 'danger');
        }
    }

    public function costRecord()
    {
        //get Last Record
        $this->costRecord = Cost::Where('userid', $this->user->id)->latest()->limit(5)->get();
        //-----

        // getTime
        date_default_timezone_set('Asia/Shanghai');
        $timezone = date_default_timezone_get();
        $now = Carbon::now('Asia/Shanghai');

        // --------

        // TdoayCostGet()
        $this->getTodayCost = Cost::where('userid', $this->user->id)->where('date', $now->format('Y-m-d'))->sum('cost');
        // ---------

    }

    public function deleteCost($id)
    {
        if (isset($id)) {
            $data = Cost::find($id);
            $data->delete();

            $this->dispatch('successAlert', "Cost Delete successfully!");

            $this->costRecord();
        }
    }

    public function mount()
    {
        $this->user = Auth::user();

        $this->userid = $this->user->id;


        // categoriesShow()
        $this->categoriesShow = Categorie::where('userid', 'ALL')->orWhere('userid', $this->user->id)->get();
        // ------

        $this->costRecord();

        $this->date = date('Y-m-d');
    }

    public function render()
    {

        return view('livewire.add-cost');
    }


}