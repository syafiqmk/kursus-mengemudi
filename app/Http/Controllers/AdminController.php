<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function enrollment() {
        return view('admin.enroll', [
            'title' => 'Enrollment',
            'enrolls' => Course::latest()->where('status', 'wait')->get()
        ]);
    }

    public function enrollDetail($enroll) {
        return view('admin.enrollConfirm', [
            'title' => 'Enrollment Payment Confirmation',
            'enroll' => Course::find($enroll),
            'instructors' => User::latest()->where([['status', 'ready'], ['role', 'instructor']])->get()
        ]);
    }

    public function enrollProcess($enroll, $instructor) {
        $enroll = Course::find($enroll);
        $instructorg = User::find($instructor);

        $status = $instructorg->update([
            'status' => 'not ready'
        ]);

        $grant = $enroll->update([
            'instructor_id' => $instructor,
            'status' => 'grant',
        ]);

        if($grant && $status) {
            return redirect('/admin/enroll')->with('success', 'Payment confirmation success!');
        } else {
            return redirect('/admin/enroll')->with('danger', 'Payment fail to confirm!');
        }
    }
}
