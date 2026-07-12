<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PatientProfileController extends Controller
{
    public function updateProfile(Request $request)
    {
        $validated = $request->validate([
            'name' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
        ]);

        $user = $request->user();

        if (! empty($validated['name'])) {
            $user->name = $validated['name'];
        }

        if (! empty($validated['email'])) {
            $user->email = $validated['email'];
        }

        $user->save();

        return back()->with('success', 'Profil mis a jour.');
    }

    public function updateAvatar()
    {
        return back()->with('status', 'La gestion de l avatar sera disponible prochainement.');
    }

    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        $request->user()->forceFill([
            'password' => Hash::make($validated['password']),
        ])->save();

        return back()->with('success', 'Mot de passe mis a jour.');
    }

    public function updatePreferences()
    {
        return back()->with('status', 'Preferences enregistrees.');
    }
}
