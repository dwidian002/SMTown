<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    protected $table = 'transaction'; // Sesuaikan dengan nama tabel di database Anda
    public function index()
    {
        $rows = Transaction::all();
        return view('backend.content.transaction.list', [
            'rows' => $rows
        ]);
    }

    public function printPDF($id)
    {
        $row = Transaction::with('itemTransaction.album')->findOrFail($id);
        if ($row === null) {
            abort(404);
        }

        $pdf = Pdf::loadView('backend.content.transaction.print-pdf', ['row' => $row])
            ->setPaper('A4');
        return $pdf->stream('Invoice ' . $row->code . '.pdf');
    }
}
