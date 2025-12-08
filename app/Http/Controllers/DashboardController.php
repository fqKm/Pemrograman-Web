<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\Pelatih;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function pelatihDashboard()
    {
        $pelatih = Pelatih::where('user_id', Auth::id())->first();

        $kelas = $pelatih->kelas;
        $members = Member::whereHas('kelas', function ($q) use ($pelatih) {
            $q->where('pelatih_id', $pelatih->id);
        })->get();
        return view('pelatih.dashboard', compact('members', 'kelas', 'pelatih'));
    }

    public function memberDashboard()
    {
        return view('members.dashboard');
    }
}