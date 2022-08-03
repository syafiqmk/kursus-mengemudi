<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\User;
use App\Models\Enroll;
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
            'title' => 'Student',
            'packages' => Package::all(),
        ]);
    }

    public function enroll($id) {
        $package = Package::find($id);
        return view('student.enroll', [
            'title' => 'Enroll : '. $package->name,
            'package' => $package,
            'cars' => Car::latest()->where([['transmission_id', $package->transmission_id], ['status', 'ready']])->get(),
        ]);
    }

    public function enrollProcess($package, $car) {
        $carg = Car::find($car);

        $status = $carg->update([
            'status' => 'not ready',
        ]);
        $enroll = Enroll::create([
            'user_id' => auth()->user()->id,
            'package_id' => $package,
            'car_id' => $car,
            'status' => 'enroll',
        ]);


        if ($enroll && $status) {
            return redirect('/student/enrollment')->with('success', 'Berhasil Enroll Paket!');
        } else {
            return redirect('/student')->with('danger', 'Gagal Enroll Paket!');
        }
    }

    public function enrollment() {
        return view('student.enrollment', [
            'title' => 'Enrollment',
            'enrolls' => Enroll::latest()->where('user_id', auth()->user()->id)->get(),
        ]);
    }

    public function pay($enroll) {
        return view('student.pay', [
            'title' => 'Pay for Package Enrollment',
            'enroll' => Enroll::find($enroll)
        ]);
    }

    public function payProcess($enroll, Request $request) {
        $enroll = Enroll::find($enroll);

        $credentials = $request->validate([
            'image' => 'required|image|file'
        ]);

        if($request->file('image')) {
            $credentials['image'] = $request->file('image')->store('images/payment');
            $update = $enroll->update([
                'payment_image' => $credentials['image'],
                'status' => 'wait'
            ]);
        }

        if($update) {
            return redirect('/student/enrollment')->with('success', 'Enrollment Payment Success');
        } else {
            return redirect('/student/enrollment')->with('danger', 'Enrollment Payment Failed');
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
            // var_dump($request['old-pass']);
            // var_dump($request['new-pass']);
            // var_dump($oldPass);
            // var_dump('matched');
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
