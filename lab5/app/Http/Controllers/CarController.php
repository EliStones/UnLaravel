<?php

namespace App\Http\Controllers;

use App\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Show all cars
        $cars = Car::all();

        return view('cars.index', compact('cars'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // dd($request->method());
        //dd($request->method());
        if ($request->method() == "POST") {
            // Validating input data
            $this->validate($request, [
                'make' => 'required|unique:cars',
                'model' => 'required|unique:cars',
                'produced_on' => 'requiredunique:cars',
                'image' => 'required|unique:cars'
            ]);

            // Create a car
            $make = $request->input('make');
            $model = $request->input('model');
            $produced_on = $request->input('produced_on');

            // dd($image);

            // dd($make,$model,$produced_on);

            $car = new Car;
            $car->make = $make;
            $car->model = $model;
            $car->produced_on = $produced_on;

            // Move image to storage
            $car->image = $request->file('image')->store('public/images');

            // dd($car);

            $car->save();
            $request->session()->flash('form_status', "Car added successfully");

            return redirect('/car');
        }
        

        if($request->method() == "GET"){
            return view('cars.create');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Show a single car
        // $car = Car::findOrFail($id);
        return view('cars.show', 
        // compact($car)
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function edit(Car $car)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Car $car)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function destroy(Car $car)
    {
        //
    }
}
