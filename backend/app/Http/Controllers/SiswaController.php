<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //get data from table siswas
        $siswa = Siswa::paginate(15); // Mengatur paginasi dengan 15 data per halaman
        return response()->json([
            'success' => true,
            'message' => 'List Data Siswa',
            'data' => $siswa
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //set validation
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'alamat' => 'required',
            'kota' => 'required',
            'provinsi' => 'required',
            'email' => 'required',
        ]);
        //response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        //save to database
        $post = Siswa::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'kota' => $request->kota,
            'provinsi' => $request->provinsi,
            'email' => $request->email
        ]);
        //success save to database
        if ($post) {
            return response()->json([
                'success' => true,
                'message' => 'Input berhasil',
                'data' => $post
            ], 201);
        }
        //failed save to database
        return response()->json([
            'success' => false,
            'message' => 'Input gagal',
        ], 409);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //find post by ID
        $post = Siswa::findOrfail($id);
        //make response JSON
        return response()->json([
            'success' => true,
            'message' => 'Detail Data Siswa',
            'data' => $post
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, Siswa $post)
    // {
    //     //set validation
    //     $validator = Validator::make($request->all(), [
    //         'nama' => 'required',
    //         'alamat' => 'required',
    //         'kota' => 'required',
    //         'provinsi' => 'required',
    //         'email' => 'required',
    //     ]);

    //     //response error validation
    //     if ($validator->fails()) {
    //         return response()->json($validator->errors(), 400);
    //     }
    //     //find siswa by ID
    //     $post = Siswa::findOrFail($post->id);
    //     if ($post) {
    //         //update siswa
    //         $post->update([
    //             'nama' => $request->nama,
    //             'alamat' => $request->alamat,
    //             'kota' => $request->kota,
    //             'provinsi' => $request->provinsi,
    //             'email' => $request->email
    //         ]);
    //         return response()->json([
    //             'success' => true,
    //             'message' => 'Data siswa berhasil diupdate',
    //             'data' => $post
    //         ], 200);
    //     }
    //     //data siswa not found
    //     return response()->json([
    //         'success' => false,
    //         'message' => 'Data tidak ditemukan',
    //     ], 404);
    // }

    public function update(Request $request, Siswa $siswa)
{
    // Set validation
    $validator = Validator::make($request->all(), [
        'nama' => 'required',
        'alamat' => 'required',
        'kota' => 'required',
        'provinsi' => 'required',
        'email' => 'required|email',
    ]);

    // Response on validation error
    if ($validator->fails()) {
        return response()->json($validator->errors(), 400);
    }

    try {
        // Update siswa
        $siswa->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'kota' => $request->kota,
            'provinsi' => $request->provinsi,
            'email' => $request->email,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data siswa berhasil diupdate',
            'data' => $siswa
        ], 200);
    } catch (\Exception $e) {
        // Data siswa not found or other exception
        return response()->json([
            'success' => false,
            'message' => 'Terjadi kesalahan saat mengupdate data siswa',
            'error' => $e->getMessage(), // For debugging purposes
        ], 500);
    }
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //find siswa by ID
        $post = Siswa::findOrfail($id);
        if ($post) {
            //delete siswa
            $post->delete();
            return response()->json([
                'success' => true,
                'message' => 'Data siswa berhasil dihapus',
            ], 200);
        }
        //data siswa not found
        return response()->json([
            'success' => false,
            'message' => 'Data tidak ditemukan',
        ], 404);
    }
}
