<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActivityLogController extends Controller
{
    /**
     * Display a listing of activity logs.
     * Admin sees all logs, staff see only their own.
     */
    public function index(Request $request)
    {
        $query = ActivityLog::with('user')->latest();

        if (Auth::user()->role !== 'admin') {
            $query->where('user_id', Auth::id());
        }

        // Filter by action
        if ($request->filled('action')) {
            $query->where('action', $request->action);
        }

        // Filter by subject type
        if ($request->filled('subject_type')) {
            $query->where('subject_type', $request->subject_type);
        }

        // Filter by user (admin only)
        if ($request->filled('user_id') && Auth::user()->role === 'admin') {
            $query->where('user_id', $request->user_id);
        }

        // Filter by date
        if ($request->filled('from_date')) {
            $query->whereDate('created_at', '>=', $request->from_date);
        }
        if ($request->filled('to_date')) {
            $query->whereDate('created_at', '<=', $request->to_date);
        }

        // Search in description
        if ($request->filled('search')) {
            $query->where('description', 'like', '%' . $request->search . '%');
        }

        $logs = $query->paginate(20)->withQueryString();

        $users = Auth::user()->role === 'admin'
            ? User::orderBy('name')->get(['id', 'name', 'email'])
            : collect();

        $actionOptions = [
            'login' => 'Login',
            'logout' => 'Logout',
            'create' => 'Tambah Data',
            'update' => 'Ubah Data',
            'delete' => 'Hapus Data',
            'transaction_masuk' => 'Barang Masuk',
            'transaction_keluar' => 'Barang Keluar',
        ];

        $subjectTypeOptions = [
            'sparepart' => 'Sparepart',
            'transaction' => 'Transaksi',
            'category' => 'Kategori',
            'user' => 'User',
        ];

        return view('activity-logs.index', compact('logs', 'users', 'actionOptions', 'subjectTypeOptions'));
    }
}
