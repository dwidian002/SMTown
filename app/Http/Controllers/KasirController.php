<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\ItemTransaction;
use App\Models\Transaction;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class KasirController extends Controller
{
    public function index()
    {
        return view('backend.content.kasir.index');
    }

    public function searchProduct(Request $request)
    {
        // Search for an album based on barcode
        $album = Album::where('barcode', $request->barcode)->first();
        if ($album === null) {
            return response()->json([], 404);
        }
        return response()->json($album);
    }

    public function insert(Request $request)
    {


        $request->validate([
            'id_album' => 'required|array',
            'id_album.' => 'exists:albums,id',
            'price' => 'required|array',
            'price.*' => 'numeric|min:0',
            'qty' => 'required|array',
            'qty.*' => 'numeric|min:1',
            'discount' => 'nullable|numeric|min:0|max:100',
        ]);

        DB::beginTransaction();
        try {
            // Generate transaction code with prefix
            $prefix = 'INV/' . date('ym') . '/';
            $code = Transaction::getLastCode($prefix);

            // Create new transaction record
            $transaction = new Transaction();
            $transaction->code = $code;
            $transaction->date = now()->format('Y-m-d');
            $transaction->subtotal = 0;
            $transaction->discount = 0;
            $transaction->total = 0;
            $transaction->created_by = Auth::id();
            $transaction->save();
            Log::info('Transaction saved:', ['transaction_id' => $transaction->id]);

            // Calculate subtotal and create item transactions
            $subtotal = 0;
            $itemCount = count($request->price);
            for ($i = 0; $i < $itemCount; $i++) {
                $it = new ItemTransaction();
                $it->id_transaksi = $transaction->id; // Corrected 'id_transaction' to 'transaction_id'
                $it->id_album = $request->id_album[$i]; // Corrected 'id_album' to 'album_id'
                $it->price = $request->price[$i];
                $it->qty = $request->qty[$i];
                $it->total = (int)$it->price * (int)$it->qty;
                $it->save();
                Log::info('ItemTransaction saved:', ['item_transaction_id' => $it->id]);

                $subtotal += $it->total;
                dd($subtotal += $it->total);
            }

            // Apply discount and update transaction totals
            $transaction->subtotal = $subtotal;
            if ($request->has('discount')) {
                $discount = $subtotal * (int)$request->discount / 100;
                $transaction->discount = $request->discount;
            }
            $transaction->total = $subtotal - $discount;
            $transaction->save();
            Log::info('Transaction updated:', ['transaction_id' => $transaction->id, 'subtotal' => $subtotal, 'discount' => $transaction->discount, 'total' => $transaction->total]);

            // Commit the transaction to database
            DB::commit();
            return redirect()->back()->with('berhasil', 'Transaksi Berhasil');
        } catch (Exception $e) {
            // Rollback transaction on error and log the error
            DB::rollBack();
            Log::error('Transaction Error: ', ['error' => $e->getMessage()]);
            return redirect()->back()->with('gagal', 'Transaksi Gagal');
        }
    }
}
