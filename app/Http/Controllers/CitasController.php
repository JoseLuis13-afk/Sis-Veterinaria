<?php

namespace App\Http\Controllers;

use App\Models\Citas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class CitasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct(){
        $this->middleware('auth');
    }

    public function VerVeterinarios()
    {
        $veterinarios = User::where('rol', 'Veterinario')->get();
        return view('modulos.citas.Ver-Veterinarios', compact('veterinarios'));
    }

    public function CrearVeterinarios(Request $request)
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
        return redirect('Veterinarios')->with('VeterinarioCreado','OK');
    }

    public function CambiarEstadoVeterinario(Request $request, $id_veterinario)
    {
        DB::table('users')->where('id', $id_veterinario)->update(['estado' => $request->estado]);
         
        return redirect('Veterinarios');
    }

    public function index()
    {
        $veterinarios = User::where('rol', 'Veterinario')->get();

        return view('modulos.citas.Citas', compact('veterinarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Citas $citas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Citas $citas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Citas $citas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Citas $citas)
    {
        //
    }
}
