<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Artist;
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
        $artist = Artist::all();
        return view("backend.content.album.formTambah",compact('artist'));
    }

    public function prosesTambah(Request $request)
    {
        $this->validate($request, [
            'name_album' => 'required',
            'gambar_album' => 'required',
            'genre' => 'required',
            'barcode' => 'required',
            'id_artist' => 'required',
            'price' => 'required',
        ]);

        $request->file('gambar_album')->store('public');
        $gambar_album = $request->file('gambar_album')->hashName();

        $album = new Album();
        $album->name_album = $request->name_album;
        $album->gambar_album = $gambar_album;
        $album->genre = $request->genre;
        $album->barcode = $request->barcode;
        $album->id_artist = $request->id_artist;
        $album->price = $request->price;

        try {
            $album->save();
            return redirect(route('album.index'))->with('pesan', ['success', 'Berhasil Tambah album']);
        } catch (\Exception $e) {
            return redirect(route('album.index'))->with('pesan', ['danger', 'Gagal Tambah album']);
        }
    }
    public function ubah($id)
    {
        $album = Album::findOrFail($id);
        $artist = Artist::all();
        return view('backend.content.album.formUbah', compact('album', 'artist'));
    }
    public function prosesUbah(Request $request)
    {
        $this->validate($request, [
            'name_album' => 'required',
            'genre' => 'required',
            'barcode' => 'required',
            'id_artist' => 'required',
            'price' => 'required',
        ]);

        $album = Album::findOrFail($request->id_album);
        $album->name_album = $request->name_album;
        $album->genre = $request->genre;
        $album->barcode = $request->barcode;
        $album->id_artist = $request->id_artist;
        $album->price = $request->price;

        if ($request->hasFile('gambar_album')) {
            $request->file('gambar_album')->store('public');
            $gambar_album = $request->file('gambar_album')->hashName();
            $album->gambar_album = $gambar_album;
        }

        try {
            $album->save();
            return redirect(route('album.index'))->with('pesan', ['success', 'Berhasil Ubah album']);
        } catch (\Exception $e) {
            return redirect(route('album.index'))->with('pesan', ['danger', 'Gagal Ubah album']);
        }
    }
    public function hapus($id)
    {
        $album = Album::findOrFail($id);

        try {
            $album->delete();
            return redirect(route('album.index'))->with('pesan', ['success', 'Berhasil Hapus album']);
        } catch (\Exception $e) {
            return redirect(route('album.index'))->with('pesan', ['danger', 'Gagal Hapus album']);
        }
    }
}
