@extends('welcome')

@section('contenido')

    <div class="content-wrapper">

        <section class="content-header">
            <h1>
                <h1><i class="fa fa-user-plus"></i>Editar Cliente: <b>{{ $cliente->nombre }} - {{ $cliente->documento }}</b></h1>
            </h1>
            
        </section>

        <section class="content">

            <div class="box">

                <div class="box-body">

                    <form method="post" action="{{url('Actualizar-Cliente/'.$cliente->id)}}">

                        @csrf
                        @method('put')

                        <div class="form-group">

                            <h2>Nombre y Apellido</h2>
                            <input type="text" class="form-control" name="nombre" value="{{ $cliente->nombre }}" required>

                        </div>

                        <div class="form-group">

                            <h2>Documento</h2>
                            <input type="text" class="form-control" name="documento" required value="{{ $cliente->documento }}">
                            @error('documento')
                                <div class="alert alert-danger">El documento ya está registrado</div>
                            @enderror

                        </div>

                        <div class="form-group">

                            <h2>Email</h2>
                            <input type="text" class="form-control" name="email" required value="{{ $cliente->email }}">
                            @error('email')
                                <div class="alert alert-danger">El email ya está registrado</div>
                            @enderror

                        </div>

                        <div class="form-group">

                            <h2>Telefono</h2>
                            <input type="text" class="form-control" name="telefono" required value="{{ $cliente->telefono }}">

                        </div>

                        <div class="form-group">

                            <h2>Dirección</h2>
                            <input type="text" class="form-control" name="direccion" required value="{{$cliente->direccion}}">

                        </div>

                        <button type="submit" class="btn btn-success">Actualizar Cliente</button>
                    </form>

                </div>
                
            </div>

        </section>

    </div>

@endsection