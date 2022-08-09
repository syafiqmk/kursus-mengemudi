<?php

namespace App\Http\Controllers\Api\Student;

use App\Models\Package;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiStudentPackageController extends Controller
{
    // Show all
    public function showAll() {
        return response([
            'packages' => Package::all(),
        ]);
    }

    // Show package
    public function show(Package $package) {
        return response([
            'package' => $package
        ]);
    }
}
