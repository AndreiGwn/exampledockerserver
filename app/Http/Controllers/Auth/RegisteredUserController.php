<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

/**
 * Class RegisteredUserController
 *
 * Handles registration of new Eigenaar (Hotel Owner) accounts.
 */
class RegisteredUserController extends Controller
{
    /**
     * Display the registration view for Eigenaars.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming Eigenaar registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'phone' => ['nullable', 'string', 'max:50'],
            'company_name' => ['nullable', 'string', 'max:255'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'eigenaar',
            'phone' => $request->phone,
            'company_name' => $request->company_name,
        ]);

        event(new Registered($user));

        Auth::login($user);

        session()->flash('success', 'Welkom als Eigenaar! U kunt nu direct uw hotels en kamers beheren.');

        return redirect(route('dashboard', absolute: false));
    }
}
