<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\User;
use App\Models\Course;
use App\Models\CourseDetail;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class InstructorController extends Controller
{
    // Instructor index
    public function index() {
        return view('instructor.index', [
            'title' => 'Welcome, '. auth()->user()->name,
            'courses' => Course::latest()->where([['instructor_id', auth()->user()->id], ['status', 'grant']])->get()
        ]);
    }

    // Course detail
    public function course(Course $course) {
        return view('instructor.course', [
            'title' => $course->package->name . ' | ' . $course->student->name,
            'course' => $course, 
            'details' => CourseDetail::where('course_id', $course->id)->latest()->get()
        ]);
    }

    // Add course detail
    public function detail(Request $request, Course $course) {
        $credentials = $request->validate([
            'detail' => 'required|min:3',
        ]);

        $detail = CourseDetail::create([
            'detail' => $credentials['detail'],
            'course_id' => $course->id
        ]);

        if($detail) {
            return redirect()->back()->with('success', 'Detail added successfully!');
        } else {
            return redirect()->back()->with('danger', 'Detail fail to add!');
        }
    }

    // Finish
    public function finish(Course $course) {
        $instructor = User::find(auth()->user()->id);
        $car = Car::find($course->car_id);

        $cars = $car->update([
            'status' => 'ready'
        ]);

        $status = $instructor->update([
            'status' => 'ready'
        ]);
        $finish = $course->update([
            'status' => 'finish'
        ]);

        $detail = CourseDetail::create([
            'course_id' => $course->id,
            'detail' => 'Course Finished!'
        ]);

        if ($finish && $status && $cars && $detail) {
            return redirect()->route('instructor.index')->with('success', 'Course Finished!');
        } else {
            return redirect()->route('instructor.index')->with('danger', 'Course fail to finish!');
        }
    }

    // Course history
    public function history() {
        return view('instructor.history', [
            'title' => 'Courses History',
            'courses' => Course::where('instructor_id', auth()->user()->id)->where('status', 'finish')->latest()->get(),
        ]);
    }

    // Course history detail 
    public function historyDetail(Course $course) {
        return view('instructor.historyDetail', [
            'title' => 'Course History Detail',
            'course' => $course,
            'details' => CourseDetail::where('course_id', $course->id)->latest()->get()
        ]);
    }


    // profiles
    public function profile() {
        return view('instructor.profile', [
            'title' => auth()->user()->name,
            'user' => auth()->user()
        ]);
    }

    // Profile edit
    public function profileEdit(Request $request) {
        $user = User::find(auth()->user()->id);
        $oldPass = auth()->user()->getAuthPassword();

        if ($request['new-pass'] == '') {
            $request['new-pass'] = $request['old-pass'];
        }

        $credentials = $request->validate([
            'name' => 'required|min:3|max:100',
            'email' => 'required|email',
            'new-pass' => 'required|min:6',
            'photo' => 'file|image'
        ]);


        if(Hash::check($request['old-pass'], $oldPass)) {
            if($request->file('photo')) {
                if ($user->photo) {
                    Storage::delete($user->photo);
                }
                
                $credentials['photo'] = $request->file('photo')->store('images/instructor');

                $update = $user->update([
                    'name' => $credentials['name'],
                    'email' => $credentials['email'],
                    'password' => bcrypt($credentials['new-pass']),
                    'photo' => $credentials['photo']
                ]);
            } else {
                $update = $user->update([
                    'name' => $credentials['name'],
                    'email' => $credentials['email'],
                    'password' => bcrypt($credentials['new-pass']),
                ]);
            }

            if($update) {
                return redirect()->route('instructor.profile')->with('success', 'Profile updated!');
            } else {
                return redirect()->route('instructor.profile')->with('danger', 'Profile fail to update!');
            }
        } else {
            return redirect()->route('instructor.profile')->with('warning', 'Wrong Password!');
        }
    }
}
