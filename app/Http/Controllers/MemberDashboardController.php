<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Member;
use App\Models\Kelas;
use App\Models\Alat;   

class MemberDashboardController extends Controller
{
    public function index()
    {
        // 1. Ambil User yang sedang login
        $user = Auth::user();

        // 2. Cari data Member berdasarkan user_id
        // Kita gunakan 'with' untuk mengambil data membership sekaligus agar efisien (Eager Loading)
        $member = Member::where('user_id', $user->id)
                        ->with(['membership', 'kelas.pelatih']) 
                        ->first();

        // Cek apakah data member ada (untuk berjaga-jaga jika login sebagai admin tapi buka halaman member)
        if (!$member) {
            return redirect()->route('dashboard')->with('error', 'Data member tidak ditemukan.');
        }

        $availableClasses = Kelas::whereDoesntHave('member', function($query) use ($member) {
                                $query->where('members.id', $member->id);
                            })
                            ->with(['pelatih'])      // Load data pelatih
                            ->withCount('member')    // Hitung jumlah member yang sudah join (untuk kapasitas)
                            ->orderBy('waktu_mulai', 'asc') // Urutkan dari yang terdekat
                            ->limit(6)               // Batasi tampilan (misal 6 kelas)
                            ->get(); // Contoh ambil 3 kelas
                            
        $availableTools = Alat::limit(8)->get();    // Contoh ambil 4 alat

        // 3. Kirim data ke view
        return view('members.dashboard', [
            'user' => $user,
            'member' => $member,
            'membership' => $member->membership, // Data paket membership
            'availableClasses' => $availableClasses,
            'availableTools' => $availableTools,
            // Anda bisa menambahkan data lain seperti sisa hari, dll di sini
        ]);
    }


        public function joinKelas($id)
    {
        $user = Auth::user();
        $member = Member::where('user_id', $user->id)->first();
        $kelas = Kelas::findOrFail($id);

    // Cek kapasitas
    if ($kelas->member()->count() >= $kelas->kapasitas_maksimum) {
        return back()->with('error', 'Kelas sudah penuh!');
    }

    // Cek apakah sudah join (double check)
    if ($kelas->member()->where('member_id', $member->id)->exists()) {
        return back()->with('error', 'Anda sudah terdaftar di kelas ini.');
    }

    // Simpan data
    $kelas->member()->attach($member->id);

    return back()->with('success', 'Berhasil bergabung ke kelas ' . $kelas->nama_kelas);
    }
}