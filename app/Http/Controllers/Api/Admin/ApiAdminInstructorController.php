<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ApiAdminInstructorController extends Controller
{
    // Show all
    public function showAll() {
        return response([
            'instructors' => User::where('role', 'instructor')->latest()->get()
        ], 200);
    }

    // Create instructor
    public function create(Request $request) {
        $credentials = $request->validate([
            'name' => 'required|min:3|max:100',
            'email' => 'required|email',
            'password' => 'required|min:3',
            'photo' => 'file|image'
        ]);

        $create = [
            'name' => ucwords($credentials['name']),
            'email' => $credentials['email'],
            'password' => bcrypt($credentials['password']),
            'role' => 'instructor'
        ];

        if($request->file('photo')) {
            $credentials['photo'] = $request->file('photo')->store('images/instructor');
            $create['photo'] = $credentials['photo'];
        }

        $user = User::create($create);

        if($create) {
            return response([
                'message' => 'Instructor added successfully!',
                'instructor' => $user
            ], 200);
        } else {
            return response([
                'message' => 'Instructor fail to add!'
            ], 200);
        }
    }

    // Show instructor
    public function show(User $instructor) {
        return response([
            'instructor' => $instructor
        ]);
    }

    // Edit instructor
    public function edit(Request $request, User $instructor) {
        $credentials = $request->validate([
            'name' => 'required|min:3|max:100',
            'email' => 'required|email',
            'password' => 'required|min:3',
            'photo' => 'file|image'
        ]);

        $update = [
            'name' => ucwords($credentials['name']),
            'email' => $credentials['email'],
            'password' => bcrypt($credentials['password']),
            'role' => 'instructor'
        ];

        if ($request->file('photo')) {
            if(!empty($instructor->photo)) {
                Storage::delete($instructor->photo);
            }
            $credentials['photo'] = $request->file('photo')->store('images/instructor');
            $update['photo'] = $credentials['photo'];
        }

        $user = $instructor->update($update);

        if ($update) {
            return response([
                'message' => 'Instructor updated successfully!',
                'instructor' => $user
            ], 200);
        } else {
            return response([
                'message' => 'Instructor fail to update!'
            ], 200);
        }
    }

    // Delete
    public function delete(User $instructor) {
        if(!empty($instructor->photo)) {
            Storage::delete($instructor->photo);
        }
        
        if($instructor->destroy($instructor->id)) {
            return response([
                'message' => 'Instructor deleted successfully!'
            ], 200);
        } else {
            return response([
                'message' => 'Instructor fail to delete!'
            ], 200);
        }
    }
}
