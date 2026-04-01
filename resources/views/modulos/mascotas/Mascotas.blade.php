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

                    <table class="table table-bordered table-hover table-striped dt-responsive" style="width: 100%">

                        <thead>

                            <tr>
                                <th>Nombre</th>
                                <th>Foto</th>
                                <th>Edad - Peso - Sexo</th>
                                <th>Especie - Raza</th>
                                <th>Detalles</th>
                                <th>Dueño</th>
                                
                                <th></th>
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
                                    <td>{{$mascota->DUEÑO->nombre}} - {{$mascota->DUEÑO->documento}}</td>
                                    
                                    <td>
                                            <a href="{{ url('Editar-Mascota/'.$mascota->id) }}">

                                                <button class="btn btn-success"><i class="fa fa-pencil"></i></button>

                                            </a>

                                            <button class="btn btn-danger EliminarMascota" Mid="{{ $mascota->id }}" mascota="{{ $mascota->nombre }}"><i class="fa fa-trash"></i></button>

                                            <a href="{{ url('Vacunas/'.$mascota->id) }}">
                                                <button class="btn btn-primary"><i class="fa fa-plus-square"></i> Carnet de Vacunas</button>
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

    <div id="AgregarMascota" class = "modal fade">

        <div class="modal-dialog">

            <div class="modal-content">

                <form method="post" enctype="multipart/form-data" action="{{url('Mascotas')}}">
                    @csrf
                    @method('put')
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
                                <input type="file" class="form-control input-lg" name="foto" >

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

    @php

        $exp = explode("/", $_SERVER["REQUEST_URI"]);
        
    @endphp

    @if ($exp[3] == 'Editar-Mascota')

        <div id="EditarMascota" class = "modal fade">

            <div class="modal-dialog">

                <div class="modal-content">

                <form method="post" enctype="multipart/form-data" action="{{url('Actualizar-Mascota/'.$mascota->id)}}">
                    @csrf
                    @method('put')
                    <div class="modal-body">

                        <div class="box-body">

                            <div class="form-group">

                                <h2>Dueño:</h2>

                                <select class="form-control input-lg select2" name="id_cliente" style="width: 100%" required>

                                    <option value="">{{$masc->id_cliente}} - {{$masc->DUEÑO->documento}}</option>
                                    @foreach ($clientes as $cliente)

                                        @if ($cliente->id != $masc->id_cliente)

                                            <option value="{{$cliente->id}}">{{$cliente->nombre}} - {{$cliente->documento}}</option>

                                        @endif
                                        
                                    @endforeach

                                </select>

                            </div>

                            <div class="form-group">

                                <h2>Nombre:</h2>
                                <input type="text" class="form-control input-lg" name="nombre" required value="{{$masc->nombre}}">

                            </div>

                            <div class="form-group">

                                <h2>Foto:</h2>
                                <input type="file" class="form-control input-lg" name="foto" >
                                <img src=" {{url('storage/'.$masc->foto)}}" width="250px">

                            </div>

                            <div class="form-group">

                                <h2>Especie:</h2>
                                <input type="text" class="form-control input-lg" name="especie" required value="{{$masc->especie}}">

                            </div>

                            <div class="form-group">

                                <h2>Raza:</h2>
                                <input type="text" class="form-control input-lg" name="raza" required value="{{$masc->raza}}">

                            </div>

                            <div class="form-group">

                                <div class="col-md-4">

                                    <h2>Edad:</h2>
                                    <input type="number" class="form-control input-lg" name="edad" required value="{{$masc->edad}}">

                                </div>

                                <div class="col-md-4">

                                    <h2>Peso:</h2>
                                    <input type="text" class="form-control input-lg" name="peso" required value="{{$masc->peso}}">

                                </div>

                                <div class="col-md-4">

                                    <h2>Sexo:</h2>
                                    <select class="form-control input-lg" name="sexo" required>

                                        <option value="{{$masc->sexo}}">{{$masc->sexo}}</option>
                                        @if ($masc -> sexo == 'Hembra')
                                            <option value="Hembra" selected>Macho</option>
                                        @else
                                            <option value="Hembra">Hembra</option>
                                        @endif

                                    </select>

                                </div>

                                

                            </div>
                            <div class="form-group">

                                <h2>Detalles:</h2>
                                <textarea name="detalles" id="editor2" >{{$masc->detalles}}</textarea>

                            </div>

                        </div>

                    </div>

                    <div class="modal-footer">

                        <button class="btn btn-success" type="submit">Guardar</button>
                        <button class="btn btn-danger" type="button" data-dismiss="modal">Cancelar</button>
                        
                    </div>
                    
                </form>

                </div>

            </div>

    </div>

    @endif

@endsection