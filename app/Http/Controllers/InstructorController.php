<?php

namespace App\Http\Controllers;

use App\Models\Enroll;
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
        $finish = $enroll->update([
            'status' => 'finish'
        ]);

        if ($finish) {
            return redirect('/instructor')->with('finish-success', 'Kursus Selesai');
        } else {
            return redirect('/instructor')->with('finish-fail', 'Kursus Selesai {error}');
        }
    }
}
