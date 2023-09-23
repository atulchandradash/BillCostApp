<div class="col-md-6 main">
    <h2 class="text-center">BillCostApp</h2>
    <div>
       <div class="row justify-content-between align-items-center">
            <div class="col-auto">
                <h5 class="">Hi {{$user->name}}</h5>
            </div>
            @include('layout.menubar')
        </div>

        <div>
            <span  style="color: #a2a2a2">Today Cost: {{$getTodayCost}}</span>
        </div>

    </div>
    <hr>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{session('success')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

     <div class="row mt-3">
        <h3>Add Categories</h3>
        <br>
        <br>
            <div class="col">
                <form wire:submit.prevent="addCate()" >
                    <div class="input-group mb-3">
                        <label style="color: #a2a2a2" class="input-group-text" for="current-fullday">Categories Name</label>
                        <input wire:model="categorie_name" required type="name" class="form-control" id="current-fullday">
                    </div>
                    <button type="submit" class="btn btn-success">Add Categories</button>
                </form>
            </div>
        </div>

    <hr>
    @foreach ($getCategories as $data)
    <div style="border:2px solid black; margin: 1% 0;padding:5px" class="row justify-content-between align-items-center ">
        <div class="col-md-auto ">
            <div class="d-flex justify-content-between align-items-center"> 
                <h5 class="" style="color: #a2a2a2">{{$data->categorie_name}}</h5>
            </div>
        </div>
        <div class="col-md-auto  mt-2 mt-md-0">
            <div class="d-flex justify-content-between align-items-center">
                <button wire:click="openModal({{$data->id}})" data-bs-toggle="modal" data-bs-target="#myModal"  class="btn btn-light"><i style="color: #a2a2a2" class="bi bi-pencil-square"></i></button>
            </div>
        </div>
    </div>
    @endforeach


    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Categories</h5>
            <button type="button" class="btn-close" wire:click="editClose()" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
           <form wire:submit.prevent="editCate()" >
                    <div class="input-group mb-3">
                        <label style="color: #a2a2a2" class="input-group-text" for="current-fullday">Categories Name</label>
                        <input wire:model="editCategorie_name" required type="name" class="form-control" id="current-fullday">
                        <input wire:model="editid"  required type="hidden" class="form-control" id="current-fullday">
                    </div>
                    <button type="submit" data-bs-dismiss="modal" class="btn btn-success">Edit Categories</button>
                    <button type="button" wire:click="editClose()" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </form>
        </div>
        </div>
    </div>
    </div>

