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
    public function index(){
        $totalArtist = Artist::count();
        $totalAlbum = Album::count();
        $totalUser = User::count();
        $totalTransaction = Transaction::count();

        $latestTransaction = Transaction::with('album','item_Transaction')->latest()->get()->take(10);
        return view('backend.content.dashboard', compact('totalArtist', 'totalAlbum', 'totalUser', 'totalUser','totalTransaction','latestTransaction'));
    }

    public function profile()
    {
        $id = Auth::guard('user')->user() -> id;
        $user = User::findOrFail($id);
        return view('backend.content.profile',compact('user'));

    }
    public function resetPassword()
    {
        return view('backend.content.resetPassword');
    }

    public function prosesResetPassword(Request $request)
    {
        $this->validate($request, [
            'old_password' => 'required',
            'new_password' => 'required|min:6',
            'c_new_password' => 'required_with:new_password|same:new_password|min:6'
        ]);

        $old_password = $request->old_password;
        $new_password = $request->new_password;

        $id = Auth::guard('user')->user()->id;
        $user = User::findOrFail($id);

        if (Hash::check($old_password, $user->password)) {
            $user->password = bcrypt($new_password);

            try {
                $user->save();
                return redirect(route('dashboard.resetPassword'))->with('pesan', ['success', 'Berhasil Ubah Password']);

            } catch (\Exception $e) {
                return redirect(route('dashboard.resetPassword'))->with('pesan', ['danger', 'Gagal ubah password']);

            }
        } else {
            return redirect(route('dashboard.resetPassword'))->with('pesan', ['danger', 'Password lama salah']);

        }
    }
}
