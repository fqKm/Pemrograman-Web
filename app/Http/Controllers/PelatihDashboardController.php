<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pelatih;
use App\Models\Kelas;

class PelatihDashboardController extends Controller
{
    /**
     * Menampilkan dashboard khusus untuk pelatih.
     */
    public function index()
    {
        // // 1. Dapatkan user yang sedang login
        // $user = Auth::user();

        // // 2. Cari data 'pelatih' berdasarkan email user yang login
        // // (Berdasarkan seeder, Anda menghubungkan User dan Pelatih via email)
        // $pelatih = Pelatih::where('email', $user->email)->firstOrFail();

        // // 3. Ambil semua kelas yang diajar oleh pelatih ini
        // // Ini menggunakan relasi 'kelas' yang kita buat di Langkah 1
        // $kelasDiajar = $pelatih->kelas()->paginate(5);

        // // 4. Tampilkan view dan kirim datanya
        return view('pelatih.dashboard', compact('pelatih', 'kelasDiajar'));
    }
}