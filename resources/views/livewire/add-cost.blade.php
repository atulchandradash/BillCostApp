    <div class="col-md-6 main">
        <h2 class="text-center">BillCostApp</h2>
        <div>
            <div class="row justify-content-between align-items-center">
                <div class="col-auto">
                    <h5 class="">Hi {{ $user->name }} </h5>
                </div>
                @include('layout.menubar')
            </div>
            <div>
                <span style="color: #a2a2a2">Today Cost: {{ $getTodayCost }}</span>
            </div>
        </div>
        <hr>

        @if (session()->has('message'))
            <div class="alert alert-{{ session('messageType') }}">
                {{ session('message') }}
            </div>
        @endif

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger">
                    {{ $error }}
                </div>
            @endforeach
        @endif

        <div class="row mt-3">
            <h3>Add Cost</h3>
            <br>
            <br>
            <div class="col">
                <form wire:submit.prevent="addCost" wire:loading.attr="disabled">
                    <div class="input-group mb-3">
                        <label style="color: #a2a2a2" class="input-group-text" for="selectOption">Cost
                            Categories</label>
                        <select wire:model="categories_id" class="form-control" id="selectOption">
                            @foreach ($categoriesShow as $optionValue)
                                <option style="color: #a2a2a2" value="{{ $optionValue->id }}">
                                    {{ $optionValue->categorie_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <label style="color: #a2a2a2" class="input-group-text" for="current-fullday">Date</label>
                        <input wire:model="date" type="date" class="form-control" id="current-fullday"
                            value="">
                    </div>
                    <div class="input-group mb-3">
                        <label style="color: #a2a2a2" class="input-group-text" for="totalCost">Cost</label>
                        <input wire:model='cost' type="float" class="form-control" id="totalCost">
                        <input wire:model='userid' hidden type="number" class="form-control">
                    </div>

                    <button type="submit" class="btn btn-success">Add Cost</button>
                </form>
            </div>


            <div>
                <hr>
                @foreach ($costRecord as $data)
                    <div style="border:2px solid black; margin: 1% 0;padding:5px"
                        class="row justify-content-between align-items-center">
                        <div class="col-md-auto ">
                            <div class="d-flex justify-content-between align-items-center">
                                <h4 class="" style="color: #a2a2a2">{{ $data->categorie->categorie_name }}-></h4>
                                <h5 class="" style="color: #a2a2a2;">Cost: {{ $data->cost }}</h5>
                            </div>
                        </div>
                        <div class="col-md-auto  mt-2 mt-md-0">
                            <div class="d-flex justify-content-between align-items-center">
                                <span style="color: #a2a2a2">{{ $data->date }}</span>
                                <div style="display: inline-flex">
                                    <button wire:click="openModal({{ $data->id }})" data-bs-toggle="modal"
                                        data-bs-target="#myModal" class="btn btn-light"><i style="color: #a2a2a2"
                                            class="bi bi-pencil-square"></i></button>
                                    <button wire:click="deleteCost({{ $data->id }})" class="btn btn-light"><i
                                            style="color: #a2a2a2" class="bi bi-trash3"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Modal -->
            <div wire:ignore.self class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Cost</h5>
                            <button type="button" wire:click="editClose()" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form wire:submit.prevent="editCost">
                                <div class="input-group mb-3">
                                    <label style="color: #a2a2a2" class="input-group-text" for="selectOption">Cost
                                        Categories</label>
                                    <select wire:model="edit_categories_id" class="form-control" id="selectOption">
                                        @foreach ($categoriesShow as $optionValue)
                                            <option style="color: #a2a2a2" value="{{ $optionValue->id }}">
                                                {{ $optionValue->categorie_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="input-group mb-3">
                                    <label style="color: #a2a2a2" class="input-group-text"
                                        for="current-fullday">Date</label>
                                    <input wire:model="edit_date" type="date" class="form-control"
                                        id="current-fullday" value="">
                                </div>
                                <div class="input-group mb-3">
                                    <label style="color: #a2a2a2" class="input-group-text"
                                        for="totalCost">Cost</label>
                                    <input wire:model='edit_cost' type="float" class="form-control"
                                        id="totalCost">
                                    <input wire:model='cost_id' hidden type="number" class="form-control">
                                </div>
                                <button type="button" wire:click="editClose()" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Close</button>
                                <button type="submit" data-bs-dismiss="modal" class="btn btn-success">Edit
                                    Cost</button>
                            </form>
                        </div>
                    </div>
                </div>


            </div>
