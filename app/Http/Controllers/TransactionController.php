<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $rows = Transaction::all();
        return view('backend.content.transaction.list', [
            'rows' => $rows
        ]);
    }

    public function printPDF($id)
    {
        $row = Transaction::with('itemTransactions.album')->findOrFail($id);
        if ($row === null) {
            abort(404);
        }

        $pdf = Pdf::loadView('content.transaction.print-pdf', ['row' => $row])
            ->setPaper('A4');
        return $pdf->stream('Invoice ' . $row->code . '.pdf');
    }
}