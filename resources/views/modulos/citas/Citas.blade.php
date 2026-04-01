@extends('welcome')

@section('contenido')

    <div class="content-wrapper">

        <section class="content-header">
            <h1>
                <i class="fa fa-stethoscope"></i>
                Elija un Veterinario para agendar su cita
    
            </h1>
            
        </section>

        <section class="content">

            <div class="box">

                <div class="box-body">

                         @foreach ($veterinarios as $vet )

                            <div class="col-md-3 col-sm-6">

                                @if ($vet->estado == 'Disponible')

                                    <div class="box box-success">
                                    
                                @else

                                    <div class="box box-danger">

                                    
                                @endif
                                        <div class="box-body box-profile">

                                            @if ($vet->foto == '')

                                                <img src="{{url('storage/defecto1.png')}}" class="profile-user-img img-responsive img-circle">
                                                
                                            @else

                                                <img src="{{url('storage/'.$vet->foto)}}" class="profile-user-img img-responsive img-circle">
                                                
                                            @endif

                                            <h3 class="profile-username text-center"> {{$vet->name}} </h3>

                                            @if ($vet->estado == 'Disponible')

                                                <p class="text-muted text-center" style="color:#00a65a;">Disponible</p>
                                                
                                            @else

                                                <p class="text-muted text-center" style="color:#f56954;">No Disponible</p>

                                                
                                            @endif

                                            <a href="" class="btn btn-primary btn-block"><b>Ver Calendario</b></a>

                                        </div>

                                    </div>

                            </div>
                             
                         @endforeach

                </div>

            </div>

        </section>
    </div>

@endsection