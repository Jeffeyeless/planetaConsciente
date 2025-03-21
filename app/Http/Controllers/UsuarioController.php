<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuario;
use App\Contracts\UsuarioServiceInterface;

class UsuarioController extends Controller
{
    protected $usuarioService;

    public function __construct(UsuarioServiceInterface $usuarioService)
    {
        $this->usuarioService = $usuarioService;
    }

    // Mostrar el formulario de inicio de sesión
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Procesar el inicio de sesión
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'correo' => 'required|email',
            'contraseña' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'correo' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
        ]);
    }

    // Cerrar sesión
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    // Mostrar el formulario de registro
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Procesar el registro de un nuevo usuario
    public function register(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'correo' => 'required|string|email|max:255|unique:usuarios',
            'contraseña' => 'required|string|min:8|confirmed',
        ]);

        $data = $request->all();
        $data['contraseña'] = Hash::make($data['contraseña']);
        $data['fecha_registro'] = now();
        $data['rol'] = 'usuario'; // Asignar rol por defecto

        $usuario = $this->usuarioService->crearUsuario($data);

        Auth::login($usuario); // Iniciar sesión automáticamente después del registro

        return redirect('/')->with('success', 'Usuario registrado exitosamente.');
    }

    // Mostrar una lista de usuarios (solo para administradores)
    public function index()
    {
        $usuarios = $this->usuarioService->obtenerTodosLosUsuarios();
        return view('usuarios.index', compact('usuarios'));
    }

    // Mostrar un usuario específico
    public function show($id)
    {
        $usuario = $this->usuarioService->obtenerUsuarioPorId($id);
        return view('usuarios.show', compact('usuario'));
    }

    // Mostrar el formulario para editar un usuario
    public function edit($id)
    {
        $usuario = $this->usuarioService->obtenerUsuarioPorId($id);
        return view('usuarios.edit', compact('usuario'));
    }

    // Actualizar un usuario en la base de datos
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'correo' => 'required|string|email|max:255|unique:usuarios,correo,' . $id,
            'contraseña' => 'sometimes|string|min:8|confirmed',
        ]);

        $data = $request->all();
        if (isset($data['contraseña'])) {
            $data['contraseña'] = Hash::make($data['contraseña']);
        }

        $this->usuarioService->actualizarUsuario($id, $data);

        return redirect()->route('usuarios.index')
                         ->with('success', 'Usuario actualizado exitosamente.');
    }

    // Eliminar un usuario de la base de datos
    public function destroy($id)
    {
        $this->usuarioService->eliminarUsuario($id);

        return redirect()->route('usuarios.index')
                         ->with('success', 'Usuario eliminado exitosamente.');
    }
}