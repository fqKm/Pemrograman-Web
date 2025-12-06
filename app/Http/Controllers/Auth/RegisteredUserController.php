<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Member; 
use App\Models\Role;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'phone' => ['required', 'string', 'max:15'],
        ]);

        $roleMember = Role::where('name', 'member')->first();

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $roleMember ? $roleMember->id : null,
        ]);

        Member::create([
            'user_id' => $user->id,
            'nama' => $user->name,
            'email' => $user->email,
            'nomor_hp' => $request->phone ?? '-', // Default jika tidak ada input
            'tanggal_lahir' => now(), // Bisa set default atau null jika diizinkan
            'tanggal_bergabung' => now(),
            'status' => 'tidak aktif', // Status awal
            'membership_id' => null,   // Belum punya paket
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('members.dashboard', absolute: false));
    }
}
