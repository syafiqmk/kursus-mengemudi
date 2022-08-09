<?php

namespace App\Http\Controllers\Api\Student;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ApiStudentController extends Controller
{
    // Profile
    public function profile(Request $request) {
        $user = User::find(auth()->user()->id);
        $oldPass = $user->getAuthPassword();

        if(empty($request['new_pass'])) {
            $request['new_pass'] = $request['old_pass'];
        }

        $credentials = $request->validate([
            'name' => 'required|min:3|max:100',
            'email' => 'required|email',
            'photo' => 'file|image',
            'password' => 'required|min:6'
        ]);

        if(Hash::check($request['old_pass'], $oldPass)) {
            $update = [
                'name' => ucwords($credentials['name']),
                'email' => $credentials['email'],
                'password' => bcrypt($credentials['password']),
            ];

            if($request->file('photo')) {
                if(!empty($user->photo)) {
                    Storage::delete($user->photo);
                }

                $credentials['photo'] = $request->file('photo')->store('images/student');

                $update['photo'] = $credentials['photo'];
            }

        } else {
            return response([
                'message' => 'Invalid credentials'
            ]);
        }

        if($user->update($update)) {
            return response([
                'message' => 'Profile updated successfully!',
                'profile' => $user
            ], 200);
        } else {
            return response([
                'message' => 'Profile fail to update!'
            ], 200);
        }
    }
}
