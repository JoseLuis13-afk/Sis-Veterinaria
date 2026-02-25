<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Ajustes;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;




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
        $datos = request();

        $ajustes = Ajustes::find(1);
        $ajustes->telefono = $datos['telefono'];
        $ajustes->direccion = $datos['direccion'];
        $ajustes->moneda = $datos['moneda'];
        $ajustes->zona_horaria = $datos['zona_horaria'];

        if (request('logo')) {
           
            $path = storage_path('app/public/logo.png');
            unlink($path);
            $rutaImg = $datos["logo"]->store('public');

        }

        $ajustes->save();
        return redirect('Inicio');
    }

   public function ActualizarMisDatos(Request $request)
    {
        $datos = request();
        
        if (auth()->user()->email != request('email')){

            if (request('password')){
                $datos = request()->validate([
                    'name' => ['required','string','max:255'],
                    'email' => ['required','email','unique:users'],
                    'password' => ['required','string','min:3'],
                ]);
            
            }else{
                $datos = request()->validate([
                    'name' => ['required','string','max:255'],
                    'email' => ['required','string','email','max:255','unique:users'],
                ]);
            }
        }else{
             if (request('password')){
                $datos = request()->validate([
                    'name' => ['required','string','max:255'],
                    'email' => ['required','email'],
                    'password' => ['required','string','min:3'],
                ]);
            
            }else{
                $datos = request()->validate([
                    'name' => ['required','string','max:255'],
                    'email' => ['required','email'],
                ]);
            }
        }
        if (request('fotoPerfil')){
            $path = storage_path('app/public/'.auth()->user()->foto);
            unlink($path);
            $rutaImg = $request["fotoPerfil"]->store('Usuarios/'.$datos["name"].'-'.$datos["email"], 'public');
        }else{
            $rutaImg = auth()->user()->foto;
        }
        if (isset($datos["password"])){
            DB::table('users')->where('id', auth()->user()->id)->update([
                'name' => $datos['name'],
                'email' => $datos['email'],
                'foto' => $rutaImg,
                'password' => Hash::make($datos['password']),
               
            ]);
        }else{
            DB::table('users')->where('id', auth()->user()->id)->update([
                'name' => $datos['name'],
                'email' => $datos['email'],
                'foto' => $rutaImg,
               
            ]);
        }
        return redirect('Mis-Datos');
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
        $datos = request()->validate([
            'name' => ['string','max:255'],
            'rol' => ['string','max:255'],
            'email' => ['string','unique:users,email,'.$id_usuario],
            'password' => ['string','min:3'], 
        ]);

        User::where('id', $id_usuario)->update([
            'name' => $datos['name'],
            'email' => $datos['email'],
            'rol' => $datos['rol'],
        ]);
        if (isset($datos["password"])){
            User::where('id', $id_usuario)->update([
                'password' => Hash::make($datos['password']),
            ]);
        }
        return redirect('Usuarios')->with('UsuarioActualizado','OK');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id_usuario)
    {
        User::destroy($id_usuario);
        return redirect('Usuarios')->with('UsuarioEliminado','OK');
    }
}