@extends('welcome')

@section('contenido')

    <div class="content-wrapper">

        <section class="content-header">
            <h1><i class="fa fa-users"></i>
                Gestor de Usuarios
            </h1>
            
        </section>

        <section class="content">

        <div class="box">

            <div class="box-header">

                <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#CrearUsuario">Crear Usuario</button>

            </div>

            <div class="box-body">

                <table class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Usuario</th>
                            <th>Email</th>
                            <th>Foto</th>
                            <th>Rol</th>

                            <th></th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($users as $user)
                           <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>

                            <td>
                                @if ($user->foto != "")
                                    <img src="{{url('storage/'.$user->foto)}}" width="50px">
                                @else
                                    <img src="{{url('storage/defecto1.png')}}" width="50px">
                                @endif
                                
                            </td>

                            <td>{{$user->rol}}</td>
                            <td>

                                <a href="{{url('Editar-Usuario/'.$user->id)}}">

                                <button class="btn btn-success"><i class="fa fa-pencil"></i></button>
                                
                                
                                </a>
                                
                                <button class="btn btn-danger"><i class="fa fa-trash"></i></button>

                            </td>
                        </tr> 
                        @endforeach    

                    </tbody>

                </table>

                
            </div>

        </div>

        </section>
    </div>

    <div id="CrearUsuario" class = "modal fade">

        <div class="modal-dialog">

            <div class="modal-content">

                <form method="post">
                    @csrf

                    <div class="modal-body">

                        <div class="box-body">

                            <div class="form-group">

                                <h2>Nombre y Apellido</h2>
                                <input type="text" class="form-control input-lg" name="name" value="{{old('name')}}" required>

                            </div>

                            <div class="form-group">

                                <h2>Rol</h2>
                                <select name="rol" class="form-control input-lg" required>
                                    <option value="">Seleccionar Rol</option>
                                    <option value="Administrador">Administrador</option>
                                    <option value="Veterinario">Veterinario</option>
                                    <option value="Secretaria">Secretaria</option>
                                </select>

                            </div>

                            <div class="form-group">

                                <h2>Email :</h2>
                                <input type="email" class="form-control input-lg" name="email" value="{{old('email')}}" required>

                                @error('email')

                                    <div class="alert alert-danger">El email ya existe</div>

                                @enderror

                            </div>

                            <div class="form-group">

                                <h2>Contraseña :</h2>
                                <input type="password" class="form-control input-lg" name="password" value="{{old('password')}}" required>

                                @error('password')

                                    <div class="alert alert-danger">La contraseña debe tener al menos 3 caracteres</div>

                                @enderror

                            </div>

                        </div>

                    </div>

                    <div class="modal-footer">

                        <button class="btn btn-primary" type="submit">Guardar Usuario</button>
                        <button class="btn btn-danger" type="button" data-dismiss="modal">Salir</button>
                        
                    </div>
                    
                </form>

            </div>

        </div>

    </div>

    @php
    
        $exp = explode("/", $_SERVER["REQUEST_URI"]);

    @endphp

    @if ($exp[3] == 'Editar-Usuario')

    <div id="EditarUsuario" class = "modal fade">

        <div class="modal-dialog">

            <div class="modal-content">

                <form method="post">
                    @csrf

                    <div class="modal-body">

                        <div class="box-body">

                            <div class="form-group">

                                <h2>Nombre y Apellido</h2>
                                <input type="text" class="form-control input-lg" name="name" value="{{ $usuario->name }}" required>

                            </div>

                            <div class="form-group">

                                <h2>Rol</h2>
                                <select name="rol" class="form-control input-lg" required>

                                    <option value="{{$usuario->rol}}">{{$usuario->rol}}</option>
                                    
                                        @php

                                            $roles = ['Administrador', 'Veterinario', 'Secretaria'];

                                        @endphp

                                        @foreach($roles as $rol)

                                            @if($rol != $usuario->rol)

                                                <option value="{{$rol}}">{{$rol}}</option>

                                            @endif

                                        @endforeach

                                </select>

                            </div>

                            <div class="form-group">

                                <h2>Email :</h2>
                                <input type="email" class="form-control input-lg" name="email" value="{{$usuario->email}}" required>

                                @error('email')

                                    <div class="alert alert-danger">El email ya existe</div>

                                @enderror

                            </div>

                            <div class="form-group">

                                <h2>Contraseña :</h2>
                                <input type="password" class="form-control input-lg" name="password" value="{{old('password')}}" required>

                                @error('password')

                                    <div class="alert alert-danger">La contraseña debe tener al menos 3 caracteres</div>

                                @enderror

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