<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Brand;
use App\Models\Transmission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class AdminCarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.car.index', [
            'title' => 'Cars',
            'cars' => Car::latest()->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.car.create', [
            'title' => 'Add Car',
            'brands' => Brand::latest()->get(),
            'transmissions' => Transmission::latest()->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $credentials = $request->validate([
            'reg-number' => 'required',
            'name' => 'required|min:3|max:100',
            'price' => 'required|numeric',
            'engine-capacity' => 'required|numeric|min:1',
            'brand' => 'required',
            'transmission' => 'required',
            'image' => 'image|file'
        ]);

        if ($request->file('image')) {
            $credentials['image'] = $request->file('image')->store('images/car');

            $create = Car::create([
                'registration_number' => strtoupper($credentials['reg-number']),
                'name' => ucwords($credentials['name']),
                'price' => $credentials['price'],
                'engine_capacity' => $credentials['engine-capacity'],
                'brand_id' => $credentials['brand'],
                'transmission_id' => $credentials['transmission'],
                'image' => $credentials['image'],
                'status' => 'ready'
            ]);
        } else {
            $create = Car::create([
                'registration_number' => strtoupper($credentials['reg-number']),
                'name' => ucwords($credentials['name']),
                'price' => $credentials['price'],
                'engine_capacity' => $credentials['engine-capacity'],
                'brand_id' => $credentials['brand'],
                'transmission_id' => $credentials['transmission'],
                'status' => 'ready'
            ]);
        }


        if ($create) {
            return redirect()->route('car.index')->with('success', 'Car added successfully!');
        } else {
            return redirect()->route('car.index')->with('danger', 'Car fail to add!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function show(Car $car)
    {
        return view('admin.car.show', [
            'title' => $car->brand->name .' '. $car->name,
            'car' => $car
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function edit(Car $car)
    {
        return view('admin.car.edit', [
            'title' => 'Edit : ' . $car->brand->name . ' ' . $car->name,
            'car' => $car,
            'brands' => Brand::latest()->get(),
            'transmissions' => Transmission::latest()->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Car $car)
    {
        $credentials = $request->validate([
            'reg-number' => 'required',
            'name' => 'required|min:3|max:100',
            'price' => 'required|numeric',
            'engine-capacity' => 'required|numeric|min:1',
            'brand' => 'required',
            'transmission' => 'required',
            'image' => 'image|file'
        ]);

        if ($request->file('image')) {
            Storage::delete($car->image);
            $credentials['image'] = $request->file('image')->store('images/car');

            $update = $car->update([
                'registration_number' => strtoupper($credentials['reg-number']),
                'name' => ucwords($credentials['name']),
                'price' => $credentials['price'],
                'engine_capacity' => $credentials['engine-capacity'],
                'brand_id' => $credentials['brand'],
                'transmission_id' => $credentials['transmission'],
                'image' => $credentials['image'],
                'status' => 'ready'
            ]);
        } else {
            $update = $car->update([
                'registration_number' => strtoupper($credentials['reg-number']),
                'name' => ucwords($credentials['name']),
                'price' => $credentials['price'],
                'engine_capacity' => $credentials['engine-capacity'],
                'brand_id' => $credentials['brand'],
                'transmission_id' => $credentials['transmission'],
                'status' => 'ready'
            ]);
        }


        if ($update) {
            return redirect()->route('car.index')->with('success', 'Car edited sucessfully!');
        } else {
            return redirect()->route('car.index')->with('danger', 'Car fail to edit!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function destroy(Car $car)
    {
        if (Storage::delete($car->image) && $car->destroy($car->id)) {
            return redirect()->route('car.index')->with('warning', 'Car deleted successfully!');
        } else {
            return redirect()->route('car.index')->with('danger', 'Car fail to delete!');
        }
    }
}
