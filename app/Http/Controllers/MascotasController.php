<?php

namespace App\Http\Controllers;

use App\Models\Mascotas;
use App\Models\Clientes;
use Illuminate\Http\Request;

class MascotasController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = Clientes::all();
        return view('modulos.mascotas.Mascotas', compact('clientes'));
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
        $datos = request();

        $dueño = Clientes::find($datos["id_cliente"]);

        if(request ('foto')){

            $rutaImg = $datos['foto']->store('Clientes/'.$dueño->nombre.''.$dueño -> documento.''.$datos["nombre"],'public');

        }
        if($datos["detalles"] == null){

            $detalles = "Sin detalles";

        }else{

            $detalles = $datos["detalles"];

        }

        Mascotas::create([
            
            'nombre' => $datos["nombre"],
            'especie' => $datos["especie"],
            'raza' => $datos["raza"],
            'edad' => $datos["edad"],
            'peso' => $datos["peso"],
            'id_cliente' => $datos["id_cliente"],
            'detalles' => $detalles,
            'sexo' => $datos["sexo"],
            'foto' => $rutaImg

        ]);

        return redirect('Mascotas')->with('MascotaAgregada','OK');
    }

    /**
     * Display the specified resource.
     */
    public function show(Mascotas $mascotas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mascotas $mascotas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mascotas $mascotas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mascotas $mascotas)
    {
        //
    }
}
