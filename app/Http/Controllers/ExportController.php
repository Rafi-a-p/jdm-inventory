<?php

namespace App\Http\Controllers;

use App\Exports\SparepartsExport;
use App\Exports\TransactionsExport;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    /**
     * Export spareparts to Excel.
     */
    public function spareparts(Request $request)
    {
        $filename = 'data-sparepart-' . now()->format('Y-m-d-His') . '.xlsx';
        return Excel::download(new SparepartsExport($request->category_id), $filename);
    }

    /**
     * Export transactions to Excel.
     */
    public function transactions(Request $request)
    {
        $filename = 'data-transaksi-' . now()->format('Y-m-d-His') . '.xlsx';

        $userId = null;
        if (Auth::user()->role !== 'admin') {
            $userId = Auth::id();
        }

        return Excel::download(
            new TransactionsExport(
                $request->from_date,
                $request->to_date,
                $request->type,
                $userId
            ),
            $filename
        );
    }
}
