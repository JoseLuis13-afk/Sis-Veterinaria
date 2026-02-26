@extends('welcome')

@section('contenido')

    <div class="content-wrapper">

        <section class="content-header">
            <h1>
                <h1><i class="fa fa-user-plus"></i>Agregar Nuevo Cliente</h1>
            </h1>
            
        </section>

        <section class="content">

            <div class="box">

                <div class="box-body">

                    <form method="post">

                        @csrf

                        <div class="form-group">

                            <h2>Nombre y Apellido</h2>
                            <input type="text" class="form-control" name="nombre" value="{{old ('nombre')}}" required>

                        </div>

                        <div class="form-group">

                            <h2>Documento</h2>
                            <input type="text" class="form-control" name="documento" required value="{{old ('documento')}}">
                            @error('documento')
                                <div class="alert alert-danger">El documento ya está registrado</div>
                            @enderror

                        </div>

                        <div class="form-group">

                            <h2>Email</h2>
                            <input type="text" class="form-control" name="email" required value="{{old ('email')}}">
                            @error('email')
                                <div class="alert alert-danger">El email ya está registrado</div>
                            @enderror

                        </div>

                        <div class="form-group">

                            <h2>Telefono</h2>
                            <input type="text" class="form-control" name="telefono" required value="{{old ('telefono')}}">

                        </div>

                        <div class="form-group">

                            <h2>Dirección</h2>
                            <input type="text" class="form-control" name="direccion" required value="{{old ('direccion')}}">

                        </div>

                        <button type="submit" class="btn btn-primary">Agregar Cliente</button>

                    </form>

                </div>
                
            </div>

        </section>

    </div>

@endsection