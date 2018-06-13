
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
  <body class="hold-transition skin-blue-light sidebar-mini">
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
                <i class="fa fa-tasks"></i> <span>Escritorio</span>
              </a>
            </li>

            <li class="treeview">
              <a href="#">
                <i class="fa fa-map-marker"></i>
                <span>Sucursales</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="sucursal.php"><i class="fa fa-circle-o"></i> Sucursal</a></li>
              </ul>
            </li>

          <li class="treeview">
              <a href="#">
                <i class="fa fa-th"></i>
                <span>Categorías</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="horario.php"><i class="fa fa-circle-o"></i> Horarios</a></li>
                <li><a href="categoria.php"><i class="fa fa-circle-o"></i> Categorias</a></li>
              </ul>
            </li>

          <li class="treeview">
              <a href="#">
                <i class="fa fa-file-text"></i>
                <span>Ficha-Alumno</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="representante.php"><i class="fa fa-circle-o"></i> Representante</a></li>
                <li><a href="alumno.php"><i class="fa fa-circle-o"></i> Alumno</a></li>
                <li><a href="ficha_alumno.php"><i class="fa fa-circle-o"></i> Ficha</a></li>
              </ul>
            </li>

            <li class="treeview">
                <a href="#">
                  <i class="fa fa-file-text-o"></i>
                  <span>Ficha-Entrenador</span>
                   <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  
                  <li><a href="entrenador.php"><i class="fa fa-circle-o"></i> Entrenador</a></li>
                  <li><a href="ficha_entrenador.php"><i class="fa fa-circle-o"></i> Ficha</a></li>
                </ul>
              </li>

              <li class="treeview">
                  <a href="#">
                    <i class="fa fa-credit-card"></i>
                    <span>Pagos</span>
                     <i class="fa fa-angle-left pull-right"></i>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="pago.php"><i class="fa fa-circle-o"></i> Factura</a></li>
                  </ul>
                </li>

                <li class="treeview">
                    <a href="#">
                      <i class="fa fa-list-ul"></i>
                      <span>Jugadores</span>
                       <i class="fa fa-angle-left pull-right"></i>
                    </a>

                    <ul class="treeview-menu">
                      <li><a href="repressentante.php"><i class="fa fa-circle-o"></i> Asistencia</a></li>
                      <li><a href="repressentante.php"><i class="fa fa-circle-o"></i> Hablilidad</a></li>
                    </ul>
                  </li>

          <li class="treeview">
              <a href="#">
                <i class="fa fa-folder"></i> <span>Acceso</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="usuario.php"><i class="fa fa-circle-o"></i> Usuarios</a></li>
                <li><a href="permiso.php"><i class="fa fa-circle-o"></i> Permisos</a></li>

              </ul>
            </li>

          <li class="treeview">
              <a href="#">
                <i class="fa fa-bar-chart"></i> <span>Consultass</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="cpagos.php"><i class="fa fa-circle-o"></i> Consulta de pagos</a></li>
                 <li><a href="cfichas.php"><i class="fa fa-circle-o"></i> Consulta de fichas</a></li>
                <li><a href="cdeudores.php"><i class="fa fa-circle-o"></i> Consulta de Deudores</a></li>
              </ul>
            </li>



            <li>
              <a href="#">
                <i class="fa fa-plus-square"></i> <span>Ayuda</span>
                <small class="label pull-right bg-red">PDF</small>
              </a>
            </li>

            <li>
              <a href="#">
                <i class="fa fa-info-circle"></i> <span>Acerca De...</span>
                <small class="label pull-right bg-yellow">IT</small>
              </a>
            </li>

          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>
