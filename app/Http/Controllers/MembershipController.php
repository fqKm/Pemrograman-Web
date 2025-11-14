<?php

namespace App\Http\Controllers;

use App\Models\Membership;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

class MembershipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $membership = Membership::paginate(10);
        if($membership->total() == 0){
            return view('admin.membership.index')->with('message', "Membership Not Found Please, Make One of Them");
        }
        return view('admin.membership.index', compact('membership'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.membership.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_plan' => 'required|string|max:255',
            'durasi' => 'required',
            'harga' => 'required',
        ]);
        $membership = Membership::create($request->all());
        return redirect()->route('admin.membership.index')
            ->with('success', 'Membership Berhasil Dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $membership = Membership::with('members')->find($id);
        if (!$membership) {
            return redirect()->route('admin.membership.index')
                ->with('error', 'Membership yang Anda cari tidak ditemukan.');
        }
        return view('admin.membership.view', compact('membership'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $membership = Membership::find($id);
        if (!$membership) {
            return redirect()->route('admin.membership.index')
                ->with('error', 'Membership yang Anda cari tidak ditemukan.');
        }
        return view('admin.membership.edit', compact('membership'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_plan' => 'required|string|max:255',
            'durasi' => 'required',
            'harga' => 'required',
        ]);
        $membership = Membership::find($id);
        if (!$membership) {
            return redirect()->route('admin.membership.index')
                ->with('error', 'Membership yang Anda cari tidak ditemukan.');
        }
        $membership->update($request->all());
        return redirect()->route('admin.membership.index')
            ->with('success', 'Membership Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $membership = Membership::find($id);
        DB::beginTransaction();
        try {
            DB::commit();
            $membership->delete();
            return redirect()->route('admin.membership.index')
                ->with('success', 'Membership Berhasil Dihapus');
        } catch (Exception $exception) {
            DB::rollBack();
            return redirect()->route('admin.membership.index')
                ->with('error', 'gagal menghapus data'.$exception->getMessage());
        }
    }
}
