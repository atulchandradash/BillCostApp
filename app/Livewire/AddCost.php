<?php

namespace App\Livewire;

use App\Models\Categorie;
use App\Models\Cost;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;


class AddCost extends Component
{

    //all the input Fields
    public $cost, $categories_id = '1', $date, $userid;

    //all the Edit input Fields
    public $cost_id, $edit_cost, $edit_categories_id = '1', $edit_date;

    public function addCost()
    {
        $this->validate([
            'userid' => 'required',
            'categories_id' => 'required',
            'date' => 'required',
            'cost' => 'required|numeric|between:1,100000'

        ]);


        $data = new Cost();
        $data->userid = $this->userid;
        $data->categories_id = $this->categories_id;
        $data->date = $this->date;
        $data->cost = $this->cost;

        $data->save();

        $this->dispatch('successAlert', 'Cost added successfully!');

        $this->cost = '';
    }

    public function openModal($id)
    {
        $data = Cost::where('userid', $this->userid)->Where('id', $id)->First();

        $this->edit_categories_id = $data->categories_id;
        $this->edit_date = $data->date;
        $this->edit_cost = $data->cost;

        $this->cost_id = $data->id;


    }


    public function editCost()
    {
        $this->validate([
            'edit_categories_id' => 'required',
            'edit_date' => 'required',
            'edit_cost' => 'required|numeric|between:1,100000'
        ]);

        $data = Cost::where('userid', $this->userid)->Where('id', $this->cost_id)->First();

        // dd($data);

        $data->userid = $this->userid;
        $data->categories_id = $this->edit_categories_id;
        $data->date = $this->edit_date;
        $data->cost = $this->edit_cost;

        $data->save();

        $this->dispatch('successAlert', 'Cost Edited Successfully!');

        $this->editClose();

    }

    public function editClose()
    {
        $this->cost_id = '';
        $this->edit_categories_id = '';
        $this->edit_date = '';
        $this->edit_cost = '';

    }

    public function deleteCost($id)
    {
        if (isset($id)) {
            $deleteData = Cost::find($id);
            $deleteData->delete();

            $this->dispatch('successAlert', "Cost Delete successfully!");
        }
    }

    public function render()
    {

        // getTime
        date_default_timezone_set('Asia/Shanghai');
        $timezone = date_default_timezone_get();
        $now = Carbon::now('Asia/Shanghai');
        // --------

        $user = Auth::user();
        //set the user id on the input fileds
        $this->userid = $user->id;

        //set the date in input fileds
        $this->date = date('Y-m-d');


        // show the categories in form
        $categoriesShow = Categorie::where('userid', 'ALL')->orWhere('userid', $user->id)->get();
        // ------

        //get Last Record
        $costRecord = Cost::Where('userid', $user->id)->latest()->limit(5)->get();
        //-----



        // TdoayCostGet()
        $getTodayCost = Cost::where('userid', $user->id)->where('date', $now->format('Y-m-d'))->sum('cost');
        // ---------

        return view('livewire.add-cost', [
            'costRecord' => $costRecord,
            'getTodayCost' => $getTodayCost,
            'user' => $user,
            'categoriesShow' => $categoriesShow
        ]);
    }


}