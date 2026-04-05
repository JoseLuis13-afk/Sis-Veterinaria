<?php

namespace App\Http\Controllers;

use App\Models\Internaciones;
use App\Models\Citas;
use Illuminate\Http\Request;


class InternacionesController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index()
    {
        $internaciones = Internaciones::all();

        return view('modulos.citas.Internaciones', compact('internaciones'));
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
    public function store(Request $request, $id_cita)
    {
        $cita = Citas::find($id_cita);

        Internaciones::create([

            'id_mascota' => $cita->id_mascota,
            'id_cita' => $cita->id,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_alta' => 0,
            'expediente' => "",
            'motivo' => $request->motivo,

        ]);

        return redirect('Cita/'.$id_cita)->with('MascotaInternada', 'OK');

    }

    /**
     * Display the specified resource.
     */
    public function show(Internaciones $internaciones)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Internaciones $internaciones)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Internaciones $internaciones)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Internaciones $internaciones)
    {
        //
    }
}
