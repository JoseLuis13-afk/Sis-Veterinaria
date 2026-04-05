@extends('welcome')

@section('contenido')

    <div class="content-wrapper">

        <section class="content-header">
            <h1>
                <i class="fa fa-hospital-o"></i>
                Internaciónes
                
            </h1>
            
        </section>

        <section class="content">

            <div class="box">

                <div class="box-body">

                         <table class="table table-bordered table-hover table-striped dt-respondive"  style="width: 100%">

                            <thead>

                                <tr>

                                    <th>Mascota</th>
                                    <th>Dueño</th>
                                    <th>Fecha de Internacion</th>
                                    <th>Motivo</th>
                                    <th>Alta</th>

                                    <th></th>

                                </tr>

                            </thead>

                            <tbody>

                                @foreach ($internaciones as $internacion)

                                    @if ($internacion->fecha_alta == 0)

                                        <tr>

                                            <td> {{$internacion->MASCOTA->nombre}} </td>
                                            <td> {{$internacion->MASCOTA->DUEÑO->nombre}} </td>
                                            <td> {{$internacion->fecha_inicio}} </td>
                                            <td> {{$internacion->motivo}} </td>
                                            <td> Sin Alta </td>

                                            <td>

                                                <a href="{{url('Internacion/'.$internacion->id)}}">

                                                    <button class="btn btn-primary">Ver</button>

                                                </a>

                                            </td>

                                        </tr>
                                        
                                    @endif
                                    
                                @endforeach

                            </tbody>
                            
                         </table>

                         <h2>Dados de Alta</h2>

                         <table class="table table-bordered table-hover table-striped dt-respondive"  style="width: 100%">

                            <thead>

                                <tr>

                                    <th>Mascota</th>
                                    <th>Dueño</th>
                                    <th>Fecha de Internacion</th>
                                    <th>Motivo</th>
                                    <th>Alta</th>

                                    <th></th>

                                </tr>

                            </thead>

                            <tbody>

                                @foreach ($internaciones as $internacion)

                                    @if ($internacion->fecha_alta != 0)

                                        <tr>

                                            <td> {{$internacion->MASCOTA->nombre}} </td>
                                            <td> {{$internacion->MASCOTA->DUEÑO->nombre}} </td>
                                            <td> {{$internacion->fecha_inicio}} </td>
                                            <td> {{$internacion->motivo}} </td>
                                            <td> {{$internacion->fecha_alta}} </td>

                                            <td>

                                                <a href="{{url('Internacion/'.$internacion->id)}}">

                                                    <button class="btn btn-primary">Ver</button>

                                                </a>

                                            </td>

                                        </tr>
                                        
                                    @endif
                                    
                                @endforeach

                            </tbody>
                            
                         </table>

                </div>

            </div>

        </section>
    </div>

@endsection