<?php

namespace App\Http\Controllers\Api;

use App\Models\Package;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiPackageController extends Controller
{
    // Show all packages
    public function showAll() {
        return response([
            'packages' => Package::all(),
        ]);
    }

    // Create package
    public function create(Request $request) {
        $credentials = $request->validate([
            'name' => 'required',
            'detail' => 'required',
            'price' => 'required|numeric'
        ]);

        $package = Package::create([
            'name' => ucwords($credentials['name']),
            'detail' => $credentials['detail'],
            'price' => $credentials['price']
        ]);

        if($package) {
            return response([
                'message' => 'Package added successfully!',
                'package' => $package
            ], 200);
        } else {
            return response([
                'message' => 'Package fail to add!'
            ], 200);
        }
    }

    // Show package
    public function show(Package $package) {
        return response([
            'package' => $package
        ]);
    }

    // Edit package
    public function edit(Request $request, Package $package) {
        $credentials = $request->validate([
            'name' => 'required',
            'detail' => 'required',
            'price' => 'required|numeric'
        ]);

        $edit = $package->update([
            'name' => ucwords($credentials['name']),
            'detail' => $credentials['detail'],
            'price' => $credentials['price']
        ]);

        if($edit) {
            return response([
                'message' => 'Package edited successfully!',
                'package' => $package
            ], 200);
        } else {
            return response([
                'message' => 'Package fail to edit!'
            ], 200);
        }
    }

    // Delete package
    public function delete(Package $package) {
        
        if($package->destroy($package->id)) {
            return response([
                'message' => 'Package deleted successfully!'
            ], 200);
        } else {
            return response([
                'message' => 'Package fail to delete!'
            ]);
        }
    }
}
