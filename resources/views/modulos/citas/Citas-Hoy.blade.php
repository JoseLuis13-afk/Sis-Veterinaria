@extends('welcome')

@section('contenido')

    <div class="content-wrapper">

        <section class="content-header">

            @php
                $fechaHoy = date('d/m/Y');
            @endphp
            <h1>
                <i class="fa fa-user-md"></i>
                Citas Hoy: <b>{{ $fechaHoy }}</b> - Veterinario: <b>{{ $veterinario->name }}</b>
            </h1>

            @if (auth()->user()->rol == 'Veterinario')
            
                <br>
                <a href="{{ url('Calendario/'.auth()->user()->id) }}">

                    <button class="btn btn-primary">Ver calendario Completo</button>

                </a>
                
            @endif
            
        </section>

        <section class="content">

            <div class="box">

                <div class="box-body">

                         <table class="table table-bordered table-hover table-striped dt-responsive" style="width: 100%">

                            <thead>

                                <tr>

                                    <th>Hora</th>
                                    <th>Cliente</th>
                                    <th>Mascota</th>
                                    <th>Nota</th>

                                    <th></th>

                                </tr>

                            </thead>

                            <tbody>

                                @foreach ($citas as $cita)

                                    @php
                                        $fyh = explode (' ', $cita->inicio);
                                        $hora = substr($fyh[1], 0, 5);

                                    @endphp

                                    <tr>

                                        <td>{{ $hora }}</td>
                                        <td>{{ $cita->CLIENTE->nombre }}</td>
                                        <td>{{ $cita->MASCOTA->nombre }}</td>
                                        <td>{!! $cita->nota !!}</td>

                                        <td>

                                            @if (auth()->user()->rol == 'Veterinario')
            
                                                <form method="post" action="">

                                                    @csrf
                                                    <input type="hidden" name="id_cita" value="{{ $cita->id }}">

                                                    @if ($cita->estado == 'Solicitada')

                                                        <input type="hidden" name="estado" value="En Proceso">
                                                        <button type="submit" class="btn btn-primary">Iniciar Cita</button>
                                                        
                                                    @elseif ($cita->estado == 'En Proceso')

                                                        <button type="button" class="btn btn-warning">En Proceso</button>
                                                        <input type="hidden" name="estado" value="Finalizada">
                                                        <button type="submit" class="btn btn-primary">Finalizar Cita</button>
                                                        <a href="{{ url('Cita/'.$cita->id) }}">

                                                            <button type="button" class="btn btn-primary">Ir a la Cita</button>
                                                        
                                                        </a>

                                                    @else

                                                        <button type="button" class="btn btn-success">Finalizada</button>
                                                        
                                                    @endif

                                                </form>
                                                
                                            @endif

                                        </td>

                                    </tr>
                                    
                                @endforeach

                            </tbody>

                         </table>

                         <hr>

                         <h2>Citas Anteriores</h2>

                         <table class="table table-bordered table-hover table-striped dt-responsive" style="width: 100%">

                            <thead>

                                <tr>

                                    <th>Hora</th>
                                    <th>Cliente</th>
                                    <th>Mascota</th>
                                    <th>Nota</th>

                                </tr>

                            </thead>

                            <tbody>

                                @foreach ($citasHistorial as $citaH)


                                    <tr>

                                        <td>{{ $citaH->inicio }}</td>
                                        <td>{{ $citaH->CLIENTE->nombre }}</td>
                                        <td>{{ $citaH->MASCOTA->nombre }}</td>
                                        <td>{!! $citaH->nota !!}</td>

                                    </tr>
                                    
                                @endforeach

                            </tbody>

                         </table>

                </div>

            </div>

        </section>
    </div>

@endsection