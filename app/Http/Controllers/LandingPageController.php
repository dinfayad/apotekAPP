<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // -r : resource : membuat method/func untuk CRUD nya
    // mengambil banyak data/menampilkan halaman awal (CRUD : R all)
    public function index()
    {
        // proses pemanggilan file blade
        // file yang didalam file = folder.file 
        return view('landing-page');
    }

    /**
     * Show the form for creating a new resource.
     */
    // menampilkan halamn form tambah data
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    // menambahkan data ke db/mengirim data
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    // menampilkan hanya satu data (detail data)
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    // menampilkan halaman untuk edit data
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    //mengubah data di db/memproses data dari form edit
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    //menghapus data di db
    public function destroy(string $id)
    {
        //
    }
}
