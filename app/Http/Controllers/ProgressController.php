<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Alat;
use App\Models\Kelas;
use App\Models\Kemajuan;
use Illuminate\Http\Request;
use Laravel\Prompts\Progress;
use Mockery\Exception;

class ProgressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $kelas_id)
    {
        $kelas = Kelas::find($kelas_id);
        $alat = Alat::all();
        return view('pelatih.kemajuan.create', compact('alat', 'kelas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'kelas_id' => 'required|integer|exists:kelas,id',
            'alat_id' => 'required|exists:alat,id|integer',
            'nama_latihan' => 'required|string',
            'jumlah_set' => 'integer',
            'jumlah_repetisi' => 'integer',
            'deskripsi' => 'nullable|string',
        ]);

        try {
            $kemajuan = Kemajuan::create($validatedData);
            return redirect()->route('kelas.show', $request->kelas_id)
                ->with('success', 'Berhasil menambah kemajuan');

        } catch (Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal menyimpan: ' . $e->getMessage());
        }
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
        $alat = Alat::all();
        $progress = Kemajuan::find($id);
        return view('pelatih.kemajuan.edit', compact('progress', 'alat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'kelas_id' => 'required|integer|exists:kelas,id',
            'alat_id' => 'required|exists:alat,id|integer',
            'nama_latihan' => 'required|string',
            'jumlah_set' => 'integer',
            'jumlah_repetisi' => 'integer',
            'deskripsi' => 'nullable|string',
        ]);

        try {
            $kemajuan = Kemajuan::find($id)->update($validatedData);
            return redirect()->route('kelas.show', $request->kelas_id)
                ->with('success', 'Berhasil menambah kemajuan');

        } catch (Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal menyimpan: ' . $e->getMessage());
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    function destroy(string $id)
    {
        try {
            $kemajuan = Kemajuan::find($id);
            $kemajuan->delete();
            return redirect()->route('pelatih.kemajuan.index')->with('success', 'Progress berhasil dihapus!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
