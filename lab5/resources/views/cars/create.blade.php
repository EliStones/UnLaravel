@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create car</div>

                <div class="card-body">
                    <p>Create car form here</p>
                    @if (count($errors))
                        <ul class="text-danger">
                        @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                        </ul>
                        
                    @endif
                    <form action="/addCar" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <label for="make">Make:</label>
                        <input type="text" name="make" class="form-control" value="{{old('make')}}">
                        <label for="make">Model:</label>
                        <input type="text" name="model" class="form-control" value="{{old('model')}}">
                        <label for="make">Date:</label>
                        <input type="date" name="produced_on" class="form-control"  value="{{old('produced_on')}}">
                        <br>
                        <input type="file" name="image"  value="{{old('image')}}">
                        <hr> 
                        <input type="submit" class="btn btn-success m-auto">   
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
