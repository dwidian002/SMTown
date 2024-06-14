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
    $transaction = Transaction::query()
        ->with('itemTransactions.album') // Use the correct relationship names
        ->find($id); // Find the transaction by ID

    if ($transaction === null) {
        abort(404);
    }

    // Use Barryvdh\DomPDF\Facade\Pdf;
    $pdf = Pdf::loadView('backend.content.transaction.print-pdf', ['transaction' => $transaction])
        ->setPaper('A4');

    return $pdf->stream('Invoice ' . $transaction->code . '.pdf');
}
}
