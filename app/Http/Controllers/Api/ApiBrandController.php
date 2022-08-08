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

    // Create brand
    public function create(Request $request) {
        $credentials = $request->validate([
            'name' => 'required',
        ]);

        $brand = Brand::create([
            'name' => ucwords($credentials['name'])
        ]);

        if($brand) {
            return response([
                'message' => 'Brand added successfully!',
                'brand' => $brand
            ]);
        } else {
            return response([
                'message' => 'Brand fail to add!'
            ]);
        }
    }

    // Show brand
    public function show(Brand $brand) {
        return response([
            'brand' => $brand
        ], 200);
    }

    // Edit brand
    public function edit(Request $request, Brand $brand) {
        $credentials = $request->validate([
            'name' => 'required'
        ]);

        $edit = $brand->update([
            'name' => ucwords($credentials['name']),
        ]);

        if($edit) {
            return response([
                'message' => 'Brand edited successfully!',
                'brand' => $brand
            ], 200);
        } else {
            return response([
                'message' => 'Brand fail to edit!'
            ], 200);
        }
    }

    // Delete brand
    public function delete(Brand $brand) {

        if($brand->destroy($brand->id)) {
            return response([
                'message' => 'Brand deleted successfully!'
            ]);
        } else {
            return response([
                'message' => 'Brand fail to delete!'
            ]);
        }
    }
}
