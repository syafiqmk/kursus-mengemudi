<?php

namespace App\Http\Controllers\Api\Student;

use App\Models\Car;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ApiStudentCarController extends Controller
{
    // Show all
    public function showAll() {
        return response([
            'your cars' => Car::where('student_id', auth()->user()->id)->get()
        ]);
    }

    // Create
    public function create(Request $request) {
        $credentials = $request->validate([
            'registration_number' => 'required',
            'name' => 'required',
            'image' => 'file|image',
            'engine_capacity' => 'required|numeric',
            'brand_id' => 'required|numeric',
            'transmission_id' => 'required|numeric',
        ]);

        $create = [
            'registration_number' => strtoupper($credentials['registration_number']),
            'name' => ucwords($credentials['name']),
            'engine_capacity' => $credentials['engine_capacity'],
            'brand_id' => $credentials['brand_id'],
            'transmission_id' => $credentials['transmission_id'],
            'student_id' => auth()->user()->id
        ];

        if($request->file('image')) {
            $credentials['image'] = $request->file('image')->store('images/car');

            $create['image'] = $credentials['image'];
        }

        $car = Car::create($create);

        if($car) {
            return response([
                'message' => 'Car added successfully!',
                'car' => $car
            ], 200);
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
        ]);
    }

    // Edit car
    public function edit(Request $request, Car $car) {
        $credentials = $request->validate([
            'registration_number' => 'required',
            'name' => 'required',
            'image' => 'file|image',
            'engine_capacity' => 'required|numeric',
            'brand_id' => 'required|numeric',
            'transmission_id' => 'required|numeric',
        ]);

        $update = [
            'registration_number' => strtoupper($credentials['registration_number']),
            'name' => ucwords($credentials['name']),
            'engine_capacity' => $credentials['engine_capacity'],
            'brand_id' => $credentials['brand_id'],
            'transmission_id' => $credentials['transmission_id'],
        ];

        if($request->file('image')) {
            if(!empty($car->image)) {
                Storage::delete($car->image);
            }

            $credentials['image'] = $request->file('image')->store('images/car');
            $update['image'] = $credentials['image'];
        }


        if($car->update($update)) {
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
        if((Storage::delete($car->image) && ($car->delete($car->id)))) {
            return response([
                'message' => 'Car deleted successfully!'
            ], 200);
        } else {
            return response([
                'message' => 'Car fail to delete!'
            ]);
        }
    }
}
