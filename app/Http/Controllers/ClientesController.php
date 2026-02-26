<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientesController extends Controller
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
        return view('modulos.clientes.Clientes', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('modulos.clientes.Crear-Cliente');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $datos = request()-> validate([
            'nombre' => ['string', 'max:255'],
            'documento' => ['string', 'unique:clientes'],
            'email' => ['email', 'unique:clientes'],
            'telefono' => ['string'],
            'direccion' => ['string']
        ]);

        Clientes::create([
            'nombre' => $datos["nombre"],
            'documento' => $datos["documento"],
            'email' => $datos["email"],
            'telefono' => $datos["telefono"],
            'direccion' => $datos["direccion"]
        ]);

        return redirect('Clientes')->with('ClienteAgregado','OK');
    }

    /**
     * Display the specified resource.
     */
    public function show(Clientes $clientes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_cliente)
    {
        $cliente = Clientes::find($id_cliente);
        return view('modulos.clientes.Editar-Cliente', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_cliente)
    {
        $cliente = Clientes::find($id_cliente);

        if($cliente["documento"] != request('documento') && $cliente["email"] != request('email')){

             $datos = request()-> validate([
                'nombre' => ['string', 'max:255'],
                'documento' => ['string', 'unique:clientes'],
                'email' => ['email', 'unique:clientes'],
                'telefono' => ['string'],
                'direccion' => ['string']
            ]);
        }elseif ($cliente["documento"] != request('documento') && $cliente["email"] == request('email')){

            $datos = request()-> validate([
                'nombre' => ['string', 'max:255'],
                'documento' => ['string', 'unique:clientes'],
                'email' => ['email'],
                'telefono' => ['string'],
                'direccion' => ['string']
            ]);

        }elseif ($cliente["documento"] == request('documento') && $cliente["email"] == request('email')){

            $datos = request()-> validate([
                'nombre' => ['string', 'max:255'],
                'documento' => ['string'],
                'email' => ['email'],
                'telefono' => ['string'],
                'direccion' => ['string']
            ]);

        }elseif ($cliente["documento"] == request('documento') && $cliente["email"] != request('email')){

            $datos = request()-> validate([
                'nombre' => ['string', 'max:255'],
                'documento' => ['string'],
                'email' => ['email', 'unique:clientes'],
                'telefono' => ['string'],
                'direccion' => ['string']
            ]);

        }

        DB::table('clientes')->where('id', $id_cliente)->update([
            'nombre' => $datos["nombre"],
            'documento' => $datos["documento"],
            'email' => $datos["email"],
            'telefono' => $datos["telefono"],
            'direccion' => $datos["direccion"]
        ]);

        return redirect('Clientes')->with('ClienteActualizado','OK');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Clientes $clientes)
    {
        //
    }
}
