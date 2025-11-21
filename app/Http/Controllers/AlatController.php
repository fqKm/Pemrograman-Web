<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Alat;
use Illuminate\Http\Request;

class AlatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $alat = Alat::latest()->paginate(10);
        return view('admin.alat.index', compact('alat'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.alat.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_alat' => 'required',
            'jumlah' => 'required|integer',
            'tanggal_pembelian' => 'nullable|date',
        ]);

        $alat = Alat::where('nama_alat', ($validated['nama_alat']))->first();
        if ($alat) {
            $alat->jumlah += $validated['jumlah'];
            if (!empty($validated['tanggal_pembelian'])) {
                $alat->tanggal_pembelian = $validated['tanggal_pembelian'];
            }
            $alat->save();
        } else {
            if (empty($validated['tanggal_pembelian'])) {
                $validated['tanggal_pembelian'] = now();
            }
            Alat::create($validated);
        }
        return redirect()->route('alat.index')
            ->with('success', 'Alat Berhasil Ditambahkan');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $alat = Alat::find($id)->first();
        if ($alat) {
            return view('admin.alat.view', compact('alat'));
        }
        return redirect()->route('admin.alat.index')->with('error', 'Alat Tidak Ditemukan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $alat = Alat::find($id)->first();
        if ($alat) {
            return view('admin.alat.edit', compact('alat'));
        }
        return redirect()->route('admin.alat.index')->with('error', 'Alat Tidak Ditemukan');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated_request = $request->validate([
            'nama_alat' => 'string',
            'jumlah' => 'integer',
            'terpakai'=> 'integer',
            'tanggal_pembelian' => 'date',
        ]);
        Alat::findOrFail($id)->update($validated_request);

        return redirect()->route('alat.index')->with('success', 'Alat Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Alat::find($id)->delete();
        return redirect()->route('alat.index')->with('success', 'Alat Berhasil Dihapus');
    }
}
