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
use App\Http\Controllers\OrderController;
use App\Http\Controllers\WebhookController;

use App\Models\Membership;
use App\Models\Kelas;

use App\Http\Controllers\ProgressController;
use App\Http\Controllers\ProgressMemberController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    if (Auth::check()) {
        $user = Auth::user();
        if ($user->isTrainer()) return redirect()->route('pelatih.dashboard');
        if ($user->isMember()) return redirect()->route('members.dashboard');
        return redirect()->route('dashboard');
    }
    $memberships = Membership::all();
    $featuredClasses = Kelas::with('pelatih')->limit(3)->get(); // Contoh ambil 3 kelas

    return view('welcome', compact('memberships', 'featuredClasses'));
});

Route::get('/dashboard', function () {
    $user = auth()->user();

    if ($user->isAdmin()) {
         return redirect()->route('admin.dashboard');
    }

    if ($user->isTrainer()) {
        return redirect()->route('pelatih.dashboard');
    }

    if ($user->isMember()) {
        return redirect()->route('members.dashboard');
    }

    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/admin/dashboard', [DashboardController::class, 'adminDashboard'])
        ->middleware('permission:ubah_akun_member') // Sesuaikan nama permission Anda
        ->name('admin.dashboard');

Route::get('/pelatih/dashboard', [DashboardController::class, 'pelatihDashboard'])
    ->middleware(['auth', 'permission:lihat_akun_pelatih'])
    ->name('pelatih.dashboard');

Route::get('/members/dashboard', [MemberDashboardController::class, 'index'])
    ->middleware(['auth', 'permission:lihat_akun_member'])
    ->name('members.dashboard');

Route::get('/members/classes', [MemberDashboardController::class, 'kelas'])
    ->middleware(['auth', 'permission:lihat_akun_member'])
    ->name('members.kelas.index');

Route::get('/members/classes/{id}', [MemberDashboardController::class, 'show'])
    ->middleware(['auth', 'permission:lihat_akun_member'])
    ->name('members.kelas.show');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/webhook/payment', [WebhookController::class, 'handlePayment'])->name('payment.webhook');

Route::middleware(['auth'])->group(function () {

    // --- BAGIAN INI DIPERBAIKI ---
    // Mengelompokkan route admin agar memiliki prefix URL '/admin' dan nama 'admin.'
    Route::prefix('admin')->name('admin.')->group(function () {
        // URL: /admin/members -> Route Name: admin.members.index
        Route::resource('members', MemberController::class);

        // URL: /admin/kelas -> Route Name: admin.kelas.index
        Route::resource('kelas', KelasController::class);

        // URL: /admin/pelatih -> Route Name: admin.pelatih.index
        Route::resource('pelatih', PelatihController::class);

        // URL: /admin/membership -> Route Name: admin.membership.index
        Route::resource('membership', MembershipController::class);

        Route::resource('alat', AlatController::class);
    });
    // --- AKHIR PERBAIKAN ---

    // --- ALUR 1: PEMBAYARAN MEMBERSHIP ---
    
    // Konfirmasi Beli
    Route::get('/membership/{membership}/buy', [OrderController::class, 'confirm'])->name('membership.buy');
    
    // Proses Beli
    Route::post('/membership/{membership}/process', [OrderController::class, 'process'])->name('membership.process');
    
    // Halaman Menunggu & Sukses
    Route::get('/orders/{order}', [OrderController::class, 'waiting'])->name('orders.waiting');
    Route::get('/orders/{order}/success', [OrderController::class, 'success'])->name('orders.success');

    // Dashboard Member (Lihat Kelas)
    Route::get('/dashboard/member', [MemberDashboardController::class, 'index'])->name('member.dashboard');
    
    // Action Join Kelas
    Route::post('/kelas/{id}/join', [MemberDashboardController::class, 'joinKelas'])->name('kelas.join');

    Route::middleware(['auth', 'permission:request_kelas'])->group(function () {
        Route::get('kelas/request', [KelasController::class, 'requestKelas'])->name('kelas.request');
    });

    Route::middleware(['auth', 'permission:lihat_kelas'])->group(function () {
        Route::get('kelas', [KelasController::class, 'index'])->name('kelas.index');
        Route::get('kelas/view/{id_kelas}', [KelasController::class, 'show'])->name('kelas.show');
        Route::post('/members/classes/{id}/join', [MemberDashboardController::class, 'joinKelas'])->name('members.kelas.join');
    });

    Route::middleware(['auth', 'permission:lihat_member_kelas'])->group(function () {
        Route::get('kelas/{id}/member', [KelasController::class, 'memberList'])->name('kelas.member');
    });

    Route::middleware(['auth', 'permission:buat_kelas'])->group(function () {
        // Perhatikan: Route create/store admin sudah ditangani resource di atas (admin.kelas.create),
        // Tapi jika Anda butuh route manual tanpa prefix admin, pastikan controller redirect ke route yang benar.
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
        Route::get('/orders/{membership_id}/confirm', [OrderController::class, 'confirm'])->name('orders.confirm');
        Route::post('/orders/{membership_id}/process', [OrderController::class, 'process'])->name('orders.process');
        Route::get('/orders/{order}/waiting', [OrderController::class, 'waiting'])->name('orders.waiting');
        Route::get('/orders/{order}/check-status', [OrderController::class, 'checkStatus'])->name('orders.check-status');
        Route::get('/orders/{order}/success', [OrderController::class, 'success'])->name('orders.success');
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
});

require __DIR__.'/auth.php';