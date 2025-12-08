<?php

namespace App\Http\Controllers;

use App\Models\Kemajuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Member;
use App\Models\Kelas;
use App\Models\Alat;
use App\Models\KemajuanMember;
use App\Models\Membership;

class MemberDashboardController extends Controller
{
    public function index()
    {
        // 1. Ambil User yang sedang login
        $user = Auth::user();

        // 2. Cari data Member berdasarkan user_id
        $member = Member::where('user_id', $user->id)
                        ->with(['membership', 'kelas.pelatih'])
                        ->first();

        // Cek apakah data member ada (untuk berjaga-jaga jika login sebagai admin tapi buka halaman member)
        if (!$member) {
            return redirect()->route('dashboard')->with('error', 'Data member tidak ditemukan.');
        }

        $membershipsPlans = Membership::all();

        $availableTools = Alat::limit(8)->get();    // Contoh ambil 4 alat

        $progressHistory = KemajuanMember::where('member_id', $member->id)
                        ->with('kemajuan')
                        ->orderBy('created_at', 'desc')
                        ->limit(5)
                        ->get();

        $workoutsThisMonth = KemajuanMember::where('member_id', $member->id)
                        ->whereMonth('created_at', now()->month)
                        ->count();

        // 3. Kirim data ke view
        return view('members.dashboard', [
            'user' => $user,
            'member' => $member,
            'membership' => $member->membership, // Data paket membership
            'availableTools' => $availableTools,
            'progressHistory' => $progressHistory,
            'workoutsThisMonth' => $workoutsThisMonth,
            'membershipsPlans' => $membershipsPlans,
            // Anda bisa menambahkan data lain seperti sisa hari, dll di sini
        ]);
    }

    public function kelas()
    {
        $user = auth()->user();
        $member = Member::where('user_id', $user->id)->first();

        // 1. Ambil Kelas Saya (yang sudah di-join)
        $myClasses = $member->kelas()->with('pelatih')->get();

        // 2. Ambil Kelas Tersedia (yang belum di-join)
        $availableClasses = Kelas::whereDoesntHave('member', function($query) use ($member) {
                                $query->where('members.id', $member->id);
                            })
                            ->with(['pelatih'])
                            ->withCount('member')
                            ->orderBy('waktu_mulai', 'asc')
                            ->get();

        return view('members.kelas.index', compact('myClasses', 'availableClasses'));
    }

    // 2. HALAMAN DETAIL KELAS (READ ONLY)
    public function show($id)
    {
        $user = Auth::user();
        $member = Member::where('user_id', $user->id)->first();

        // Ambil detail kelas beserta pelatih dan hitung member
        $kelas = Kelas::with(['pelatih', 'member'])->withCount('member')->findOrFail($id);
        $progress = KemajuanMember::with('kemajuan')
            ->where('member_id', $member->id)
            ->whereHas('kemajuan', function ($q) use ($kelas) {
                $q->where('kelas_id', $kelas->id);
            })
            ->get();

        // Cek status apakah member sudah join kelas ini
        $isJoined = $kelas->member->contains($member->id);

        return view('members.kelas.show', compact('kelas', 'isJoined', 'progress'));
    }


        public function joinKelas($id)
    {
        $user = Auth::user();
        $member = Member::where('user_id', $user->id)->first();
        $kelas = Kelas::findOrFail($id);

    if (!$member) {
        return redirect()->back()->with('error', 'Anda belum terdaftar sebagai member.');
    }

    if ($member->status !== 'aktif') {
        return redirect()->route('membership.index') // Arahkan untuk beli membership
            ->with('error', 'Membership Anda tidak aktif. Silakan berlangganan untuk booking kelas.');
    }

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
