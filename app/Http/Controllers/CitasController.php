<?php

namespace App\Http\Controllers;

use App\Models\Citas;
use App\Models\User;
use App\Models\Ajustes;
use App\Models\Historial;
use App\Models\ImgHistorial;
use App\Models\Receta;
use App\Models\Internaciones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Elibyy\TCPDF\Facades\TCPDF;
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

        $citasHistorial = Citas::where('id_veterinario', $id_veterinario)->orderBy('inicio', 'desc')->get();

        return view('modulos.citas.Citas-Hoy', compact('veterinario', 'citas', 'citasHistorial'));
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
        $ajustes = Ajustes::find(1);

        $historial = Historial::where('id_cita', $id_cita)->first();

        if ($historial){

            $imagenes = DB::select('SELECT * FROM img_historial WHERE id_historial = '.$historial->id);

        }else{

            $imagenes = '';

        }

        $receta = Receta::where('id_cita', $cita->id)->first();

        $internacion = Internaciones::where('id_cita', $id_cita)->where('fecha_alta', 0)->first();

        return view('modulos.citas.Cita', compact('cita', 'cliente', 'veterinario', 'mascota', 'historial', 'imagenes', 'receta', 'internacion', 'ajustes'));
        
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

     public function HistorialMascota($id_mascota)
     {
        $historial = Historial::orderBy('fecha', 'desc')->where('id_mascota', $id_mascota)->get();

        $mascota = Mascotas::find($id_mascota);

        return view('modulos.citas.HistorialMascota', compact('mascota', 'historial'));
       
     }

     public function Receta(Request $request, $id_cita)
     {
        $datos = request();

        if ($datos["tipo"] == 'Crear'){

            Receta::create(['receta' => $datos["receta"], 'id_cita' => $id_cita]);

            return redirect('Cita/'.$id_cita)->with('RecetaCreada', 'OK');

        }else{

            Receta::where('id_cita', $id_cita)->update(['receta' => $datos["receta"]]);

            return redirect('Cita/'.$id_cita)->with('RecetaActualizada', 'OK');

        }   
          
     }

     public function RecetaPDF($id_receta)
    {
        $pdf = new \Elibyy\TCPDF\TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetCreator('Veterinaria App');
        $pdf->SetTitle('Receta');
        $pdf->SetMargins(10, 10, 10, false);
        $pdf->SetAutoPageBreak(true, 20);
        $pdf->AddPage();

        $receta = Receta::find($id_receta);

        $cita = Citas::find($receta->id_cita);

        $mascota = Mascotas::find($cita->id_mascota);
        $dueño = Clientes::find($cita->id_cliente);
        $veterinario = User::find($cita->id_veterinario);
        $ajustes =  Ajustes::find(1);

        $logo = storage_path('app/public/logo.png');
        $pdf->Image($logo, 150, 10, 40, '','','', 'T', false, 300, '', false, false, 0, false, false,false );

        $html = '
                  
                    <h3>Veterinario: '.$veterinario->name.'</h3>
                    <h3>Dueño: '.$dueño->nombre.'</h3>
                    <h3>Mascota: '.$mascota->nombre.'</h3>
                    <h2>Receta: '.$receta->receta.'</h2>                                   

                    <p>'.$ajustes["direccion"].' || '.$ajustes["telefono"].'</p>
                 
                        ';
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf-> Output('Receta- '.$mascota->nombre.' - '.$receta->id.'.pdf', 'I');
    }

}
