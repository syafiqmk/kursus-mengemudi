<?php

namespace App\Http\Controllers\Api;

use App\Models\Brand;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiBrandController extends Controller
{
    // Show all brand
    public function showAll() {
        return response([
            'brands' => Brand::all(),
        ]);
    }
}
