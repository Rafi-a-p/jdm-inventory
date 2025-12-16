<?php

namespace App\Http\Controllers;

use App\Models\Sparepart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display the dashboard with summary data.
     */
    public function index()
    {
        $totalSpareparts = Sparepart::count();
        $totalStok = Sparepart::sum('stok');
        $totalNilai = Sparepart::selectRaw('SUM(stok * harga) as total')->value('total') ?? 0;
        $userRole = Auth::user()->role;
        $userName = Auth::user()->name;

        return view('dashboard', compact(
            'totalSpareparts',
            'totalStok',
            'totalNilai',
            'userRole',
            'userName'
        ));
    }
}
