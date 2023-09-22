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
        <div class="alert alert-success">
            {{session('success')}}
        </div>
    @endif

    @if($errors->any())
              @foreach ($errors->all() as $error)
                 <div class="alert alert-danger">
                    {{ $error }}
                </div>
              @endforeach
    @endif

    <div class="row mt-3">
        <h3>Search</h3>
        <br>
        <br>
            <div class="col">
                <form method="POST" wire:submit.prevent="search()" >
                    @csrf
                    <div class="input-group mb-3">
                        <label style="color: #a2a2a2" class="input-group-text" for="selectOption">Month</label>
                        <select wire:model="month" class="form-control" id="selectOption">
                            <option value="01" {{ old('month') == '01' ? 'selected' : '' }}>January</option>
                            <option value="02" {{ old('month') == '02' ? 'selected' : '' }}>February</option>
                            <option value="03" {{ old('month') == '03' ? 'selected' : '' }}>March</option>
                            <option value="04" {{ old('month') == '04' ? 'selected' : '' }}>April</option>
                            <option value="05" {{ old('month') == '05' ? 'selected' : '' }}>May</option>
                            <option value="06" {{ old('month') == '06' ? 'selected' : '' }}>June</option>
                            <option value="07" {{ old('month') == '07' ? 'selected' : '' }}>July</option>
                            <option value="08" {{ old('month') == '08' ? 'selected' : '' }}>August</option>
                            <option value="09" {{ old('month') == '09' ? 'selected' : '' }}>September</option>
                            <option value="10" {{ old('month') == '10' ? 'selected' : '' }}>October</option>
                            <option value="11" {{ old('month') == '11' ? 'selected' : '' }}>November</option>
                            <option value="12" {{ old('month') == '12' ? 'selected' : '' }}>December</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success">Search</button>
                </form>
            </div>
        </div>

   
    @if(session('monthCosts'))
         <hr>
        @if(session('totalCost') !== 0)
                @foreach (session('monthCosts') as $data)
                <div style="border:2px solid black; margin: 1% 0;padding:5px" class="row justify-content-between align-items-center">
                    <div class="col-md-auto ">
                        <div class="d-flex justify-content-between align-items-center"> 
                            <h4 class="" style="color: #a2a2a2">{{$data->categorie->categorie_name}}-></h4>
                            <h5  class="" style="color: #a2a2a2;">Cost: {{$data->cost}}</h5>
                        </div>
                    </div>
                    <div class="col-md-auto  mt-2 mt-md-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <span style="color: #a2a2a2">{{$data->date}}</span>
                             <button wire:click="deleteCost({{$data->id}})" class="btn btn-light"><i style="color: #a2a2a2" class="bi bi-trash3"></i></button>
                        </div>
                    </div>
                </div>
            @endforeach
                <hr>
                <h5  class="" style="color: #a2a2a2;">Total Cost: {{session('totalCost')}}</h5>

            @else 
                 <h5  class="" style="color: #a2a2a2;">No Cost Found</h5>

        @endif

        
    @endif
