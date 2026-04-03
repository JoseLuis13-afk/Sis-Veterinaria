<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Ajustes;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;


class UsersController extends Controller
{
     /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     user::create([
    //         'name' => 'Admin',
    //         'email' => 'admin@gamil.com',
    //         'password' => Hash::make('123'),
    //         'foto' => 'default.jpg',
    //         'rol' => 'Administrador',
    //         'estado' => 'Disponible',
    //     ]);
    // }
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function Ajustes()
    {
        $ajustes = Ajustes::find(1);
        return view('modulos.Inicio', compact('ajustes'));
    }

    public function ActualizarAjustes(Request $request)
    {
        // Es mejor usar $request directamente que request()
        $ajustes = Ajustes::find(1);
        $ajustes->telefono = $request->telefono;
        $ajustes->direccion = $request->direccion;
        $ajustes->moneda = $request->moneda;
        $ajustes->zona_horaria = $request->zona_horaria;

        if ($request->hasFile('logo')) {
    
            // 1. Ruta absoluta donde DEBE estar el logo para que se vea en la web
            $pathDestino = storage_path('app/public/logo.png');

            // 2. Borramos cualquier rastro del logo anterior
            if (file_exists($pathDestino)) {
                unlink($pathDestino);
            }

            // 3. GUARDADO CORRECTO:
            // El primer parámetro '' significa la raíz del disco
            // El segundo 'logo.png' es el nombre fijo
            // El tercer 'public' es el DISCO que definiste en filesystems.php
            $request->file('logo')->storeAs('', 'logo.png', 'public');
        }

        $ajustes->save();
        
        return redirect('Inicio')->with('success', 'Ajustes actualizados correctamente');
    }

   public function ActualizarMisDatos(Request $request)
    {
        // 1. Validación súper simplificada
        $datos = $request->validate([
            'name'       => ['required', 'string', 'max:255'],
            // El secreto está aquí: ignora el ID del usuario actual para el correo único
            'email'      => ['required', 'email', 'max:255', 'unique:users,email,' . auth()->id()],
            // Nullable permite que venga vacío si no quiere cambiar la clave
            'password'   => ['nullable', 'string', 'min:3'],
            // Opcional pero recomendado: validar que la foto sea realmente una imagen
            'fotoPerfil' => ['nullable', 'image', 'max:2048'] 
        ]);

        $usuario = auth()->user();
        $rutaImg = $usuario->foto; // Guardamos la foto actual por defecto

        // 2. Lógica segura para la foto (Soluciona el error 'Is a directory')
        if ($request->hasFile('fotoPerfil')) {
            
            // Verificamos si el usuario YA TIENE una foto en la base de datos y la borramos
            if ($rutaImg) {
                Storage::disk('public')->delete($rutaImg);
            }
            
            // Guardamos la nueva foto
            $rutaImg = $request->file('fotoPerfil')->store('Usuarios/'.$datos["name"].'-'.$datos["email"], 'public');
        }

        // 3. Actualizamos los datos del usuario autenticado
        $usuario->name  = $datos['name'];
        $usuario->email = $datos['email'];
        $usuario->foto  = $rutaImg;

        // 4. Si escribió una contraseña nueva, la encriptamos y la asignamos
        if (!empty($datos['password'])) {
            $usuario->password = Hash::make($datos['password']);
        }

        // Guardamos todo en la base de datos MySQL
        $usuario->save();

        return redirect('Mis-Datos')->with('success', 'Tus datos se actualizaron correctamente.');
    }
    public function index()
    {
        if (auth()->user()->rol != 'Administrador'){
            return redirect('Inicio');
        }
        $users = User::all();
        return view('modulos.users.Usuarios', compact('users'));
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $datos = request()->validate([
            'name' => ['string','max:255'],
            'rol' => ['string','max:255'],
            'email' => ['string','unique:users'],
            'password' => ['string','min:3'], 
        ]);

        User::create([
            'name' => $datos['name'],
            'email' => $datos['email'],
            'password' => Hash::make($datos['password']),
            'foto' => '',
            'rol' => $datos['rol'],
            'estado' => 'Disponible',
        ]);
        return redirect('Usuarios')->with('UsuarioCreado','OK');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id_usuario)
    {
        $users = User::all();
        $usuario = User::find($id_usuario);
        return view('modulos.users.Usuarios', compact('users','usuario'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id_usuario)
    {
        $usuario = User::find($id_usuario);

        if ($usuario['email'] != request('email')){

            if (request('password')){
                $datos = request()->validate([
                    'name' => ['required','string','max:255'],
                    'rol' => ["required"],
                    'email' => ["required",'unique:users'],
                    'password' => ["string",'min:3'], 
                ]);
            }else{
            $datos = request()->validate([
                    'name' => ['required','string','max:255'],
                    'rol' => ["required"],
                    'email' => ["required",'unique:users']
                     
                ]);
            }
        } else{
            if (request('password')){
                $datos = request()->validate([
                    'name' => ['required','string','max:255'],
                    'rol' => ["required"],
                    'email' => ["required"],
                    'password' => ["string",'min:3'], 
                ]);
            }else{
            $datos = request()->validate([
                    'name' => ['required','string','max:255'],
                    'rol' => ["required"],
                    'email' => ["required"],
                     
                ]);
            }
        }

        if (request('password')){
            DB::table('users')->where('id', $id_usuario)->update([
                'name' => $datos['name'],
                'email' => $datos['email'],
                'rol' => $datos['rol'],
                'password' => Hash::make($datos['password']),
            ]);
        }else{
            DB::table('users')->where('id', $id_usuario)->update([
                'name' => $datos['name'],
                'email' => $datos['email'],
                'rol' => $datos['rol'],
            ]);
        }
        return redirect('Usuarios')->with('UsuarioActualizado','OK');
 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_usuario)
    {
        $usuario = User::find($id_usuario);

        // 1. Verificamos si tiene foto
        if ($usuario->foto) {
            
            $carpetaDelUsuario = dirname($usuario->foto);
            $rutaFisica = storage_path('app/public/' . $carpetaDelUsuario);

            // 2. Como ya comprobamos que is_dir funciona, borramos la carpeta sin miedo
            if (is_dir($rutaFisica)) {
                File::deleteDirectory($rutaFisica);
            }
        }

        // 3. Eliminamos de MySQL
        User::destroy($id_usuario);

        return redirect('Usuarios')->with('UsuarioEliminado','OK');
    }
}