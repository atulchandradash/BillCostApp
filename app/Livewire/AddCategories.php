<?php

namespace App\Livewire;

use App\Models\Categorie;
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

        // categoriesShow()
        $this->categoriesShow = Categorie::where('userid', 'ALL')->orWhere('userid', $this->user->id)->get();
        // ------

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