@extends('welcome')

@section('contenido')

    <div class="content-wrapper">

        <section class="content-header">
            <h1>
                <i class="fa fa-paw"></i>
                Gestor de Mascotas
            </h1>
            
        </section>

        <section class="content">

            <div class="box">

                <div class="box-header">

                    <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#AgregarMascota">Agregar Mascota</button>

                </div>

                <div class="box-body">

                    
                </div>
                
            </div>

        </section>
    </div>

     <div id="AgregarMascota" class = "modal fade">

        <div class="modal-dialog">

            <div class="modal-content">

                <form method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="modal-body">

                        <div class="box-body">

                            <div class="form-group">

                                <h2>Dueño:</h2>

                                <select class="form-control input-lg select2" name="id_cliente" style="width: 100%" required>

                                    <option value="">Seleccionar...</option>
                                    @foreach ($clientes as $cliente)

                                        <option value="{{$cliente->id}}">{{$cliente->nombre}} - {{$cliente->documento}}</option>
                                        
                                    @endforeach

                                </select>

                            </div>

                            <div class="form-group">

                                <h2>Nombre:</h2>
                                <input type="text" class="form-control input-lg" name="nombre" required>

                            </div>

                            <div class="form-group">

                                <h2>Foto:</h2>
                                <input type="file" class="form-control input-lg" name="foto" required>

                            </div>

                            <div class="form-group">

                                <h2>Especie:</h2>
                                <input type="text" class="form-control input-lg" name="especie" required>

                            </div>

                            <div class="form-group">

                                <h2>Raza:</h2>
                                <input type="text" class="form-control input-lg" name="raza" required>

                            </div>

                            <div class="form-group">

                                <div class="col-md-4">

                                    <h2>Edad:</h2>
                                    <input type="number" class="form-control input-lg" name="edad" required>

                                </div>

                                <div class="col-md-4">

                                    <h2>Peso:</h2>
                                    <input type="text" class="form-control input-lg" name="peso" required>

                                </div>

                                <div class="col-md-4">

                                    <h2>Sexo:</h2>
                                    <select class="form-control input-lg" name="sexo" required>

                                        <option value="">Seleccionar...</option>
                                        <option value="Hembra">Hembra</option>
                                        <option value="Macho">Macho</option>

                                    </select>

                                </div>

                                

                            </div>
                            <div class="form-group">

                                <h2>Detalles:</h2>
                                <textarea name="detalles" id="editor"></textarea>

                            </div>

                        </div>

                    </div>

                    <div class="modal-footer">

                        <button class="btn btn-primary" type="submit">Agregar</button>
                        <button class="btn btn-danger" type="button" data-dismiss="modal">Salir</button>
                        
                    </div>
                    
                </form>

            </div>

        </div>

    </div>

@endsection