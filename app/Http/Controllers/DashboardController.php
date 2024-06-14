<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Artist;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function index()
    {
        // Mengambil jumlah total data dari masing-masing model
        $totalArtist = Artist::count();
        $totalAlbum = Album::count();
        $totalUser = User::count();
        $totalTransaction = Transaction::count();

        // Mengambil 4 album terbaru beserta gambarnya
        $latestAlbums = Album::orderBy('created_at', 'desc')->take(4)->get();

        // Mengambil 10 transaksi terbaru
        $latestTransactions = Transaction::with('album', 'item_Transaction')->latest()->take(10)->get();

        // Mengirimkan data ke view 'backend.content.dashboard'
        return view('backend.content.dashboard', compact('totalArtist', 'totalAlbum', 'totalUser', 'totalTransaction', 'latestAlbums', 'latestTransactions'));
    }

    public function profile()
    {
        // Mengambil data user yang sedang login
        $id = Auth::guard('user')->user()->id;
        $user = User::findOrFail($id);

        // Mengirimkan data user ke view 'backend.content.profile'
        return view('backend.content.profile', compact('user'));
    }

    public function resetPassword()
    {
        // Menampilkan halaman reset password
        return view('backend.content.resetPassword');
    }

    public function prosesResetPassword(Request $request)
    {
        // Validasi input
        $this->validate($request, [
            'old_password' => 'required',
            'new_password' => 'required|min:6',
            'c_new_password' => 'required_with:new_password|same:new_password|min:6'
        ]);

        // Mengambil user yang sedang login
        $id = Auth::guard('user')->user()->id;
        $user = User::findOrFail($id);

        // Memeriksa password lama
        if (Hash::check($request->old_password, $user->password)) {
            // Jika password lama sesuai, ubah password baru
            $user->password = bcrypt($request->new_password);

            try {
                // Simpan perubahan password
                $user->save();
                return redirect(route('dashboard.resetPassword'))->with('pesan', ['success', 'Berhasil Ubah Password']);
            } catch (\Exception $e) {
                // Tangkap kesalahan jika gagal menyimpan
                return redirect(route('dashboard.resetPassword'))->with('pesan', ['danger', 'Gagal ubah password']);
            }
        } else {
            // Jika password lama tidak sesuai
            return redirect(route('dashboard.resetPassword'))->with('pesan', ['danger', 'Password lama salah']);
        }
    }
}
