<?php

namespace App\Http\Controllers;

use App\Models\Enroll;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function enrollment() {
        return view('admin.enroll', [
            'title' => 'Enrollment',
            'enrolls' => Enroll::latest()->where('status', 'wait')->get()
        ]);
    }

    public function enrollDetail($enroll) {
        return view('admin.enrollConfirm', [
            'title' => 'Enrollment Payment Confirmation',
            'enroll' => Enroll::find($enroll),
            'instructors' => User::latest()->where([['status', 'ready'], ['role', 'instructor']])->get()
        ]);
    }

    public function enrollProcess($enroll, $instructor) {
        $enroll = Enroll::find($enroll);
        $instructorg = User::find($instructor);

        $status = $instructorg->update([
            'status' => 'not ready'
        ]);

        $grant = $enroll->update([
            'instructor_id' => $instructor,
            'status' => 'grant',
        ]);

        if($grant && $status) {
            return redirect('/admin/enroll')->with('pay-confirm-success', 'Payment Confirmation Success!');
        } else {
            return redirect('/admin/enroll')->with('pay-confirm-fail', 'Payment Confirmation Failed!');
        }
    }
}
