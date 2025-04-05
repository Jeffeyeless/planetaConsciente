<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    /**
     * Muestra la lista de usuarios (solo para admins)
     */
    public function index()
    {
        // Verificar si el usuario es admin
        if (!auth()->user()->isAdmin()) {
            abort(403, 'No tienes permiso para acceder a esta página');
        }

        $users = User::latest()->paginate(10);
        return view('users.index', compact('users'));
    }

    /**
     * Muestra el formulario de creación de usuario (solo para admins)
     */
    public function create()
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'No tienes permiso para acceder a esta página');
        }

        return view('users.create');
    }

    /**
     * Almacena un nuevo usuario (solo para admins)
     */
    public function store(Request $request)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'No tienes permiso para realizar esta acción');
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:admin,user'],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('users.index')
            ->with('success', 'Usuario creado exitosamente');
    }

    /**
     * Muestra un usuario específico (solo para admins)
     */
    public function show(User $user)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'No tienes permiso para acceder a esta página');
        }

        return view('users.show', compact('user'));
    }

    /**
     * Muestra el formulario de edición (solo para admins o el propio usuario)
     */
    public function edit(User $user)
    {
        // Permitir edición si es admin o si es el propio usuario
        if (!auth()->user()->isAdmin() && auth()->user()->id !== $user->id) {
            abort(403, 'No tienes permiso para editar este usuario');
        }

        return view('users.edit', compact('user'));
    }

    /**
     * Actualiza el usuario (solo para admins o el propio usuario)
     */
    public function update(Request $request, User $user)
    {
        // Verificar permisos
        if (!auth()->user()->isAdmin() && auth()->user()->id !== $user->id) {
            abort(403, 'No tienes permiso para actualizar este usuario');
        }

        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$user->id],
        ];

        // Solo admins pueden cambiar el rol
        if (auth()->user()->isAdmin()) {
            $rules['role'] = ['required', 'in:admin,user'];
        }

        // Validación para contraseña si se proporciona
        if ($request->password) {
            $rules['password'] = ['required', 'confirmed', Rules\Password::defaults()];
        }

        $request->validate($rules);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if (auth()->user()->isAdmin()) {
            $data['role'] = $request->role;
        }

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('users.index')
            ->with('success', 'Usuario actualizado exitosamente');
    }

    /**
     * Elimina un usuario (solo para admins)
     */
    public function destroy(User $user)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'No tienes permiso para realizar esta acción');
        }

        // No permitir eliminarse a sí mismo
        if (auth()->user()->id === $user->id) {
            return redirect()->route('users.index')
                ->with('error', 'No puedes eliminar tu propio usuario');
        }

        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'Usuario eliminado exitosamente');
    }

    /**
     * Verifica si el usuario actual es admin (para API/AJAX)
     */
    public function checkAdmin()
    {
        return response()->json([
            'is_admin' => auth()->check() && auth()->user()->isAdmin()
        ]);
    }
}