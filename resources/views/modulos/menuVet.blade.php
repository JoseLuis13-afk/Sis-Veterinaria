  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      {{-- <div class="user-panel">
        <div class="pull-left image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Alexander Pierce</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form --> --}}
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" >

        <li class="header">MAIN NAVIGATION</li>    
        <li>
          <a href="{{url('Inicio')}}">
             <i class="fa fa-home"></i> 
            <span>Inicio</span> 
          </a>
        </li>

        <li>
          <a href="{{url('Clientes')}}">
             <i class="fa fa-user-plus"></i> 
            <span>Clientes</span> 
          </a>
        </li>

        <li>
          <a href="{{url('Mascotas')}}">
             <i class="fa fa-paw"></i> 
            <span>Mascotas</span> 
          </a>
        </li>
        
        <li class="treeview">

          <a href="#">
            <i class="fa fa-list-ul"></i> <span>Clínica</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>

          <ul class="treeview-menu">

            <li>
              <a href="{{url('Citas-Hoy/'.auth()->user()->id)}}">
                <i class="fa fa-calendar-check-o"></i> 
                <span>Citas</span> 
              </a>
            </li>

            <li>
               <a href="{{url('Internaciones')}}">
                <i class="fa fa-hospital-o"></i> 
               <span>Internaciones</span> 
              </a>
           </li>

          </ul>

        </li>

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>