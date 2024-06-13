<?php

namespace App\Http\Controllers;

use App\Mail\RegisterMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function index()
    {
        $kasir = User::where('role', 'kasir')->get();
        return view('backend.content.user.list', compact('kasir'));
    }

    public function tambah()
    {
        return view('backend.content.user.formTambah');
    }

    public function prosesTambah(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt('123456');
        $user->role = 'kasir';
        

        try {
            $user->save();
            Mail::to($user->email)->queue(new RegisterMail($user));
            return redirect()->route('user.list')->with('pesan', ['success', 'Berhasil Tambah Data kasir']);
        } catch (\Exception $e) {
            return redirect()->route('user.list')->with('pesan', ['danger', 'Gagal Tambah Data kasir']);
        }
    }

    public function ubah($id)
    {
        $kasir = User::findOrFail($id);
        return view('backend.content.user.formUbah', compact('kasir'));
    }

    public function prosesUbah(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $request->id,
            'password' => 'nullable|string',
        ]);

        $user = User::findOrFail($request->id);
        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        try {
            $user->save();
            return redirect()->route('user.list')->with('pesan', ['success', 'Berhasil Update Data kasir']);
        } catch (\Exception $e) {
            return redirect()->route('user.list')->with('pesan', ['danger', 'Gagal Update Data kasir']);
        }
    }

    public function hapus($id)
    {
        $user = User::findOrFail($id);

        try {
            $user->delete();
            return redirect(route('user.list'))->with('pesan', ['success', 'Berhasil hapus kasir']);
        } catch (\Exception $e) {
            return redirect(route('user.list'))->with('pesan', ['danger', 'Gagal hapus kasir']);
        }
    }
}
