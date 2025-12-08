<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Member;
use App\Models\Pelatih;
use App\Models\Kelas;
use App\Models\Order; // Pastikan model Order sudah ada

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Redirect sesuai Role
        if ($user->isAdmin()) { 
             return redirect()->route('admin.dashboard');
        }
        if ($user->isTrainer()) {
            return redirect()->route('pelatih.dashboard');
        }
        if ($user->isMember()) {
            return redirect()->route('members.dashboard');
        }

        return view('dashboard');
    }

    public function pelatihDashboard()
    {
        $pelatih = Pelatih::where('user_id', Auth::id())->first();

        $kelas = $pelatih->kelas;
        $members = Member::whereHas('kelas', function ($q) use ($pelatih) {
            $q->where('pelatih_id', $pelatih->id);
        })->get();
        return view('pelatih.dashboard', compact('members', 'kelas', 'pelatih'));
    }

    // --- LOGIKA DASHBOARD ADMIN ---
    public function adminDashboard()
    {
        // 1. Statistik Utama (Card Atas)
        $totalMembers = Member::count();
        $activeMembers = Member::where('status', 'aktif')->count();
        $totalTrainers = Pelatih::count();
        $totalClasses = Kelas::count();

        // 2. Hitung Pendapatan (Total dari pesanan yang sudah 'paid')
        $totalRevenue = Order::where('payment_status', 'paid')->sum('total_amount');

        // 3. Transaksi Terbaru (5 data terakhir untuk tabel)
        $recentOrders = Order::with(['user', 'membership']) // Eager load relasi
                             ->orderBy('created_at', 'desc')
                             ->limit(5)
                             ->get();

        return view('admin.dashboard', compact(
            'totalMembers', 
            'activeMembers', 
            'totalTrainers', 
            'totalClasses', 
            'totalRevenue', 
            'recentOrders'
        ));
    }
}