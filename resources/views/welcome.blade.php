<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Veterinaria</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{url ('bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{url ('bower_components/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{url ('bower_components/Ionicons/css/ionicons.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{url ('dist/css/AdminLTE.min.css')}}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{url ('dist/css/skins/_all-skins.min.css')}}">
  <!-- Morris chart -->
  <link rel="stylesheet" href="{{url ('bower_components/morris.js/morris.css')}}">
  <!-- jvectormap -->
  <link rel="stylesheet" href="{{url ('bower_components/jvectormap/jquery-jvectormap.css')}}">
  <!-- Date Picker -->
  <link rel="stylesheet" href="{{url ('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{url ('bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="{{url ('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- DataTables -->
  <link rel="stylesheet" href="{{url ('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{url ('bower_components/datatables.net-bs/css/responsive.bootstrap.min.css')}}">

   <!-- Select 2 -->
  <link rel="stylesheet" href="{{url ('bower_components/select2/dist/css/select2.min.css')}}">

  <!-- FullCalendar -->
  <link rel="stylesheet" href="{{url ('bower_components/fullcalendar/dist/fullcalendar.min.css')}}">
  <link rel="stylesheet" href="{{url ('bower_components/fullcalendar/dist/fullcalendar.print.min.css')}}" media="print">
  
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-green sidebar-mini login-page">



    @if (Auth::User())

        <div class="wrapper">
            @include('modulos.cabecera')

            @if (auth()->user()->rol == 'Veterinario')

                @include('modulos.menuVet')
              
            @else
            
                @include('modulos.menu')

            @endif

            @yield('contenido')
        </div>
        

     @else

        @yield('ingresar')
            
    @endif   

<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="{{url ('bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{url ('bower_components/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="{{url ('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- Morris.js charts -->
<script src="{{url ('bower_components/raphael/raphael.min.js')}}"></script>
<script src="{{url ('bower_components/morris.js/morris.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{url ('bower_components/jquery-sparkline/dist/jquery.sparkline.min.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{url ('bower_components/jquery-knob/dist/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{url ('bower_components/moment/min/moment.min.js')}}"></script>
<script src="{{url ('bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<!-- datepicker -->
<script src="{{url ('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<!-- Slimscroll -->
<script src="{{url ('bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{url ('bower_components/fastclick/lib/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{url ('dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{url ('dist/js/pages/dashboard.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{url ('dist/js/demo.js')}}"></script>
<script type="text/javascript" src="{{url ('bower_components/input-mask/jquery.inputmask.js')}}"></script>

<!-- DataTables -->
<script type="text/javascript" src="{{url ('bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{url ('bower_components/datatables.net-bs/js/dataTables.responsive.min.js')}}"></script>
<script type="text/javascript" src="{{url ('bower_components/datatables.net-bs/js/responsive.bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{url ('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>

<!-- Select 2 -->
<script src="{{url ('bower_components/select2/dist/js/select2.full.min.js')}}"></script>

<!-- FullCalendar -->
<script src="{{url ('bower_components/fullcalendar/dist/fullcalendar.min.js')}}"></script>
<script src="{{url ('bower_components/fullcalendar/dist/locale/es.js')}}"></script>

<!-- CKeditor -->
<script src="{{url ('bower_components/ckeditor/ckeditor.js')}}"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script type="text/javascript">

  $(".sidebar-menu").tree();
  $("[data-mask]").inputmask();
  $(".table").DataTable({

    <?php

      $exp = explode("/", $_SERVER["REQUEST_URI"]);

      if ($exp[3] == 'Citas-Hoy') {

        echo '"order": [[ 0, "asc" ]],';

      }

    ?>
    
    "ordering": false,

    "language": {
      
      "sSearch": "Buscar:",
      "sEmptyTable": "No hay datos en la Tabla",
      "sZeroRecords": "No se encontraron resultados",
      "sInfo": "Mostrando registros del _START_ al _END_ de un total _TOTAL_",
      "SInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0",
      "sInfoFiltered": "(filtrando de un total de _MAX_ registros)",
      "oPaginate": {

        "sFirst": "Primero",
        "sLast": "Último",
        "sNext": "Siguiente",
        "sPrevious": "Anterior"

      },

      "sLoadingRecords": "Cargando...",
      "sLengthMenu": "Mostrar _MENU_ registros"
    

    }

  });

  $(".select2").select2();
  if ($('#editor').length > 0) { 
      if (!CKEDITOR.instances['editor']) {
          CKEDITOR.replace('editor'); 
      }
  }
  
  if ($('#editor2').length > 0) { 
      if (!CKEDITOR.instances['editor2']) {
          CKEDITOR.replace('editor2'); 
      }
  }

  if ($('#editor3').length > 0) { 
      if (!CKEDITOR.instances['editor3']) {
          CKEDITOR.replace('editor3'); 
      }
  }

  if ($('#detalles').length > 0) { 
      if (!CKEDITOR.instances['detalles']) {
          CKEDITOR.replace('detalles'); 
      }
  }

</script>

<script type="text/javascript">

  @if (session('UsuarioCreado') == 'OK')

    Swal.fire(
      '¡Creado!',
      'El usuario ha sido creado correctamente.',
      'success'
    )
  @elseif (session('UsuarioActualizado') == 'OK')

    Swal.fire(
      '¡Actualizado!',
      'El usuario ha sido actualizado correctamente.',
      'success'
    )

   @elseif (session('ClienteAgregado') == 'OK')

    Swal.fire(
      '¡Creado!',
      'El cliente ha sido agregado correctamente.',
      'success'
    )

  @elseif (session('ClienteActualizado') == 'OK')

    Swal.fire(
      '¡Actualizado!',
      'El cliente ha sido actualizado correctamente.',
      'success'
    )

  @elseif (session('MascotaAgregada') == 'OK')

    Swal.fire(
      '¡Creado!',
      'La mascota ha sido agregada correctamente.',
      'success'
    )

  @elseif (session('MascotaActualizada') == 'OK')

    Swal.fire(
      '¡Actualizado!',
      'La mascota ha sido actualizada correctamente.',
      'success'
    )

  @elseif (session('MascotaActualizada') == 'OK')

    Swal.fire(
      '¡Actualizado!',
      'La mascota ha sido actualizada correctamente.',
      'success'
    )

  @elseif (session('VacunaAgregada') == 'OK')

    Swal.fire(
      '¡Creada!',
      'La vacuna ha sido agregada correctamente.',
      'success'
    )

  @elseif (session('VeterinarioCreado') == 'OK')

    Swal.fire(
      '¡Creado!',
      'El veterinario ha sido creado correctamente.',
      'success'
    )

  @elseif (session('CitaAgendada') == 'OK')

    Swal.fire(
      '¡Creado!',
      'La cita ha sido agendada correctamente.',
      'success'
    )

  @elseif (session('HistorialAgragado') == 'OK')

    Swal.fire(
      '¡Agregado!',
      'El historial ha sido agregado correctamente.',
      'success'
    )

  @elseif (session('HistorialActualizado') == 'OK')

    Swal.fire(
      '¡Actualizado!',
      'El historial ha sido actualizado correctamente.',
      'success'
    )

  @elseif (session('RecetaCreada') == 'OK')

    Swal.fire(
      '¡Creada!',
      'La receta ha sido creada correctamente.',
      'success'
    )

  @elseif (session('RecetaActualizada') == 'OK')

    Swal.fire(
      '¡Actualizada!',
      'La receta ha sido actualizada correctamente.',
      'success'
    )

  @endif

</script>

@php
    
  $exp = explode("/", $_SERVER["REQUEST_URI"]);

@endphp

@if ($exp[3] == 'Editar-Usuario')

  <script type="text/javascript">

    $('#EditarUsuario').modal('toggle');

  </script>
  
@elseif ($exp[3] == 'Editar-Mascota')

  <script type="text/javascript">

    $('#EditarMascota').modal('toggle');

  </script>
  
@endif

<script type="text/javascript">

  $(".EliminarUsuario").click(function(){

    var usuario = $(this).attr("usuario");
    var Uid = $(this).attr("Uid");

    Swal.fire({
      title: '¿Está seguro de eliminar este usuario: '+usuario+'?',
      text: "¡No podrá revertir esta acción!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Sí, eliminarlo!'
    }).then((result) => {
      if (result.isConfirmed) {

        window.location = 'Eliminar-Usuario/'+Uid;

      }
    })

  });

  $(".EliminarMascota").click(function(){

    var mascota = $(this).attr("mascota");
    var Mid = $(this).attr("Mid");

    Swal.fire({
      title: '¿Está seguro de eliminar esta mascota: '+mascota+'?',
      text: "¡No podrá revertir esta acción!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Sí, eliminarlo!'
    }).then((result) => {
      if (result.isConfirmed) {

        window.location = 'Eliminar-Mascota/'+Mid;

      }
    })

  });

</script>

@if ($exp [3] == 'Calendario')

  <script type="text/javascript">

    var date = new Date();
    var d = date.getDate(),
        m = date.getMonth(),
        a = date.getFullYear()

      $('#calendario').fullCalendar({

        

          defaultView: 'agendaWeek',
          hiddenDays: [ 0, 6 ],

          events: [

              @foreach ($citas as $cita )

                @foreach ($mascotas as $mascota)

                  @if ($cita->id_mascota == $mascota->id)

                    @if ($cita->estado == 'Solicitada')

                      {
                        id : '{{$cita->id}}',
                        title : '{{$mascota->DUEÑO->nombre}} - {{$mascota->nombre}} | {{$cita->estado}}',
                        start : '{{$cita->inicio}}',
                        end : '{{$cita->fin}}',
                        backgroundColor : '#1C72FF',
                        borderColor : '#1C72FF'
                      },
                    @elseif ($cita->estado == 'Finalizada')

                      {
                        id : '{{$cita->id}}',
                        title : '{{$mascota->DUEÑO->nombre}} - {{$mascota->nombre}} | {{$cita->estado}}',
                        start : '{{$cita->inicio}}',
                        end : '{{$cita->fin}}',
                        backgroundColor : '#0FA603',
                        borderColor : '#0FA603'
                      },

                    @elseif ($cita->estado == 'En Proceso')

                      {
                        id : '{{$cita->id}}',
                        title : '{{$mascota->DUEÑO->nombre}} - {{$mascota->nombre}} | {{$cita->estado}}',
                        start : '{{$cita->inicio}}',
                        end : '{{$cita->fin}}',
                        backgroundColor : '#D88B03',
                        borderColor : '#D88B03'
                      },

                    @endif                  
                    
                  @endif
                  
                @endforeach
                
              @endforeach

          ],
          scrollTime: '08:00:00',
          minTime: '09:00:00',
          maxTime: '18:00:00',

          dayClick: function(date, jsEvent, view) {

            var fecha = date.format();

            fecha = fecha.split("T");

            n = new Date();
            d = n.getDate(),
            m = n.getMonth() + 1,
            y = n.getFullYear()

            if (m < 10) {

              M = "0" + m;

            }else {

              M = m;

            }
            if (d < 10) {

              D = "0" + d;

            }else {

              D = d;

            }
            diaActual = y + "-" + M + "-" + D;

            if (diaActual <= fecha[0]){

              @if ($veterinario->estado == 'Disponible')

                $("#CitaModal").modal();

              @endif

            }

            $("#fecha").val(fecha[0]);
            horaModal = fecha[1].split(":");
            $("#hora").val(horaModal[0] + ':' + horaModal[1]);

            if (horaModal[1] == '00') {
              horaFin = horaModal[0];
              minutosFin = '30';
            }
            else {
              horaFin = parseFloat(horaModal[0]) + 1;
              minutosFin = '00';

            }
            $("#fyhInicial").val(fecha[0] + ' ' + fecha[1]);
            $("#fyhFinal").val(fecha[0] + ' ' + horaFin + ':' + minutosFin +':00');


            if (!CKEDITOR.instances['editor']) {
                CKEDITOR.replace('editor');
            }

          },

          eventClick: function(calEvent, jsEvent, view) {

            $("#CancelarCita").modal();

            $("#paciente").html(calEvent.title);
            $("#CitaId").val(calEvent.id);

          }

      });

      $('#cliente').change(function(){

        var clienteId = $(this).val();
        var url = $(this).attr("url");

        $.ajax({

          url: url + '/Obtener-Mascotas/' + clienteId,
          type: 'GET',
          success: function(data) {

            $("#mascotas").empty();

            $('#mascotas').append('<option value="">Seleccionar Mascota</option>');

            $.each(data, function(key, mascota) {

              $('#mascotas').append('<option value="' + mascota.id + '">' + mascota.nombre + '</option>');

            });

          }
        })

      });

  </script>

@endif

</body>
</html>
