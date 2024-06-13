<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\ItemTransaction;
use App\Models\Transaction;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KasirController extends Controller
{
    public function index()
    {
        return view('backend.content.kasir.index');
    }

    public function searchProduct(Request $request)
    {
        $album = Album::query()->where('barcode', $request->barcode)->first();
        if ($album === null) {
            return response()->json([], 404);
        }
        return response()->json($album);
    }

    public function insert(Request $request)
    {
        DB::beginTransaction();
        try {
            $prefix = 'INV/' . date('ym') . '/';
            $code = Transaction::getLastCode($prefix);
            $transaction = new Transaction();
            $transaction->code = $code;
            $transaction->date = date('Y-m-d');
            $transaction->subtotal = 0;
            $transaction->discount = 0;
            $transaction->total = 0;
            $transaction->created_by = Auth::id();
            $transaction->save();

            $subtotal = 0;
            $itemCount = count($request->price);
            for ($i = 0; $i < $itemCount; $i++) {
                $it = new ItemTransaction();
                $it->id_transaction = $transaction->id_transaction;
                $it->id_album = $request->id_album[$i];
                $it->price = $request->price[$i];
                $it->qty = $request->qty[$i];
                $it->total = (int)$it->price * (int)$it->qty;
                $it->save();
                $subtotal += $it->total;
            }
            $transaction->subtotal = $subtotal;
            $discount = $subtotal * (int)$request->discount / 100;
            $transaction->discount = $request->discount;
            $transaction->total = $subtotal - $discount;
            $transaction->save();

            DB::commit();
            return redirect()->back()->with('berhasil', 'Transaksi Berhasil');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('gagal', 'Transaksi Gagal');
        }
    }
}
