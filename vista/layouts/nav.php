
<!--Select2-->
<link rel="stylesheet" href="../css/select2.css">
<!--Sweetalert2-->
<link rel="stylesheet" href="../css/sweetalert2.css">

  <!-- General CSS Files -->
  <link rel="stylesheet" href="../css/bootstrap.min.css">

    <!-- Font Awesome -->
  <link rel="stylesheet" href="../css/css/all.min.css">

  <!-- CSS Libraries -->

  <!-- Template CSS -->
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/components.css">
<!-- Start GA -->
<!-- <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script> -->

<!-- /END GA -->
</head>

<body>
<div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
          </ul>
          <div class="search-element">
            <input class="form-control" type="search" placeholder="Search" aria-label="Search" data-width="250">
            <button class="btn" type="submit"><i class="fas fa-search"></i></button>
            <div class="search-backdrop"></div>
            
          </div>
        </form>
        <ul class="navbar-nav navbar-right">
         
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <!--Usuario y Imagen-->
            <img alt="image" src="../img/avatar.png" id="avatar4"  class="rounded-circle mr-1">
            <div class="d-sm-none d-lg-inline-block">
              <?php
                echo $_SESSION['nombre_us'];
            ?></div></a>
            <div class="dropdown-menu dropdown-menu-right">
              <div class="dropdown-title">Logged in 5 min ago</div>
              <a href="editar_datos_personales.php" class="dropdown-item has-icon">
                <i class="far fa-user"></i> Datos Personales
              </a>
              <a href="features-activities.html" class="dropdown-item has-icon">
                <i class="fas fa-bolt"></i> Activities
              </a>
              <a href="features-settings.html" class="dropdown-item has-icon">
                <i class="fas fa-cog"></i> Settings
              </a>
                <!--Serrar Sesion-->
              <div class="dropdown-divider"></div>
              <a href="../controlador/Logout.php" class="dropdown-item has-icon text-danger">
                <i class="fas fa-sign-out-alt"></i> Cerrar Cesion
              </a>
            </div>
          </li>
        </ul>
      </nav>

<!--Nav o aside-->
      <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="../vista/adm_catalogo.php">
              <img src="../img/logo.png" alt="AdminLTE Logo" class="rounded-circle" style="opacity: .8" width="40">
              Farmacia</a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">Dr</a>
          </div>
          <ul class="sidebar-menu">
            <li class="menu-header "><i class="far fa-user"></i> Usuario</li>
            <li class="dropdown">
              <a  href="editar_datos_personales.php" class="nav-link"><span>Datos Personales</span></a>
            </li>
            <li class="dropdown">
              <a href="adm_usuario.php" class="nav-link"><span>Gestion De Usuario</span></a>
            </li>

            <li class="menu-header">Almacenamiento</li>
            <li>
              <a href="adm_producto.php" class="nav-link"><i class="nav-icon fas fa-pills"></i> <span>Gestion Producto</span></a>
            </li>
            <li><a class="nav-link" href="adm_atributo.php"><i class="nav-icon fas fa-vials"></i> <span>Gestion Atributo</span></a></li>
            
                
        </aside>
      </div>

      <!-- Main Content -->
      