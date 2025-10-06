<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Membership;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $members = Member::with('membership')->latest()->paginate(10);
        return view('members.index', compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $memberships = Membership::all(); 
        return view('members.create', compact('memberships'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nomor_hp' => 'nullable|string|max:20',
            'email' => 'required|email|max:255|unique:members',
            'tanggal_lahir' => 'required|date',
            'tanggal_bergabung' => 'required|date',
            'status' => 'required|string|in:aktif,tidak aktif',
            'membership_id' => 'required|exists:membership,id',
        ]);

        Member::create($request->all());

        return redirect()->route('members.index')
                         ->with('success', 'Member baru berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Member $member)
    {
        return view('members.view', compact('member'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Member $member)
    {
        $memberships = Membership::all(); 
        return view('members.edit', compact('member', 'memberships'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Member $member)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nomor_hp' => 'nullable|string|max:20',
            'email' => 'required|email|max:255|unique:members,email,' . $member->id,
            'tanggal_lahir' => 'required|date',
            'tanggal_bergabung' => 'required|date',
            'status' => 'required|string|in:aktif,tidak aktif',
            'membership_id' => 'required|exists:membership,id',
        ]);

        $member->update($request->all());

        return redirect()->route('members.index')
                         ->with('success', 'Data member berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Member $member)
    {

        $member->kemajuan()->delete();
        $member->delete();
        return redirect()->route('members.index')
                         ->with('success', 'Member dan semua data kemajuannya berhasil dihapus!');
    }
}
