<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Kelas;
use App\Models\Pelatih;
use App\Models\Alat;
use App\Models\Membership;
use App\Models\Order;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $memberCount = Member::count();
        $kelasCount = Kelas::count();
        $pelatihCount = Pelatih::count();
        $alatCount = Alat::count();
        $membershipCount = Membership::count();
        $recentOrders = Order::latest()->take(5)->get(); // 5 order terbaru

        return view('admin.dashboard', compact(
            'memberCount', 
            'kelasCount', 
            'pelatihCount', 
            'alatCount', 
            'membershipCount', 
            'recentOrders'
        ));
    }
}
