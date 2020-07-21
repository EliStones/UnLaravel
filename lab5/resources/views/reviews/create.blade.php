@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add a review</div>

                <div class="card-body">
                    @if (count($errors))
                        <ul class="text-danger">
                        @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                        </ul>
                        
                    @endif
                    <form action="/addReview/{{$car->id}}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <h4>Review the {{$car->make." ".$car->model}}</h4>
                        <input type="hidden" name="car-id" id="car-id" value="{{$car->id}}">
                        <label for="review-text">Title: </label>
                        <input type="text" name="review-title" id="review-description" class="form-control">
                        <label for="rating">Rating: </label>
                        <select name="rating" id="rating" class="form-control">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                        <label for="review-text">Description: </label>
                        <input type="text" name="review-text" id="review-text" class="form-control">
                        <hr> 
                        <input type="submit" class="btn btn-success m-auto">   
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
