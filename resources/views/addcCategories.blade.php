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

    </div>
    <hr>
    <div class="row justify-content-between align-items-center">
        <div class="col-auto">
            <h4>Today Cost</h4>
        </div>
        <div class="col-auto">
            <span id="current-fullday" style="color: #a2a2a2">{{$now->format('Y-m-d')}}</span>
            <span id="current-day" style="color: #a2a2a2">{{ $now->format('l') }}</span>
        </div>
        <div>
            <h5>{{$getTodayCost}} &#xA5</h5>
        </div>
    </div>
    <hr>

    @if(session('success'))
        <div class="alert alert-success">
            {{session('success')}}
        </div>
    @endif

     @foreach ($getCategories as $data)
    <div style="border:2px solid black; margin: 1% 0;padding:5px" class="row justify-content-between align-items-center ">
        <div class="col-md-auto ">
            <div class="d-flex justify-content-between align-items-center"> 
                <h4 class="" style="color: #a2a2a2">{{$data->categorie_name}}</h4>
            </div>
        </div>
        <div class="col-md-auto  mt-2 mt-md-0">
            <div class="d-flex justify-content-between align-items-center">
                <form style="display: inline-flex" action="/addCategories/{{$data->id}}" method="POST" >
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-light"><i style="color: #a2a2a2" class="bi bi-trash3"></i></button>
                </form>
            </div>
        </div>
    </div>
    @endforeach

     <div class="row mt-5">
        <h3>Add Categories</h3>
        <br>
        <br>
            <div class="col">
                <form method="POST" action="{{route('addCategoriePost')}}" >
                    @csrf
                    <div class="input-group mb-3">
                        <label style="color: #a2a2a2" class="input-group-text" for="current-fullday">Name</label>
                        <input name="categorie_name" type="name" class="form-control" id="current-fullday" name="shortDescription">
                    </div>
                    <input type="hidden" name="userid" value="{{$user->id}}">
                    <button type="submit" class="btn btn-success">Add Categories</button>
                </form>
            </div>
        </div>

   
     {{-- tryagain3--}}

@endsection
