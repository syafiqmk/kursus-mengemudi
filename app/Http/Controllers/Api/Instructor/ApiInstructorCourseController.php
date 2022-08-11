<?php

namespace App\Http\Controllers\Api\Instructor;

use App\Models\Course;
use App\Models\CourseDetail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiInstructorCourseController extends Controller
{
    // Show all
    public function showAll() {
        return response([
            'courses' => Course::where('instructor_id', auth()->user()->id)->where('status', 'grant')->latest()->get(),
        ], 200);
    }

    // Show
    public function show(Course $course) {
        return response([
            'course' => $course,
            'detail' => CourseDetail::where('course_id', $course->id)->latest()->get(),
        ], 200);
    }

    // Add detail
    public function detail(Request $request, Course $course) {
        $credentials = $request->validate([
            'detail' => 'required|min:3'
        ]);

        if($course->instructor_id == auth()->user()->id) {
            if($course->status == 'grant') {
                $detail = CourseDetail::create([
                    'detail' => $credentials['detail'],
                    'course_id' => $course->id
                ]);

                if($detail) {
                    return response([
                        'message' => 'Course detail added successfully!',
                        'detail' => $detail
                    ], 200);
                } else {
                    return response([
                        'message' => 'Course detail fail to add!'
                    ]);
                }
            } else {
                return response([
                    'message' => 'Wrong Course Status!'
                ], 200);
            }
        } else {
            return response([
                'message' => 'Not a course you handle!'
            ], 200);
        }
    }

    // Finish course
    public function finish(Course $course) {
        if($course->instructor_id == auth()->user()->id) {
            if($course->status == 'grant') {
                
                $finish = $course->update([
                    'status' => 'finish'
                ]);
        
                $detailFinish = CourseDetail::create([
                    'detail' => 'Course Finished!',
                    'course_id' => $course->id
                ]);
        
                if($finish && $detailFinish) {
                    return response([
                        'message' => 'Course finished successfully!'
                    ], 200);
                } else {
                    return response([
                        'message' => 'Course fail to finish!'
                    ], 200);
                }
                
            } else {
                return response([
                    'message' => 'Wrong Course Status!'
                ], 200);
            }
        } else {
            return response([
                'Not a course you handle!'
            ], 200);
        }
    }
}
