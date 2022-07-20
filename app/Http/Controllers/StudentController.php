<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Package;
use App\Models\Enroll;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        $enroll = Enroll::create([
            'user_id' => auth()->user()->id,
            'package_id' => $package,
            'car_id' => $car,
            'status' => 'enroll',
        ]);

        if ($enroll) {
            return redirect('/student/enrollment')->with('enroll-success', 'Berhasil Enroll Paket!');
        } else {
            return redirect('/student')->with('enroll-fail', 'Gagal Enroll Paket!');
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
            return redirect('/student/enrollment')->with('payment-success', 'Enrollment Payment Success');
        } else {
            return redirect('/student/enrollment')->with('payment-fail', 'Enrollment Payment Failed');
        }
    }
}
