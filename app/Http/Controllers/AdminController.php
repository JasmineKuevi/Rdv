<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function users()
    {
        $users = User::query()->latest()->paginate(15);

        return view('admin.usres', compact('users'));
    }

    public function createUser()
    {
        return view('admin.create_user');
    }

    public function storeUser(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', Rule::in(['patient', 'medecin', 'admin'])],
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
        ]);

        return redirect()->route('admin.users')->with('success', 'Utilisateur cree.');
    }

    public function editUser(User $user)
    {
        return view('admin.edit_user', compact('user'));
    }

    public function updateUser(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'role' => ['required', Rule::in(['patient', 'medecin', 'admin'])],
        ]);

        $user->update($validated);

        return redirect()->route('admin.users')->with('success', 'Utilisateur mis a jour.');
    }

    public function deleteUser(User $user)
    {
        $user->delete();

        return redirect()->route('admin.users')->with('success', 'Utilisateur supprime.');
    }

    public function rapport()
    {
        return view('admin.dashboard');
    }
}
