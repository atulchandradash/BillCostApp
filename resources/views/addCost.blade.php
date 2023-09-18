@extends ('layout.layout')

@section('content')
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
        <h3>Add Cost</h3>
        <br>
        <br>
            <div class="col">
                <form method="POST" action="{{route('addCost')}}" >
                    @csrf
                    <div class="input-group mb-3">
                        <label style="color: #a2a2a2" class="input-group-text" for="selectOption">Cost Categories</label>
                        <select class="form-control" id="selectOption" name="categories_id">
                            @foreach( $categoriesShow as $optionValue)
                                <option  style="color: #a2a2a2" value="{{ $optionValue->id }}">{{ $optionValue->categorie_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <label style="color: #a2a2a2" class="input-group-text" for="current-fullday">Date</label>
                        <input name="date" type="date" class="form-control" id="current-fullday" name="shortDescription" value="{{ date('Y-m-d') }}">
                    </div>
                    <div class="input-group mb-3">
                        <label style="color: #a2a2a2" class="input-group-text" for="totalCost">Cost</label>
                        <input name="cost" type="number" class="form-control" id="totalCost" name="totalCost">
                    </div>
                    <input type="hidden" name="userid" value="{{$user->id}}">
                    <button type="submit" class="btn btn-success">Add Cost</button>
                </form>
            </div>
        </div>

           <hr>

    @foreach ($costRecord as $data)
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
                <form style="display: inline-flex" action="/deleteCost/{{$data->id}}" method="POST" >
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-light"><i style="color: #a2a2a2" class="bi bi-trash3"></i></button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
    </div>

 

@endsection
