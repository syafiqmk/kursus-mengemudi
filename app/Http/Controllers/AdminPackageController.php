<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Transmission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminPackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.package.index', [
            'title' => 'Packages',
            'packages' => Package::latest()->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.package.create', [
            'title' => 'Add Package',
            'transmissions' => Transmission::latest()->get(),
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
            'detail' => 'required',
            'price' => 'required|numeric',
            'transmission' => 'required'
        ]);

        $create = package::create([
            'name' => ucwords($credentials['name']),
            'detail' => $credentials['detail'],
            'price' => $credentials['price'],
            'transmission_id' => $credentials['transmission']
        ]);

        if($create) {
            return redirect()->route('package.index')->with('package-create-success', 'Data Package Berhasil ditambah!');
        } else {
            return redirect()->route('package.index')->with('package-create-fail', 'Data Package Gagal ditambah!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function show(Package $package)
    {
        return view('admin.package.show', [
            'title' => $package->name,
            'package' => $package
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function edit(Package $package)
    {
        return view('admin.package.edit', [
            'title' => 'Edit : '. $package->name,
            'package' => $package,
            'transmissions' => Transmission::latest()->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Package $package)
    {
        $credentials = $request->validate([
            'name' => 'required|min:3|max:100',
            'detail' => 'required',
            'price' => 'required|numeric',
            'transmission' => 'required'
        ]);

        $update = $package->update([
            'name' => ucwords($credentials['name']),
            'detail' => $credentials['detail'],
            'price' => $credentials['price'],
            'transmission_id' => $credentials['transmission']
        ]);

        if ($update) {
            return redirect()->route('package.index')->with('package-update-success', 'Data Package Berhasil diupdate!');
        } else {
            return redirect()->route('package.index')->with('package-update-fail', 'Data Package Gagal diupdate!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function destroy(Package $package)
    {
        if($package->destroy($package->id)) {
            return redirect()->route('package.index')->with('package-delete-success', 'Data Package Berhasil dihapus!');
        } else {
            return redirect()->route('package.index')->with('package-delete-fail', 'Data Package Gagal dihapus!');
        }
    }
}
