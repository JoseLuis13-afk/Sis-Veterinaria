@extends('welcome')

@section('contenido')

    <div class="content-wrapper">

        <section class="content-header">
            
            <div class="row">

                <div class="col-md-3">

                    <h3><b>{{ $cita->inicio }}</b></h3>

                </div>

                <div class="col-md-3">

                    <h3>Dueño :<b>{{ $cliente->nombre }}</b></h3>

                </div>

                <div class="col-md-3">

                    <h3>Mascota :<b>{{ $mascota->nombre }}</b></h3>

                </div>

                <div class="col-md-3">

                    @if ($cita->estado == 'En Proceso')

                        <h3><button class="btn btn-warning">En Proceso</button></h3>

                        <form method="post" action="{{url('Finalizar-Cita/'.$cita->id)}}">

                            @csrf
                            <button type="submit" class="btn btn-danger">Finalizar Cita</button>


                        </form>
                        
                    @else

                        <h3><button class="btn btn-danger">Finalizada</button></h3>
                        
                    @endif

                </div>

            </div>
            
        </section>

        <section class="content">

            <div class="box">

                <div class="box-body">

                         <a href="">

                            <button class="btn btn-primary">Ver Historial Completo</button>

                         </a>

                         @if ($historial == '')

                            <form method="post" action="">

                                @csrf
                                <input type="hidden" name="tipo" value="Agregar">

                                <h2>Nota :</h2>
                                <textarea name="nota" id="editor"></textarea>
                                <br>
                                <button class="btn btn-success">Guardar en el Historial</button>

                            </form>

                         @else

                            <form method="post" action="">

                                @csrf
                                <input type="hidden" name="tipo" value="Actualizar">

                                <h2>Nota :</h2>
                                <textarea name="nota" id="editor">

                                    {!! $historial->nota !!}

                                </textarea>
                                <br>
                                <button class="btn btn-success">Guardar en el Historial</button>

                            </form>

                            <hr>

                            <h2>Imagenes </h2>

                            <form method="post" enctype="multipart/form-data" action="{{url('Cita-Historial-Imagen/'.$historial->id_cita)}}">

                                @csrf
                                @method('put')

                                <input type="file" name="imagenH">
                                <br>
                                <button type="submit" class="btn btn-primary">Subir Imagen</button>

                            </form>

                            <br>

                            @foreach ($imagenes as $imagen)

                                <div class="col-md-3">

                                    <form method="post" action="{{url('Cita-Historial-Imagen-Borrar/'.$imagen->id)}}">

                                        @csrf
                                        @method('delete')

                                        <a href="{{url('storage/'.$imagen->imagen)}}" target="_blank">

                                            <img src="{{url('storage/'.$imagen->imagen)}}" width="150px">

                                        </a>

                                        <button class="btn btn-danger" type="submit"><i class="fa fa-times"></i></button>

                                    </form>

                                </div>

                            @endforeach
                             
                         @endif

                </div>

            </div>

        </section>
    </div>

@endsection