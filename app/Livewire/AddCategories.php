<?php

namespace App\Livewire;

use App\Models\Categorie;
use App\Models\Cost;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AddCategories extends Component
{
    public $user;
    public $getTodayCost;


    public $getCategories;

    public $categorie_name;


    public $editCategorie_name;

    public $editid;


    public function mount()
    {
        $this->user = Auth::user();

        // getTime
        date_default_timezone_set('Asia/Shanghai');
        $timezone = date_default_timezone_get();
        $now = Carbon::now('Asia/Shanghai');
        // --------

        // TdoayCostGet()
        $this->getTodayCost = Cost::where('userid', $this->user->id)->where('date', $now->format('Y-m-d'))->sum('cost');
        // ---------

        $this->getCate();
    }
    public function render()
    {
        return view('livewire.add-categories');
    }

    public function addCate()
    {

        $data = [
            'categorie_name' => $this->categorie_name,
            'userid' => $this->user->id
        ];


        Categorie::create($data);

        $this->dispatch('successAlert', "Add Categories Done");

        $this->getCate();

        $this->categorie_name = "";


    }


    public function getCate()
    {
        $this->getCategories = Categorie::where('userid', $this->user->id)->get();
    }

    public function openModal($id)
    {
        $data = Categorie::where('userid', $this->user->id)->Where('id', $id)->First();

        $this->editCategorie_name = $data->categorie_name;

        $this->editid = $id;

    }


    public function editCate()
    {
        $data = Categorie::where('userid', $this->user->id)->Where('id', $this->editid)->First();

        $data->categorie_name = $this->editCategorie_name;
        $data->save();

        $this->dispatch('successAlert', "Edit Categories Done");

        $this->editCategorie_name = '';
        $this->editid = '';

        $this->getCate();

    }


    public function editClose()
    {
        $this->editCategorie_name = '';
        $this->editid = '';


    }



}