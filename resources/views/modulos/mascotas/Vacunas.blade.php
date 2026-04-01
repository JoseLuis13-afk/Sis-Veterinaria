@extends('welcome')

@section('contenido')

    <div class="content-wrapper">

        <section class="content-header">
            <h1>
                Carnet de Vacunas
            </h1>
            <h2>Mascota: <b>{{$mascota->nombre}}</b></h2>
            <h2>Dueno: <b>{{$mascota->DUEÑO->nombre}}</b></h2>
            
        </section>

        <section class="content">

            <div class="box">

                <div class="box-body">

                    <button class="btn btn-primary" data-toggle="modal" data-target="#AgregarVacuna">Agregar Vacuna</button>

                    <a href="{{url('Carnet-Vacunas-PDF/'.$mascota->id)}}" target="_blank">

                        <button class="btn btn-defaul pull-right">
                            <i class="fa-solid fa-file-pdf"></i>
                            Generar PDF
                        </button>

                    </a>

                    <br><br>

                    <table class="table table-bordered table-hover table-striped dt-responsive">

                        <thead>

                            <tr>
                                <th>Vacuna</th>
                                <th>Veterinario</th>
                                <th>Fecha de Aplicación</th>
                                <th>Próxima Aplicación</th>
                            </tr>

                        </thead>

                        <tbody>

                            @foreach ($vacunas as $vacuna)

                                <tr>
                                    <td>{{$vacuna->vacuna}}</td>
                                    <td>{{$vacuna->VETERINARIO->name}}</td>
                                    <td>{{$vacuna->fecha}}</td>
                                    @if ($vacuna->prox_fecha == 'Fin')

                                        <td>-</td>
                                    @else

                                        <td>{{$vacuna->prox_fecha}}</td>
                                        
                                    @endif
                                    

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            </div>

        </section>

    </div>

    <div id="AgregarVacuna" class = "modal fade">

        <div class="modal-dialog">

            <div class="modal-content">

                <form method="post">
                    @csrf
            
                    <div class="modal-body">

                        <div class="box-body">

                            @if (auth()->user()->rol != 'Veterinario')

                                <div class="form-group">

                                <h2>Veterinario:</h2>

                                <select class="form-control input-lg select2" name="id_veterinario" style="width: 100%" required>

                                        <option value="">Seleccionar...</option>
                                        @foreach ($veterinarios as $veterinario)

                                            <option value="{{$veterinario->id}}">{{$veterinario->name}} </option>
                                            
                                        @endforeach

                                    </select>

                            </div>

                            @else

                                <input type="hidden" name="id_veterinario" value="{{auth()->user()->id}}">
                                
                            @endif

                            <div class="form-group">

                                <h2>Vacuna:</h2>
                                <input type="text" class="form-control input-lg" name="vacuna" required>

                            </div>

                            <div class="form-group">

                                <h2>Fecha de Aplicación:</h2>
                                <input type="date" class="form-control input-lg" name="fecha" required>

                            </div>

                            <div class="form-group">

                                <h2>Próxima Aplicación:</h2>
                                <input type="date" class="form-control input-lg" name="prox_fecha">

                            </div>

                        </div>

                    </div>

                    <div class="modal-footer">

                        <button class="btn btn-primary" type="submit">Agregar</button>
                        <button class="btn btn-danger" type="button" data-dismiss="modal">Cancelar</button>
                        
                    </div>
                    
                </form>

            </div>

        </div>

    </div>

@endsection