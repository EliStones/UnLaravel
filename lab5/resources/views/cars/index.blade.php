@extends('layouts.app')

@section('content')
<div class="container w-100">
    @if (session('form_status'))
        <p class="bolder text-success">Car added successfully</p>
    @endif
    <div class="row">

            @foreach ($cars as $car)
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">{{$car->make}} - {{$car->model}}</div>
    
                    <div class="card-body">
                    <img src="{{Storage::url($car->image)}}" alt="Car" height="180px" width="300px"><br>
                        Produced on: {{$car->produced_on}} <br>
                        <a href="/addReview/{{$car->id}}" class="btn btn-primary">Add review</a>
                        <a href="/reviews/{{$car->id}}" class="btn btn-primary">View reviews</a>
                    </div>
                </div>
            </div>
            @endforeach

    </div>
</div>
@endsection
