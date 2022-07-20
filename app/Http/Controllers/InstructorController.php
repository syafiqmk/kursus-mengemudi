<?php

namespace App\Http\Controllers;

use App\Models\Enroll;
use App\Models\User;
use App\Models\Car;
use Illuminate\Http\Request;

class InstructorController extends Controller
{
    public function index() {
        return view('instructor.index', [
            'title' => 'Instructor',
            'enrolls' => Enroll::latest()->where([['instructor_id', auth()->user()->id], ['status', 'grant']])->get()
        ]);
    }

    public function enroll($enroll) {
        $enroll = Enroll::find($enroll);
        return view('instructor.enroll', [
            'title' => $enroll->package->name . ' ' . $enroll->user->name,
            'enroll' => $enroll
        ]);
    }

    public function finish($enroll) {
        $enroll = Enroll::find($enroll);
        $instructor = User::find(auth()->user()->id);
        $car = Car::find($enroll->car_id);

        $status = $instructor->update([
            'status' => 'ready'
        ]);
        $finish = $enroll->update([
            'status' => 'finish'
        ]);

        if ($finish && $status) {
            return redirect('/instructor')->with('finish-success', 'Kursus Selesai');
        } else {
            return redirect('/instructor')->with('finish-fail', 'Kursus Selesai {error}');
        }
    }
}
