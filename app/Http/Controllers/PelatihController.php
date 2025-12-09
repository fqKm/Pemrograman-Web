<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelatih;
use App\Models\User; // Import Model User
use App\Models\Role; // Import Model Role
use App\Models\Kelas;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PelatihController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $pelatihs = Pelatih::with('user')->paginate(10);
        return match ($user->role->name) {
            'admin'   => view('admin.pelatih.index', compact('pelatihs')),
            // Pastikan nama view ini sesuai dengan file yang ada di folder resources/views
            'pelatih' => view('pelatih.index', compact('pelatihs')), 
            'member'  => view('member.pelatih.index', compact('pelatihs')),
            // Selalu sediakan default untuk menghindari error jika role tidak dikenali
            default   => view('member.pelatih.index', compact('pelatihs')),
        };
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
            'nama_pelatih' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users', // Email wajib unik di tabel users
            'password' => 'required|string|min:8', // Password untuk login
            'spesialisasi' => 'nullable|string|max:100',
            'nomor_hp' => 'nullable|string|max:20',
        ]);

        $rolePelatih = Role::where('name', 'pelatih')->first();

        $user = User::create([
            'name' => $request->nama_pelatih,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Hash password
            'role_id' => $rolePelatih ? $rolePelatih->id : null,
            'phone' => $request->nomor_hp,
        ]);

        Pelatih::create([
            'user_id' => $user->id, // Ambil ID dari user yang baru dibuat
            'nama_pelatih' => $request->nama_pelatih,
            'spesialisasi' => $request->spesialisasi,
            'tanggal_masuk' => now(), // Set tanggal hari ini
        ]);

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
