@extends('welcome')

@section('contenido')

    <div class="content-wrapper">

        <section class="content-header">
            <h1>
                <i class="fa fa-paw"></i>
                Mascotas del Cliente: <b>{{$cliente->nombre}}</b>
            </h1>
            
        </section>

        <section class="content">

            <div class="box">

                <div class="box-body">

                    <table class="table table-bordered table-hover table-striped dt-responsive">

                        <thead>

                            <tr>
                                <th>Nombre</th>
                                <th>Foto</th>
                                <th>Edad - Peso - Sexo</th>
                                <th>Especie - Raza</th>
                                <th>Detalles</th>
                               
                            </tr>

                        </thead>

                        <tbody>

                            @foreach ($mascotas as $mascota)

                                <tr>
                                    <td>{{$mascota->nombre}}</td>
                                    @if ($mascota -> foto == "")

                                        <td><img src="{{url('storage/defecto1.png')}}" width="50px" ></td>
                                        
                                    @else

                                        <td><img src="{{url('storage/'.$mascota->foto)}}" width="50px" ></td>
                                        
                                    @endif
                            
                                    <td>Edad: {{$mascota->edad}}  <br> Peso: {{$mascota->peso}}  <br> Sexo: {{$mascota->sexo}}</td>
                                    <td>Especie: {{$mascota->especie}} <br> Raza: {{$mascota->raza}}</td>
                                    <td>{!!$mascota->detalles!!}</td>                                 

                                </tr>
                                
                            @endforeach

                        </tbody>

                    </table>

                </div>
                
            </div>

        </section>
    </div>


@endsection