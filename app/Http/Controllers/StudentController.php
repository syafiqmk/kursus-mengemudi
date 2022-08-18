<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\User;
use App\Models\Course;
use App\Models\Package;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    public function index() {
        return view('student.index', [
            'title' => 'Welcome, ' . auth()->user()->name,
            'packages' => Package::all(),
        ]);
    }

    public function package(Package $package) {
        return view('student.enroll', [
            'title' => $package->name,
            'package' => $package,
            'cars' => Car::latest()->where([['status', 'ready']])->get(),
        ]);
    }

    public function enrollProcess(Package $package, Car $car) {
        $status = $car->update([
            'status' => 'not ready',
        ]);
        $enroll = Course::create([
            'student_id' => auth()->user()->id,
            'package_id' => $package->id,
            'car_id' => $car->id,
            'status' => 'enroll',
        ]);


        if ($enroll && $status) {
            return redirect()->route('student.courses')->with('success', 'Berhasil Enroll Paket!');
        } else {
            return redirect()->route('student.index')->with('danger', 'Gagal Enroll Paket!');
        }
    }

    public function courses() {
        return view('student.courses', [
            'title' => 'Courses',
            'courses' => Course::latest()->where('student_id', auth()->user()->id)->get(),
        ]);
    }

    public function pay(Course $course) {
        return view('student.pay', [
            'title' => 'Pay for Package Enrollment',
            'course' => $course
        ]);
    }

    public function payProcess(Course $course, Request $request) {
        $credentials = $request->validate([
            'image' => 'required|image|file'
        ]);

        if($request->file('image')) {
            $credentials['image'] = $request->file('image')->store('images/payment');
            $update = $course->update([
                'payment_image' => $credentials['image'],
                'status' => 'wait'
            ]);
        }

        if($update) {
            return redirect()->route('student.courses')->with('success', 'Enrollment Payment Success');
        } else {
            return redirect()->route('student.courses')->with('danger', 'Enrollment Payment Failed');
        }
    }


    // profiles
    public function profile() {
        return view('student.profile', [
            'title' => auth()->user()->name,
            'user' => auth()->user()
        ]);
    }

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


        if (Hash::check($request['old-pass'], $oldPass)) {
            if($request->file('photo')) {
                if($user->photo) {
                    Storage::delete($user->photo);
                }
                
                $credentials['photo'] = $request->file('photo')->store('images/student');

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
                return redirect('/student/profile')->with('success', 'Update Profile Berhasil!');
            } else {
                return redirect('/student/profile')->with('danger', 'Update Profile Gagal!');
            }
        } else {
            return redirect('/student/profile')->with('warning', 'Password Salah!');
        }
    }
}
