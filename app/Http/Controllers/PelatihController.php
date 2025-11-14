<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelatih;
use App\Models\Kelas;

class PelatihController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pelatihs = Pelatih::latest()->paginate(10);
        return view('admin.pelatih.index', compact('pelatihs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pelatih.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_pelatih' => 'required|string|max:100',
            'spesialisasi' => 'nullable|string|max:100',
            'tanggal_masuk' => 'required|date',
        ]);

        Pelatih::create($request->all());

        return redirect()->route('admin.pelatih.index')->with('success', 'Pelatih baru berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pelatih $pelatih)
    {
        $pelatih->load('kelas'); 
        return view('admin.pelatih.view', compact('pelatih'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pelatih $pelatih)
    {
        return view('admin.pelatih.edit', compact('pelatih'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pelatih $pelatih)
    {
        $request->validate([
            'nama_pelatih' => 'required|string|max:100',
            'spesialisasi' => 'nullable|string|max:100',
            'tanggal_masuk' => 'required|date',
        ]);

        $pelatih->update($request->all());

        return redirect()->route('admin.pelatih.index')->with('success', 'Data pelatih berhasil diupdate!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pelatih $pelatih)
    {
        if ($pelatih->kelas()->exists()) {
            return redirect()->route('admin.pelatih.index')->with('error', 'Gagal! Pelatih ini tidak bisa dihapus karena masih terdaftar di sebuah kelas.');
        }

        $pelatih->delete();

        return redirect()->route('admin.pelatih.index')->with('success', 'Pelatih berhasil dihapus!');
    }
}
