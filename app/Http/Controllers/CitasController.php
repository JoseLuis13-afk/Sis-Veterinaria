<?php

namespace App\Http\Controllers;

use App\Models\Citas;
use App\Models\User;
use App\Models\Ajustes;
use App\Models\Historial;
use App\Models\ImgHistorial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Clientes;
use App\Models\Mascotas;

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

        if (auth()->user()->rol == 'Veterinario'){
            return redirect('Citas-Hoy/'.auth()->user()->id);
        }
        $veterinarios = User::where('rol', 'Veterinario')->get();

        return view('modulos.citas.Citas', compact('veterinarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function Calendario($id_veterinario)
    {
        $veterinario = User::findOrFail($id_veterinario);
        $clientes = Clientes::all();

        $mascotas = Mascotas::all();
        $citas = Citas::where('id_veterinario', $id_veterinario)->get();

        return view('modulos.citas.Calendario', compact('veterinario', 'clientes', 'mascotas', 'citas'));
    }

    public function ObtenerMascotas($id_cliente)
    {
        $mascotas = Mascotas::where('id_cliente', $id_cliente)->get();

        return response()->json($mascotas);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function AgendarCita(Request $request)
    {
        $datos = request();

        if ($datos["nota"] == ''){

            $nota = 'Sin Nota';

        }else{

            $nota = $datos["nota"];

        }

        Citas::create([
            'id_veterinario' => $datos["id_veterinario"],
            'id_cliente' => $datos["id_cliente"],
            'id_mascota' => $datos["id_mascota"],
            'nota' => $nota,
            'estado' => 'Solicitada',
            'inicio' => $datos["inicio"],
            'fin' => $datos["fin"]
        ]);

        return redirect('Calendario/'.$datos["id_veterinario"])->with('CitaAgendada','OK');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function CancelarCita()
    {
        $datos = request();

        $cita = Citas::find($datos["id_cita"]);

        DB::table('citas')->whereId($datos["id_cita"])->delete();

        return redirect('Calendario/'.$cita['id_veterinario']);
    }

    /**
     * Display the specified resource.
     */
    public function VerCitasHoyVeterinario($id_veterinario)
    {
        $veterinario = User::find($id_veterinario);
        $ajustes = Ajustes::find(1);
        $fechaHoy = date('Y-m-d');
        date_default_timezone_set($ajustes["zona_horaria"]); 
        $citas = Citas::where('id_veterinario', $id_veterinario)->whereDate('inicio', $fechaHoy. ' %')->get();

        return view('modulos.citas.Citas-Hoy', compact('veterinario', 'citas'));
    }

    
    public function CambiarEstadoCita(Request $request, $id_veterinario)
     {
        $datos = request();

        $Cita = Citas::find($datos["id_cita"]);

        $Cita -> estado = $datos["estado"];

        $Cita -> save();

        if ($datos["estado"] == 'En Proceso'){

            return redirect('Cita/'.$datos["id_cita"]);
            
        }else{

            return redirect('Citas-Hoy/'.$id_veterinario);
        }

       
     }

    
    public function VerCita($id_cita)
    {
        $cita = Citas::find($id_cita);

        $cliente = Clientes::find($cita->id_cliente);
        $veterinario = Clientes::find($cita->id_veterinario);
        $mascota = Mascotas::find($cita->id_mascota);

        $historial = Historial::where('id_cita', $id_cita)->first();

        if ($historial){

            $imagenes = DB::select('SELECT * FROM img_historial WHERE id_historial = '.$historial->id);

        }else{

            $imagenes = '';

        }

        return view('modulos.citas.Cita', compact('cita', 'cliente', 'veterinario', 'mascota', 'historial', 'imagenes'));
        
    }
    
    public function FinalizarCita($id_cita)
    {
        Citas::find($id_cita)->update(['estado' => 'Finalizada']);

        return redirect('Cita/'.$id_cita);
        
    }

    public function HistorialCita(Request $request, $id_cita)
     {
        $datos = request();

        $cita = Citas::find($id_cita);

        if ($datos["tipo"] == 'Agregar'){

            Historial::create([

                'id_veterinario' => $cita->id_veterinario,
                'id_mascota' => $cita->id_mascota,
                'id_cita' => $cita->id,
                'fecha' => $cita->inicio,
                'nota' => $datos["nota"],
                
            ]);

            return redirect('Cita/'.$id_cita)->with('HistorialAgragado','OK');
        }else{

            Historial::where('id_cita', $id_cita)->update([

                'nota' => $datos["nota"]
                
            ]);

            return redirect('Cita/'.$id_cita)->with('HistorialActualizado','OK');

        }
       
     }

    public function ImgHistorial(Request $request, $id_cita)
     {
        $datos = request();

        $cita = Citas::find($id_cita);

        $historial = Historial::where('id_cita', $id_cita)->first();

        $cliente = Clientes::find($cita->id_cliente);
        $mascota = Mascotas::find($cita->id_mascota);

        $rutaImg = $datos["imagenH"]->store('Clientes/'.$cliente->nombre.'-'.$cliente->documento.'/Historial-Clinico/'.$mascota->nombre, 'public');

        DB::table('img_historial')->insert(['id_historial' => $historial->id, 'imagen' => $rutaImg]);

        return redirect('Cita/'.$id_cita);
       
     }

     public function BorrarImgHistorial($id_imagen)
     {
        $imagen = ImgHistorial::find($id_imagen);

        if ($imagen) {
            // 1. Obtenemos el ID de la cita ANTES de borrar para poder volver
            $historial = Historial::find($imagen->id_historial);
            $id_cita = $historial->id_cita;

            // 2. BORRADO FÍSICO
            // IMPORTANTE: Al usar Storage::disk('public'), Laravel se encarga de
            // manejar los espacios y las barras correctamente en Windows.
            if (Storage::disk('public')->exists($imagen->imagen)) {
                Storage::disk('public')->delete($imagen->imagen);
            }

            // 3. BORRADO EN BASE DE DATOS
            $imagen->delete();

            return redirect('Cita/'.$id_cita)->with('ImagenBorrada', 'OK');
        }

        return back();
       
     }

}
