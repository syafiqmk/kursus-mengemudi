<?php

namespace App\Http\Controllers\Api;

use App\Models\Car;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ApiCarController extends Controller
{
    // Show all car
    public function showAll() {
        return response([
            'Cars' => Car::all(),
        ]);
    }

    // Create car
    public function create(Request $request) {
        $credentials = $request->validate([
            'registration_number' => 'required',
            'name' => 'required',
            'engine_capacity' => 'required|numeric',
            'image' => 'file|image',
            'price' => 'required|numeric',
            'brand_id' => 'required|numeric',
            'transmission_id' => 'required|numeric',
        ]);

        if($request->file('image')) {
            $credentials['image'] = $request->file('image')->store('images/car');
        }

        $create = Car::create([
            'registration_number' => strtoupper($credentials['registration_number']),
            'name' => ucwords($credentials['name']),
            'engine_capacity' => $credentials['engine_capacity'],
            'image' => $credentials['image'],
            'price' => $credentials['price'],
            'brand_id' => $credentials['brand_id'],
            'transmission_id' => $credentials['transmission_id']
        ]);

        if ($create) {
            return response([
                'message' => 'Car added successfully!',
                'car' => $create
            ]);
        } else {
            return response([
                'message' => 'Car fail to add!'
            ]);
        }
    }

    // Show car
    public function show(Car $car) {
        return response([
            'car' => $car
        ], 200);
    }

    // Edit car
    public function edit(Request $request, Car $car) {
        $credentials = $request->validate([
            'registration_number' => 'required',
            'name' => 'required',
            'image' => 'file|image',
            'engine_capacity' => 'required|numeric',
            'price' => 'required|numeric',
            'brand_id' => 'required|numeric',
            'transmission_id' => 'required|numeric',
        ]);

        $edit = [
            'registration_number' => strtoupper($credentials['registration_number']),
            'name' => ucwords($credentials['name']),
            'engine_capacity' => $credentials['engine_capacity'],
            'price' => $credentials['price'],
            'brand_id' => $credentials['brand_id'],
            'transmission_id' => $credentials['transmission_id'],
        ];
        
        if($request->file('image')) {
            if($car->image !== NULL) {
                Storage::delete($car->image);
            }
            $credentials['image'] = $request->file('image')->store('images/car');
            $edit['image'] = $credentials['image'];
        }

        if($car->update($edit)) {
            return response([
                'message' => 'Car edited successfully!',
                'car' => $car
            ], 200);
        } else {
            return response([
                'message' => 'Car fail to edit!'
            ], 200);
        }
    }

    // Delete car
    public function delete(Car $car) {
        if((Storage::delete($car->image)) && ($car->destroy($car->id))) {
            return response([
                'message' => 'Car deleted successfully!'
            ], 200);
        } else {
            return response([
                'message' => 'Car fail to delete!'
            ], 200);
        }
    }
}
