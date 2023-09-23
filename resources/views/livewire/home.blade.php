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

    @if(session('Cost_deleted_success'))
        <div class="alert alert-success">
            {{ session("Cost_deleted_success") }}
        </div>
    @endif

    <section>
        <div class="row justify-content-between">
            <div style="background-color:black;color:white;padding:3% " class="col-md-5 mb-2">
                Tommorow Cost is : {{$tommorowDateCost}}  &#xA5
            </div>
            <div style="background-color:black;color:white;padding:3%" class="col-md-5 mb-2">
                This Month Cost is : {{$thisMonthCost}}  &#xA5
            </div>
        </div>
    </section>

    {{-- @foreach ($getTodayCostGet as $data)
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
    @endforeach --}}

 

     {{-- tryagain3--}}
