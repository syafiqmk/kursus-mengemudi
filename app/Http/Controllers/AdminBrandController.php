<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class AdminBrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.brand.index', [
            'title' => 'Brand',
            'brands' => Brand::latest()->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.brand.create', [
            'title' => 'Add Brand',
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
            'name' => 'required|min:3|max:100'
        ]);

        $create = Brand::create([
            'name' => ucwords($credentials['name'])
        ]);

        if ($create) {
            return redirect()->route('brand.index')->with('brand-create-success', 'Tambah Data Brand Berhasil!');
        } else {
            return redirect()->route('brand.index')->with('brand-create-fail', 'Tambah Data Brand Gagal!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        return view('admin.brand.edit', [
            'title' => 'Update Brand : ' . $brand->name,
            'brand' => $brand
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand)
    {
        $credentials = $request->validate([
            'name' => 'required|min:3|max:100'
        ]);

        $create = $brand->update([
            'name' => ucwords($credentials['name'])
        ]);

        if ($create) {
            return redirect()->route('brand.index')->with('brand-update-success', 'Edit Data Brand Berhasil!');
        } else {
            return redirect()->route('brand.index')->with('brand-update-fail', 'Edit Data Brand Gagal!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        if ($brand->destroy($brand->id)) {
            return redirect()->route('brand.index')->with('brand-delete-success', 'Data Brand Berhasil dihapus!');
        } else {
            return redirect()->route('brand.index')->with('brand-delete-fail', 'Data Brand Gagal dihapus!');
        }
    }
}
