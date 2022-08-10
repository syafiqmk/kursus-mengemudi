<?php

namespace App\Http\Controllers\Api\Student;

use App\Models\Car;
use App\Models\Course;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiStudentCourseController extends Controller
{
    // Show all
    public function showAll() {
        return response([
            'courses' => Course::where('student_id', auth()->user()->id)->latest()->get(),
        ]);
    }

    // Enroll course
    public function enroll(Request $request) {
        $credentials = $request->validate([
            'package_id' => 'required|numeric',
            'car_id' => 'required|numeric',
        ]);

        $car = Car::find($credentials['car_id']);

        // Car status check
        if($car->status == 'ready') {
            $enroll = Course::create([
                'student_id' => auth()->user()->id,
                'package_id' => $credentials['package_id'],
                'car_id' => $credentials['car_id']
            ]);

            // Car status update
            $status = $car->update([
                'status' => 'not ready'
            ]);

            if($enroll && $status) {
                return response([
                    'message' => 'Course enrolled successfully!',
                    'course' => $enroll
                ], 200);
            } else {
                return response([
                    'message' => 'Course fail to enroll!'
                ]);
            }
        } else {
            return response([
                'message' => 'Car not ready!',
            ]);
        }
    }
}
