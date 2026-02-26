@extends('welcome')

@section('contenido')

    <div class="content-wrapper">

        <section class="content-header">
            <h1>
                <h1><i class="fa fa-user-plus"></i>Gestor de Clientes</h1>
            </h1>
            
        </section>

        <section class="content">

            <div class="box">

                <div class="box-header">

                    <a href="{{ url('Crear-Cliente') }}">

                        <button class="btn btn-primary">Agregar Nuevo Cliente</button>

                    </a>

                </div>

                <div class="box-body">

                        <table class="table table-bordered table-striped table-hover dt-responsive">

                            <thead>

                                <tr>

                                    <th style="width:10px">#</th>
                                    <th>Cliente</th>
                                    <th>Documento</th>
                                    <th>Email</th>
                                    <th>Telefono</th>
                                    <th>Direccion</th>
                    
                                </tr>

                            </thead>

                            <tbody>

                                @foreach ($clientes as $cliente)

                                    <tr>

                                        <td>{{ $cliente->nombre }}</td>
                                        <td>{{ $cliente->documento }}</td>
                                        <td>{{ $cliente->email }}</td>
                                        <td>{{ $cliente->telefono }}</td>
                                        <td>{{ $cliente->direccion }}</td>

                                        <td>

                                            <a href="{{ url('Editar-Cliente/'.$cliente->id) }}">

                                                <button class="btn btn-success"><i class="fa fa-pencil"></i></button>

                                            </a>
                                            <button class="btn btn-warning"><i class="fa fa-paw"></i> Ver Mascotas</button>

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