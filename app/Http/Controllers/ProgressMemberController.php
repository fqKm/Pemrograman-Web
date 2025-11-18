<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\KemajuanMember;
use App\Models\Member;
use Illuminate\Http\Request;

class ProgressMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $kelasId = $request->kelas_id;
        $memberId = $request->member_id;

        $kelas = Kelas::with('pelatih')->findOrFail($kelasId);
        $member = Member::findOrFail($memberId);

        $progress = KemajuanMember::with('kemajuan')
            ->where('member_id', $memberId)
            ->whereHas('kemajuan', function ($q) use ($kelasId) {
                $q->where('kelas_id', $kelasId);
            })
            ->get();

        return view('pelatih.progressmember.index', compact('kelas', 'member', 'progress'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $progress = KemajuanMember::findOrFail($id);

        $progress->update([
            'is_done'      => $request->is_done ?? 0,
            'deskripsi'    => $request->deskripsi,
            'completed_at' => now(),
            'trainer_id'   => auth()->id(),
        ]);

        return back()->with('success', 'Progress berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
