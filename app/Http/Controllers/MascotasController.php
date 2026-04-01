<?php

namespace App\Http\Controllers;

use App\Models\Mascotas;
use App\Models\Clientes;
use App\Models\Vacunas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Elibyy\TCPDF\Facades\TCPDF;

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
        $mascotas = Mascotas::all();
        return view('modulos.mascotas.Mascotas', compact('clientes', 'mascotas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function VerMascotasCliente($id_cliente)
    {
        $cliente = Clientes::find($id_cliente);
        $mascotas = Mascotas::where('id_cliente', $id_cliente)->get();
        return view('modulos.mascotas.Ver-Mascotas-Cliente', compact('cliente', 'mascotas'));
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
    public function edit( $id_mascota)
    {
        $clientes = Clientes::all();
        $mascotas = Mascotas::all();
        $masc = Mascotas::find($id_mascota);

        return view('modulos.mascotas.Mascotas', compact('clientes', 'mascotas', 'masc'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id_mascota)
    {
        $datos = request();

        $MASCOTA = Mascotas::find($id_mascota);

        $MASCOTA -> nombre = $datos["nombre"];
        $MASCOTA -> especie = $datos["especie"];
        $MASCOTA -> raza = $datos["raza"];
        $MASCOTA -> edad = $datos["edad"];
        $MASCOTA -> peso = $datos["peso"];
        if($datos["detalles"] == null){

            $detalles = "Sin detalles";

        }else{

            $detalles = $datos["detalles"];

        }
        $MASCOTA -> detalles = $detalles;
        $MASCOTA -> sexo = $datos["sexo"];
        $MASCOTA -> id_cliente = $datos["id_cliente"];

        $dueño = Clientes::find($MASCOTA -> id_cliente);

        if ($request->hasFile('foto')) {
    
            // 1. Si la mascota ya tenía una foto registrada, intentamos borrarla de forma segura
            if ($MASCOTA->foto) {
                Storage::disk('public')->delete($MASCOTA->foto);
            }
            
            // 2. Guardamos la foto nueva y AHORA SÍ capturamos la ruta en la variable $rutaImg
            $rutaImg = $request->file('foto')->store('Clientes/'.$dueño->nombre.'-'.$dueño->documento.'/'.$datos["nombre"], 'public');
            
            // 3. Le pasamos la nueva ruta al modelo de la mascota
            $MASCOTA->foto = $rutaImg;
        }

        $MASCOTA -> save();

        return redirect('Mascotas')->with('MascotaActualizada','OK');
        
    }

    public function VacunasMascota($id_mascota)
    {
        $mascota = Mascotas::find($id_mascota);
        $veterinarios = User::where('rol', 'Veterinario')->get();
        $vacunas = Vacunas::where('id_mascota', $id_mascota)->get();

        return view('modulos.mascotas.Vacunas', compact('mascota', 'veterinarios', 'vacunas'));
    }

    public function AgregarVacuna(Request $request, $id_mascota)
    {
        $datos = request();

        if($datos["prox_fecha"] == null){

            $prox_fecha = "Fin";

        }else{

            $prox_fecha = $datos["prox_fecha"];

        }

        Vacunas::create([
            
            'id_mascota' => $id_mascota,
            'id_veterinario' => $datos["id_veterinario"],
            'vacuna' => $datos["vacuna"],
            'fecha' => $datos["fecha"],
            'prox_fecha' => $prox_fecha,

        ]);

        return redirect('Vacunas/'.$id_mascota)->with('VacunaAgregada','OK');
    }

    public function CarnetVacunasPDF($id_mascota)
    {
        $pdf = new \Elibyy\TCPDF\TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetCreator('Veterinaria App');
        $pdf->SetTitle('Carnet de Vacunas');
        $pdf->SetMargins(10, 10, 10, false);
        $pdf->SetAutoPageBreak(true, 20);
        $pdf->AddPage();

        $mascota = Mascotas::find($id_mascota);
        $dueño = Clientes::find($mascota->id_cliente);
        $vacunas = Vacunas::where('id_mascota', $id_mascota)->get();

        $html = ' <table> 

                    <thead> 

                        <tr>
                        
                            <th></th>
                            <th> <h1><u>Carnet de Vacunas</u></h1></th>
                            <th></th>

                        </tr>

                     </thead>

                  </table>
                  
                    <h3>Dueño: '.$dueño->nombre.'</h3>
                    <h3>Mascota: '.$mascota->nombre.'</h3>
                    <h3>Especie: '.$mascota->especie.'</h3>
                    <h3>Raza: '.$mascota->raza.'</h3>
                    <h3>Edad: '.$mascota->edad.'</h3>
                    <h3>Sexo: '.$mascota->sexo.'</h3>

                 <table border="1" style="text-align: center; padding: 5px;"> 

                    <thead> 

                        <tr>
                        
                            <th>Vacuna</th>
                            <th>Fecha de Aplicación</th>
                            <th>Veterinario</th>
                            <th>Próxima Fecha</th>

                        </tr>

                     </thead>

                    <tbody>';
                    
                        foreach($vacunas as $vacuna){

                            if($vacuna->prox_fecha == "Fin"){

                                $prox  = " ";
                            }else{  

                                $prox = $vacuna->prox_fecha;
                            }
                            $html .= '<tr>
                                        <td>'.$vacuna->vacuna.'</td>
                                        <td>'.$vacuna->fecha.'</td>
                                        <td>'.$vacuna->VETERINARIO->name.'</td>
                                        <td>'.$prox.'</td>
                                      </tr>';
                        }
         $html .= ' </tbody>
                  </table>
                        ';
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf-> Output('Carnet_Vacunas- '.$mascota->nombre.'.pdf', 'I');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_mascota)
    {
        $mascota = Mascotas::find($id_mascota);

        if ($mascota && $mascota->foto) {
            // 1. Obtenemos la ruta de la carpeta (sin el nombre del archivo al final)
            // dirname() nos da la carpeta donde vive la foto (ej: Clientes/Nombre-DNI/NombreMascota)
            $carpetaMascota = dirname($mascota->foto);

            // 2. Borramos TODA la carpeta de esa mascota en el disco 'public'
            // IMPORTANTE: No pongas 'public/' al inicio de la ruta si usas el disk 'public'
            if (Storage::disk('public')->exists($carpetaMascota)) {
                Storage::disk('public')->deleteDirectory($carpetaMascota);
            }
        }

        // 3. Borramos los registros en la base de datos
        // Primero vacunas (por la relación) y luego la mascota
        Vacunas::where('id_mascota', $id_mascota)->delete();
        Mascotas::destroy($id_mascota);

        return redirect('Mascotas')->with('success', 'Mascota y archivos eliminados correctamente');
    }
}
