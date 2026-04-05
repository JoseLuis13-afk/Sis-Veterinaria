@extends('welcome')

@section('contenido')

    <div class="content-wrapper">

        <section class="content-header">
            <h1>
                Historial de Citas
            </h1>
            <h2>Mascota: {{ $mascota->nombre }}</h2>
            <h2>Dueño: {{ $mascota->DUEÑO->nombre }}</h2>
            
        </section>

        <section class="content">

            <div class="box">

                <div class="box-body">

                         <table class="table table-bordered table-hover table-striped dt-responsive" style="width: 100%">

                            <thead>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Veterinario</th>
                                    <th>Nota</th>
                                    <th></th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach ($historial as $hist)

                                    <tr>
                                        <td>{{ $hist->fecha }}</td>
                                        <td>{{ $hist->VETERINARIO->name }}</td>
                                        <td>{!! $hist->nota !!}</td>
                                        <td>

                                            <a href="{{url('Cita/'.$hist->id_cita)}}">

                                                <button class="btn btn-primary">Ver Cita</button>

                                            </a>

                                        </td>
                                    </tr>

                                @endforeach

                            </tbody>

                         </table>

                </div>

            </div>

        </section>
    </div>

@endsection