<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Gallery;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        if (Auth::user()->email !== 'admin@admin.com') {
            return redirect('/')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        $galleries = Gallery::all();
        return view('admin.gallery-ubah', compact('galleries'));
    }

    public function indexhome()
    {
        // Mengambil semua data gallery
        $galleries = Gallery::all();
    
        // Mengirimkan data ke view
        return view('admin.gallery', compact('galleries'));
    }
    public function indexdelete()
    {
        if (Auth::user()->email !== 'admin@admin.com') {
            return redirect('/')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        $galleries = Gallery::all();
        return view('admin.gallery-delete', compact('galleries'));
    }
    public function utama()
    {
        // Mengambil semua data gallery
        $galleries = Gallery::all();
    
        // Mengirimkan data ke view
        return view('home', compact('galleries'));
    }

    public function store(Request $request)
    {
    // Validasi input
    $request->validate([
        'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',  // Validasi file yang diupload
        'keterangan' => 'nullable|string',  // Validasi keterangan jika diperlukan
    ]);

    // Proses file jika ada
    if ($request->hasFile('file')) {
        // Mendapatkan file yang di-upload
        $file = $request->file('file');

        // Mendapatkan nama asli file
        $originalFileName = $file->getClientOriginalName();

        // Simpan file di folder public/images dengan nama file asli
        $filePath = $file->storeAs('images', $originalFileName, 'public');

        // Simpan informasi file ke database
        Gallery::create([
            'file_path' => $filePath,
            'keterangan' => $request->input('keterangan'),
        ]);
    }

    // Kembali ke halaman dengan notifikasi sukses
    return back()->with('success', 'Image uploaded successfully');
}
    
public function delete($id)
{
    $gallery = Gallery::findOrFail($id);
    $filePath = storage_path('app/public/' . $gallery->file_path);

    if (file_exists($filePath)) {
        unlink($filePath); // Menghapus file gambar
    }

    $gallery->delete(); // Menghapus data dari database

    return response()->json(['success' => true]);
}
}

