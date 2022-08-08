<?php

namespace App\Http\Controllers\Api;

use App\Models\Car;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
        
    }

    // Show car
    public function show(Car $car) {
        return response([
            'car' => $car
        ], 200);
    }
}
