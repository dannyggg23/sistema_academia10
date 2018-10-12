
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Club Deportivo</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../public/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../public/css/font-awesome.css">
    <link rel="stylesheet" href="../public/css/imgs.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="../public/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../public/css/_all-skins.min.css">
    <link rel="apple-touch-icon" href="../public/img/apple-touch-icon.png">
    <link rel="shortcut icon" href="../public/img/favicon.ico">

    <!-- DATATABLES -->
    <link rel="stylesheet" type="text/css" href="../public/datatables/jquery.dataTables.min.css">
    <link href="../public/datatables/buttons.dataTables.min.css" rel="stylesheet"/>
    <link href="../public/datatables/responsive.dataTables.min.css" rel="stylesheet"/>

    <link rel="stylesheet" type="text/css" href="../public/css/bootstrap-select.min.css">

  </head>
  <body class="hold-transition skin-blue-light sidebar-mini sidebar-collapse">
    <div class="wrapper">

      <header class="main-header">

        <!-- Logo -->
        <a href="escritorio.php" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini">
            <i class="fa fa-soccer-ball-o"></i>
          </span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Club Deportivo</b></span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Navegación</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->

            </ul>
          </div>

        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header"></li>
            <li>
              <a href="escritorio.php">
                <i class="fa fa-tasks fa-lg" ></i> <span>Escritorio</span>
              </a>
            </li>

            <li>
              <a href="sucursal.php">
                <i class="fa fa-map-marker fa-lg"></i> <span>Sucursales</span>
              </a>
            </li>

            <li>
              <a href="chsucursales.php">
                <i class="fa fa-th fa-lg"></i> <span>Categorías</span>
              </a>
            </li>
      

             <li class="treeview">
                <a href="entrenador.php">
                  <i class="fa fa-file-text-o fa-lg"></i>
                  <span>Entrenadores</span>
                </a>
              </li>

          <li class="treeview">
              <a href="alumno.php">
                <i class="fa fa-file-text fa-lg"></i>
                <span>Alumnos</span>
                
              </a>
            
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-soccer-ball-o fa-lg"></i>
                <span>Productos-Servicios</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="categoria_ps.php"><i class="fa fa-circle-o"></i> Categorías</a></li>
                <li><a href="productos_servicios.php"><i class="fa fa-circle-o"></i> Productos-Servicios</a></li>
              </ul>
            </li>

             <li class="treeview">
                  <a href="#">
                    <i class="fa fa-dollar fa-lg"></i>
                    <span>Facturación</span>
                     <i class="fa fa-angle-left pull-right"></i>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="pago.php"><i class="fa fa-circle-o"></i> Mensualidades</a></li>
                    <li><a href="factura.php"><i class="fa fa-circle-o"></i> Productos-Servicios</a></li>
                  </ul>
                </li>


          <li class="treeview">
              <a href="#">
                <i class="fa fa-gears fa-lg"></i> <span>Configuración</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="usuario.php"><i class="fa fa-circle-o"></i> Usuarios</a></li>
                <li><a href="horario.php"><i class="fa fa-circle-o"></i> Horarios</a></li>
                <li><a href="categoria.php"><i class="fa fa-circle-o"></i> Categorias</a></li>
                <li><a href="academia.php"><i class="fa fa-circle-o"></i> Datos Academia</a></li>
                <li><a href="pagos_deposito.php"><i class="fa fa-circle-o"></i> Depósitos</a></li>
                <li><a href="imagenes_app.php"><i class="fa fa-circle-o"></i>Imagenes App</a></li>

                <!--<li><a href="permiso.php"><i class="fa fa-circle-o"></i> Permisos</a></li>-->

              </ul>
            </li>

          <li class="treeview">
              <a href="#">
                <i class="fa fa-bar-chart fa-lg"></i> <span>Consultas</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="cpagos.php"><i class="fa fa-circle-o"></i> Consulta de pagos</a></li>
                 <li><a href="cfichas.php"><i class="fa fa-circle-o"></i> Consulta de Alumnos</a></li>
                <li><a href="cdeudores.php"><i class="fa fa-circle-o"></i> Consulta de Deudores</a></li>
                <li><a href="asistencia.php"><i class="fa fa-circle-o"></i> Consulta de Asistencias</a></li>
                <li><a href="cpagosfichas.php"><i class="fa fa-circle-o"></i>Reporte mensualidades</a></li>
              </ul>
            </li>

            
            <li class="treeview">
              <a href="#">
                <i class="fa fa-newspaper-o fa-lg"></i> <span>Noticias</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
              
                 <li><a href="noticias_todos.php"><i class="fa fa-circle-o"></i>Noticias</a></li>
                 <!-- <li><a href="noticias_todos.php"><i class="fa fa-circle-o"></i>Noticias</a></li> -->
                 <li><a href="imagenes.php"><i class="fa fa-circle-o"></i>Agregar imagenes</a></li>
              
              </ul> 
            </li>

            <li>
              <a href="notificaciones.php">
                <i class="fa fa-bell-o fa-lg"></i> <span>Notificaciones</span>
                <small class="label pull-right bg-red">°</small>
              </a>
            </li>



          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>