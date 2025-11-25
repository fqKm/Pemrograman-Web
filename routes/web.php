<?php

use App\Http\Controllers\AlatController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PelatihController;
use App\Http\Controllers\PelatihDashboardController;
use App\Http\Controllers\MemberDashboardController;

use App\Http\Controllers\ProgressController;
use App\Http\Controllers\ProgressMemberController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $user = auth()->user();

    if ($user->isTrainer()) {
        return redirect()->route('pelatih.dashboard');
    }

    if ($user->isMember()) {
        return redirect()->route('members.dashboard');
    }

    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/pelatih/dashboard', [DashboardController::class, 'pelatihDashboard'])
    ->middleware(['auth', 'permission:lihat_akun_pelatih'])
    ->name('pelatih.dashboard');

Route::get('/members/dashboard', [MemberDashboardController::class, 'index'])
    ->middleware(['auth', 'permission:lihat_akun_member'])
    ->name('members.dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    // URL: /admin/members
    // Nama Route: admin.members.index
    Route::resource('members', MemberController::class);

    // URL: /admin/kelas
    // Nama Route: admin.kelas.index
    Route::resource('kelas', KelasController::class);

    // URL: /admin/pelatih
    // Nama Route: admin.pelatih.index
    Route::resource('pelatih', PelatihController::class);

    // URL: /admin/membership
    // Nama Route: admin.membership.index
    Route::resource('membership', MembershipController::class);

    Route::middleware(['auth', 'permission:request_kelas'])->group(function () {
        Route::get('kelas/request', [KelasController::class, 'requestKelas'])->name('kelas.request');
    });

    Route::middleware(['auth', 'permission:lihat_kelas'])->group(function () {
        Route::get('kelas', [KelasController::class, 'index'])->name('kelas.index');
        Route::get('kelas/view/{id_kelas}', [KelasController::class, 'show'])->name('kelas.show');
    });

    Route::middleware(['auth', 'permission:lihat_member_kelas'])->group(function () {
        Route::get('kelas/{id}/member', [KelasController::class, 'memberList'])->name('kelas.member');
    });

    Route::middleware(['auth', 'permission:buat_kelas'])->group(function () {
        Route::get('kelas/create', [KelasController::class, 'create'])->name('kelas.create');
        Route::post('kelas', [KelasController::class, 'store'])->name('kelas.store');
    });

    Route::middleware(['auth', 'permission:ubah_kelas'])->group(function () {
        Route::get('kelas/{id}/edit', [KelasController::class, 'edit'])->name('kelas.edit');
        Route::put('kelas/{id}', [KelasController::class, 'update'])->name('kelas.update');
    });

    Route::middleware(['auth', 'permission:hapus_kelas'])->group(function () {
        Route::delete('kelas/{id}', [KelasController::class, 'destroy'])->name('kelas.destroy');
    });

    Route::middleware(['auth', 'permission:lihat_member_membership'])->group(function () {
    });

    Route::middleware(['auth', 'permission:tambah_membership'])->group(function () {
        Route::get('membership/create', [MembershipController::class, 'create'])->name('membership.create');
        Route::post('membership', [MembershipController::class, 'store'])->name('membership.store');
    });

    Route::middleware(['auth', 'permission:ubah_membership'])->group(function () {
        Route::get('membership/{id}/edit', [MembershipController::class, 'edit'])->name('membership.edit');
        Route::put('membership/{id}', [MembershipController::class, 'update'])->name('membership.update');
    });

    Route::middleware(['auth', 'permission:hapus_membership'])->group(function () {
        Route::delete('membership/{id}', [MembershipController::class, 'destroy'])->name('membership.destroy');
    });

    Route::middleware(['auth', 'permission:lihat_daftar_membership'])->group(function () {
        Route::get('membership', [MembershipController::class, 'index'])->name('membership.index');
        Route::get('membership/{id}', [MembershipController::class, 'show'])->name('membership.show');
    });


    Route::middleware(['auth', 'permission:buat_progress'])->group(function () {
        Route::get('progress/create/{kelas_id}', [ProgressController::class, 'create'])->name('progress.create');
        Route::post('progress', [ProgressController::class, 'store'])->name('progress.store');
    });

    Route::middleware(['auth', 'permission:lihat_progress'])->group(function () {
        Route::get('progress', [ProgressController::class, 'progress'])->name('progress.index');
    });

    Route::middleware(['auth', 'permission:ubah_progress'])->group(function () {
        Route::get('progress/edit/{id}', [ProgressController::class, 'edit'])->name('progress.edit');
        Route::put('progress/edit/{id}', [ProgressController::class, 'update'])->name('progress.update');
    });

    Route::middleware(['auth', 'permission:hapus_progress'])->group(function () {
    });

    Route::middleware(['auth', 'permission:lihat_alat'])->group(function () {
        Route::get('alat', [AlatController::class, 'index'])->name('alat.index');
        Route::get('alat/show/{id}', [AlatController::class, 'show'])->name('alat.show');
    });

    Route::middleware(['auth', 'permission:tambah_alat'])->group(function () {
        Route::get('alat/create', [AlatController::class, 'create'])->name('alat.create');
        Route::post('alat', [AlatController::class, 'store'])->name('alat.store');
    });

    Route::middleware(['auth', 'permission:ubah_alat'])->group(function () {
        Route::get('alat/edit/{id}', [AlatController::class, 'edit'])->name('alat.edit');
        Route::put('alat/edit/{id}', [AlatController::class, 'update'])->name('alat.update');
    });

    Route::middleware(['auth', 'permission:hapus_alat'])->group(function () {
        Route::delete('alat/delete/{id}', [AlatController::class, 'destroy'])->name('alat.destroy');
    });

    Route::middleware(['auth', 'permission:lihat_akun_member'])->group(function () {
        Route::get('member', [MemberController::class, 'index'])->name('member.index');
        Route::get('member/{id}', [MemberController::class, 'show'])->name('member.show');
    });

    Route::middleware(['auth', 'permission:ubah_akun_member'])->group(function () {
        Route::get('member/{id}/edit', [MemberController::class, 'edit'])->name('member.edit');
        Route::put('member/{id}', [MemberController::class, 'update'])->name('member.update');
    });

    Route::middleware(['auth', 'permission:hapus_akun_member'])->group(function () {
        Route::delete('member/{id}', [MemberController::class, 'destroy'])->name('member.destroy');
    });

    Route::middleware(['auth', 'permission:lihat_akun_pelatih'])->group(function () {
        Route::get('pelatih', [PelatihController::class, 'index'])->name('pelatih.index');
    });

    Route::middleware(['auth', 'permission:tambah_akun_pelatih'])->group(function () {
        Route::get('pelatih/create', [PelatihController::class, 'create'])->name('pelatih.create');
    });

    Route::middleware(['auth', 'permission:ubah_akun_pelatih'])->group(function () {
        Route::get('pelatih/{id}/edit', [PelatihController::class, 'edit'])->name('pelatih.edit');
        Route::put('pelatih/{id}', [PelatihController::class, 'update'])->name('pelatih.update');
    });

    Route::middleware(['auth', 'permission:hapus_akun_pelatih'])->group(function () {
        Route::delete('pelatih/{id}', [PelatihController::class, 'destroy'])->name('pelatih.destroy');
    });

    Route::middleware(['auth', 'permission:nilai_progress_member'])->group(function () {
        Route::get('progressmember', [ProgressMemberController::class, 'index'])->name('progressmember.index');
        Route::post('progressmember', [ProgressMemberController::class, 'store'])->name('progressmember.store');
        Route::put('progressmember/{id}', [ProgressMemberController::class, 'update'])->name('progressmember.update');
        Route::delete('progressmember/{id}', [ProgressMemberController::class, 'destroy'])->name('progressmember.destroy');
    });

    Route::post('kelas/{id}/join', [MemberDashboardController::class, 'joinKelas'])->name('kelas.join');
});


require __DIR__.'/auth.php';