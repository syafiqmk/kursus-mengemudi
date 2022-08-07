<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;

class AdminInstructorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.instructor.index', [
            'title' => 'Instructors',
            'instructors' => User::latest()->where('role', 'instructor')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.instructor.create', [
            'title' => "Add Instructor"
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $credentials = $request->validate([
            'name' => 'required|min:3|max:100',
            'email' => 'required|email',
            'password' => 'required|min:6',
            'photo' => 'file|image'
        ]);

        if($request->file('photo')) {
            $credentials['photo'] = $request->file('photo')->store('images/instructor');
            $create = User::create([
                'name' => ucwords($credentials['name']),
                'email' => $credentials['email'],
                'password' => bcrypt($credentials['password']),
                'photo' => $credentials['photo'],
                'role' => 'instructor',
                'status' => 'ready'
            ]);
        } else {
            $create = User::create([
                'name' => ucwords($credentials['name']),
                'email' => $credentials['email'],
                'password' => bcrypt($credentials['password']),
                'role' => 'instructor',
                'status' => 'ready'
            ]);
        }

        if($create) {
            return redirect()->route('instructor.index')->with('success', 'Insctructor added successfully!');
        } else {
            return redirect()->route('instructor.index')->with('danger', 'Instructor fail to add!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $user = User::find($id);
        return view('admin.instructor.show', [
            'title' => $user->name,
            'user' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.instructor.edit', [
            'title' => 'Edit : '. $user->name,
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        $credentials = $request->validate([
            'name' => 'required|min:3|max:100',
            'email' => 'required|email',
            'password' => 'required|min:6',
            'photo' => 'file|image'
        ]);

        if ($request->file('photo')) {
            Storage::delete($user->photo);
            $credentials['photo'] = $request->file('photo')->store('images/instructor');
            $update = $user->update([
                'name' => ucwords($credentials['name']),
                'email' => $credentials['email'],
                'password' => bcrypt($credentials['password']),
                'photo' => $credentials['photo'],
                'role' => 'instructor',
                'status' => 'ready'
            ]);
        } else {
            $update = $user->update([
                'name' => ucwords($credentials['name']),
                'email' => $credentials['email'],
                'password' => bcrypt($credentials['password']),
                'role' => 'instructor',
                'status' => 'ready'
            ]);
        }

        if ($update) {
            return redirect()->route('instructor.index')->with('success', 'Instructor edited successfully!');
        } else {
            return redirect()->route('instructor.index')->with('danger', 'Instructor fail to edit!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);

        if(Storage::delete($user->photo) && $user->destroy($user->id)) {
            return redirect()->route('instructor.index')->with('warning', 'Instructor deleted successfully!');
        } else {
            return redirect()->route('instructor.index')->with('danger', 'Instructor fail to delete!');
        }
    }
}
