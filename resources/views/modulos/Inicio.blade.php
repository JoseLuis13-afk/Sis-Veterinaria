@extends('welcome')

@section('contenido')

    <div class="content-wrapper">

        <section class="content-header">
            <h1>
                Inicio
                <small>Panel de Control</small>
            </h1>
            
        </section>

        <section class="content">

        <div class="box">

            <div class="box-body">

                @if (auth()->user()->rol =="Administrador")

                    <form method="POST" enctype="multipart/form-data">

                        @csrf

                        <div class="col-md-3">

                            <h2>Logo</h2>
                            <input type="file" name="logo" class="form-control">
                            <img src="{{ asset('storage/logo.png?v='.time()) }}" class="img-fluid img-thumbnail" style="max-height: 250px; display: block; margin: 0 auto;">

                        </div>

                        <div class="col-md-3">

                            <h2>Teléfono</h2>
                            <input type="text" name="telefono" required class="form-control" data-inputmask="'mask':'+(999) 99999999'" data-mask value="{{ $ajustes->telefono }}">

                        </div>

                        <div class="col-md-3">

                            <h2>dirección</h2>
                            <input type="text" name="direccion" required class="form-control" value="{{$ajustes->direccion}}">

                        </div>

                        <div class="col-md-3">

                            <h2>Moneda</h2>
                            <input type="text" name="moneda" required class="form-control" value="{{$ajustes->moneda}}" >

                        </div>

                        <div class="col-md-3">

                            <h2>Zona Horaria</h2>
                            <select class="form-control" name="zona_horaria" required>
                                <option value="{{ $ajustes->zona_horaria }}">{{ $ajustes->zona_horaria }}</option>
                                <option value="America/Lima">America/Lima</option>
                            </select>

                        </div>

                        <div class="col-md-3">

                            <h2></h2><br><br>
                           <button class="btn btn-primary" type="submit">Guardar</button>

                        </div>

                    </form>
                    
                @endif

            </div>

        </div>

        </section>
    </div>

@endsection