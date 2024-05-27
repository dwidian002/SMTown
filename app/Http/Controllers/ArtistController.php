<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use App\Models\Kategori;
use Illuminate\Http\Request;

class ArtistController extends Controller
{
    public function index()
    {
        $artist = Artist::with('kategori')->get();
        return view('backend.content.artist.list', compact('artist'));
    }

    public function tambah()
    {
        $kategori = Kategori::all();
        return view('backend.content.artist.formTambah', compact('kategori'));
    }

    public function prosesTambah(Request $request)
    {
        $this->validate($request, [
            'nama_artist' => 'required',
            'id_kategori' => 'required',
            'description' => 'required',
            'gambar_artist' => 'required',
        ]);

        $request->file('gambar_artist')->store('public');
        $gambar_artist = $request->file('gambar_artist')->hashName();

        $artist = new Artist();
        $artist->nama_artist = $request->nama_artist;
        $artist->id_kategori = $request->id_kategori;
        $artist->description = $request->description;
        $artist->gambar_artist = $gambar_artist;

        try {
            $artist->save();
            return redirect(route('artist.index'))->with('pesan', ['success', 'Berhasil Tambah artist']);
        } catch (\Exception $e) {
            return redirect(route('artist.index'))->with('pesan', ['danger', 'Gagal Tambah artist']);
        }
    }

    public function ubah($id)
    {
        $artist = Artist::findOrFail($id);
        $kategori = Kategori::all();
        return view('backend.content.artist.formUbah', compact('artist', 'kategori'));
    }

    public function prosesUbah(Request $request)
    {
        $this->validate($request, [
            'nama_artist' => 'required',
            'id_kategori' => 'required',
            'description' => 'required',
        ]);

        $artist = Artist::findOrFail($request->id_artist);
        $artist->nama_artist = $request->nama_artist;
        $artist->description = $request->description;
        $artist->id_kategori = $request->id_kategori;

        if ($request->hasFile('gambar_artist')) {
            $request->file('gambar_artist')->store('public');
            $gambar_artist = $request->file('gambar_artist')->hashName();
            $artist->gambar_artist = $gambar_artist;
        }

        try {
            $artist->save();
            return redirect(route('artist.index'))->with('pesan', ['success', 'Berhasil Ubah Data Artist']);
        } catch (\Exception $e) {
            return redirect(route('artist.index'))->with('pesan', ['danger', 'Gagal Ubah Data Artist']);
        }
    }

    public function hapus($id)
    {
        $artist = Artist::findOrFail($id);

        try {
            $artist->delete();
            return redirect(route('artist.index'))->with('pesan', ['success', 'Berhasil Hapus Data artist']);
        } catch (\Exception $e) {
            return redirect(route('artist.index'))->with('pesan', ['danger', 'Gagal Hapus Data artist']);
        }
    }
}
