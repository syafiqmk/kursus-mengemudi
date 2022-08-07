<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\User;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class InstructorController extends Controller
{
    public function index() {
        return view('instructor.index', [
            'title' => 'Welcome, '. auth()->user()->name,
            'enrolls' => Course::latest()->where([['instructor_id', auth()->user()->id], ['status', 'grant']])->get()
        ]);
    }

    public function enroll($enroll) {
        $enroll = Course::find($enroll);
        return view('instructor.enroll', [
            'title' => $enroll->package->name . ' ' . $enroll->user->name,
            'enroll' => $enroll
        ]);
    }

    public function finish($enroll) {
        $enroll = Course::find($enroll);
        $instructor = User::find(auth()->user()->id);
        $car = Car::find($enroll->car_id);

        $cars = $car->update([
            'status' => 'ready'
        ]);

        $status = $instructor->update([
            'status' => 'ready'
        ]);
        $finish = $enroll->update([
            'status' => 'finish'
        ]);

        if ($finish && $status && $cars) {
            return redirect('/instructor')->with('success', 'Course Finished!');
        } else {
            return redirect('/instructor')->with('danger', 'Course fail to finish!');
        }
    }

    // profiles
    public function profile() {
        return view('instructor.profile', [
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
                return redirect('/instructor/profile')->with('success', 'Profile updated!');
            } else {
                return redirect('/instructor/profile')->with('danger', 'Profile fail to update!');
            }
        } else {
            return redirect('/instructor/profile')->with('warning', 'Wrong Password!');
        }
    }
}
