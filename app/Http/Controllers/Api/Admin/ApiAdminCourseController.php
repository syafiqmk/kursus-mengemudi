<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\User;
use App\Models\Course;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiAdminCourseController extends Controller
{
    // Show all payment
    public function showAllPayment() {
        return response([
            'payments' => Course::where('status', 'wait')->latest()->get()
        ], 200);
    }

    // Show payment
    public function showPayment(Course $course) {
        if($course->status == 'wait') {
            return response([
                'payment' => $course
            ], 200);
        } else {
            return response([
                'message' => 'Wrong Course Status!'
            ], 200);
        }
    }

    // Confirm payment
    public function confirm(Request $request, Course $course) {
        $credentials = $request->validate([
            'instructor_id' => 'required|numeric'
        ]);

        // Check course status
        if($course->status == 'wait') {
            $confirm = $course->update([
                'instructor_id' => $credentials['instructor_id'],
                'status' => 'grant'
            ]);

            $instructor = User::find($credentials['instructor_id']);
            // Check instructor status
            if($instructor->status == 'ready') {

                $status = $instructor->update([
                    'status' => 'not ready'
                ]);

                if($confirm && $status) {
                    return response([
                        'message' => 'Payment confirmed successfully!'
                    ], 200);
                } else {
                    return response([
                        'message' => 'Payment fail to confirm!'
                    ], 200);
                }
            } else {
                return response([
                    'message' => 'Instructor not ready!'
                ]);
            }

        } else {
            return response([
                'message' => 'Wrong Course Status!'
            ]);
        }

    }
}
