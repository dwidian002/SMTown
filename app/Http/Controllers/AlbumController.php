<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    public function index()
    {
        $album = Album::with('artist')->get();
        return view('backend.content.album.list', compact('album'));
    }
    public function tambah()
    {
        
    }
    public function prosesTambah(Request $request)
    {
    }
    public function ubah($id)
    {
    }
    public function prosesUbah(Request $request)
    {
    }
    public function hapus($id)
    {
    }
}
