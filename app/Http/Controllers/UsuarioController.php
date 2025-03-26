<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuario;
use App\Contracts\UsuarioServiceInterface;
use Illuminate\Validation\Rules\Password;

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

    // Procesar el inicio de sesión con validación mejorada
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'correo' => 'required|email:rfc,dns|max:255',
            'contraseña' => 'required|string',
        ], [
            'correo.required' => 'El correo electrónico es obligatorio',
            'correo.email' => 'Debe ingresar un correo electrónico válido',
            'contraseña.required' => 'La contraseña es obligatoria',
        ]);

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            
            // Registrar el inicio de sesión
            $this->usuarioService->registrarUltimoAcceso(Auth::id());
            
            return redirect()->intended('/')
                ->with('success', 'Bienvenido ' . Auth::user()->nombre);
        }

        return back()->withErrors([
            'correo' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
        ])->onlyInput('correo');
    }

    // Cerrar sesión
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('status', 'Sesión cerrada correctamente');
    }

    // Mostrar el formulario de registro
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Procesar el registro con validación mejorada
    public function register(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255|regex:/^[\pL\s\-]+$/u',
            'apellidos' => 'required|string|max:255|regex:/^[\pL\s\-]+$/u',
            'correo' => [
                'required',
                'string',
                'email:rfc,dns',
                'max:255',
                'unique:usuarios,correo',
                function ($attribute, $value, $fail) {
                    if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                        $fail('El formato del correo electrónico no es válido.');
                    }
                },
            ],
            'contraseña' => [
                'required',
                'string',
                'min:8',
                'confirmed',
                Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                    ->uncompromised(),
            ],
            'terminos' => 'required|accepted',
        ], [
            'nombre.regex' => 'El nombre solo puede contener letras y espacios',
            'apellidos.regex' => 'Los apellidos solo pueden contener letras y espacios',
            'terminos.required' => 'Debes aceptar los términos y condiciones',
            'terminos.accepted' => 'Debes aceptar los términos y condiciones',
        ]);

        $data = $request->only(['nombre', 'apellidos', 'correo', 'contraseña']);
        $data['contraseña'] = Hash::make($data['contraseña']);
        $data['fecha_registro'] = now();
        $data['rol'] = 'usuario';
        $data['email_verified_at'] = null; // Para verificación posterior

        $usuario = $this->usuarioService->crearUsuario($data);

        // Opcional: Enviar correo de verificación
        // $usuario->sendEmailVerificationNotification();

        Auth::login($usuario);

        return redirect('/')
            ->with('success', 'Registro completado. ¡Bienvenido!');
    }

    // Mostrar lista de usuarios con validación de rol
    public function index()
    {
        $this->authorize('viewAny', Usuario::class);
        
        $usuarios = $this->usuarioService->obtenerTodosLosUsuarios();
        return view('usuarios.index', compact('usuarios'));
    }

    // Mostrar usuario específico con validación
    public function show($id)
    {
        $usuario = $this->usuarioService->obtenerUsuarioPorId($id);
        $this->authorize('view', $usuario);
        
        return view('usuarios.show', compact('usuario'));
    }

    // Mostrar formulario de edición con validación
    public function edit($id)
    {
        $usuario = $this->usuarioService->obtenerUsuarioPorId($id);
        $this->authorize('update', $usuario);
        
        return view('usuarios.edit', compact('usuario'));
    }

    // Actualizar usuario con validación mejorada
    public function update(Request $request, $id)
    {
        $usuario = $this->usuarioService->obtenerUsuarioPorId($id);
        $this->authorize('update', $usuario);

        $rules = [
            'nombre' => 'required|string|max:255|regex:/^[\pL\s\-]+$/u',
            'apellidos' => 'required|string|max:255|regex:/^[\pL\s\-]+$/u',
            'correo' => [
                'required',
                'string',
                'email:rfc,dns',
                'max:255',
                'unique:usuarios,correo,' . $id,
                function ($attribute, $value, $fail) {
                    if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                        $fail('El formato del correo electrónico no es válido.');
                    }
                },
            ],
            'rol' => 'sometimes|required|in:usuario,admin,moderador',
            'contraseña' => [
                'sometimes',
                'nullable',
                'string',
                'min:8',
                'confirmed',
                Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                    ->uncompromised(),
            ],
        ];

        // Solo el admin puede cambiar roles
        if (!Auth::user()->isAdmin()) {
            unset($rules['rol']);
        }

        $validated = $request->validate($rules, [
            'nombre.regex' => 'El nombre solo puede contener letras y espacios',
            'apellidos.regex' => 'Los apellidos solo pueden contener letras y espacios',
            'rol.in' => 'Rol no válido',
        ]);

        $data = $request->only(['nombre', 'apellidos', 'correo', 'rol']);
        
        if ($request->filled('contraseña')) {
            $data['contraseña'] = Hash::make($request->contraseña);
        }

        $this->usuarioService->actualizarUsuario($id, $data);

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario actualizado exitosamente.');
    }

    // Eliminar usuario con validación de autorización
    public function destroy($id)
    {
        $usuario = $this->usuarioService->obtenerUsuarioPorId($id);
        $this->authorize('delete', $usuario);

        // No permitir auto-eliminación
        if ($usuario->id === Auth::id()) {
            return back()->with('error', 'No puedes eliminar tu propia cuenta.');
        }

        $this->usuarioService->eliminarUsuario($id);

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario eliminado exitosamente.');
    }
}