<?php

namespace App\Http\Controllers;

use App\Review;
use App\Car;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $car = Car::findOrFail($id);
        $reviews = $car->review;
        
        return json_encode($reviews);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $id)
    {
       $car = Car::findOrFail($id);
    //    dd($request->all());
       
        //
        if ($request->method() == "POST") {
            //Add a new request
            $title = $request->input('review-title');
            $description = $request->input('review-text');
            $car_id = $request->input('car-id');
            $rating = $request->input('rating');

            $review = new Review();
            $review->title = $title;
            $review->description = $description;
            $review->rating = $rating;
            $review->car_id = $car_id;

            $review->save();
            $request->session()->flash('form_status', "Review added successfully");
            return redirect('/reviews/'.$car->id);

        }

        if ($request->method() == "GET") {
            return view('reviews.create', compact('car'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function getCar($id){
        $car = Car::findOrFail($id);
        $car_details = [
            'make' => $car->make,
            'model' => $car->model,
            'produced_on' => $car->produced_on
        ];

        return json_encode($car_details);
    }

    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(Review $review)
    {
        //
    }
}
