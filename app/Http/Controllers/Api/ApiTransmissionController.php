<?php

namespace App\Http\Controllers\Api;

use App\Models\Transmission;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiTransmissionController extends Controller
{
    // Show all transmission
    public function showAll() {
        return response([
            'Transmissions' => Transmission::all(),
        ]);
    }
}
