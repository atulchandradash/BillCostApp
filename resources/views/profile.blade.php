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

    @if($errors->any())
              @foreach ($errors->all() as $error)
                 <div class="alert alert-danger">
                    {{ $error }}
                </div>
              @endforeach
    @endif

    <div class="row mt-3">
        <h3>Profile</h3>
        <br>
        <br>
            <div class="col">
                <form method="POST" action="{{route('profile.update')}}" >
                    @csrf
                    @method('PUT')
                    <div class="input-group mb-3">
                        <label style="color: #a2a2a2" class="input-group-text" for="current-fullday">Name</label>
                        <input name="name" value="{{$user->name}}" type="name" class="form-control" id="current-fullday" name="shortDescription">
                    </div>
                    <div class="input-group mb-3">
                        <label style="color: #a2a2a2" class="input-group-text" for="current-fullday">Email</label>
                        <input name="email" value="{{$user->email}}" type="name" class="form-control" id="current-fullday" name="shortDescription">
                    </div>
                    <button type="submit" class="btn btn-success">Save</button>
                </form>
            </div>
        </div>

@endsection
