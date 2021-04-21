<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=0.9">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Sistema de venta</title>

 
  
  <?php if (isset($_SESSION['admin']) || isset($_SESSION['identity'])) { ?>
 
    <link rel="stylesheet" href="<?= base_url ?>/public/style.css">

  <?php } else { ?>

    <link rel="stylesheet" href="<?= base_url ?>/public/login.css">

  <?php } ?>

  <script src="<?= base_url ?>/public/jquery/jquery.js" type="text/javascript"></script>
  <script src="<?= base_url ?>/public/scripts.js" text="text/javascript"></script>

  <!-- Scripts -->

  <script src="<?= base_url ?>/public/functions/home.js" text="text/javascript"></script>
  <script src="<?= base_url ?>/public/functions/users.js" text="text/javascript"></script>
  <script src="<?= base_url ?>/public/functions/invoices.js" text="text/javascript"></script>
  <script src="<?= base_url ?>/public/functions/products.js" text="text/javascript"></script>
  <script src="<?= base_url ?>/public/functions/services.js" text="text/javascript"></script>
  <script src="<?= base_url ?>/public/functions/contacts.js" text="text/javascript"></script>
  <script src="<?= base_url ?>/public/functions/price_list.js" text="text/javascript"></script>
  <script src="<?= base_url ?>/public/functions/payments.js" text="text/javascript"></script>
  <script src="<?= base_url ?>/public/functions/categories.js" text="text/javascript"></script>
  <script src="<?= base_url ?>/public/functions/taxes.js" text="text/javascript"></script>
  <script src="<?= base_url ?>/public/functions/inventory_control.js" text="text/javascript"></script>

 
  <!-- Font-Awesome -->

  <link rel="stylesheet" href="<?= base_url ?>/public/font-awesome/css/all.min.css">
  <script src="<?= base_url ?>/public/font-awesome/js/all.min.js" text="text/javascript"></script>

  <!-- Google Fonts -->

  <link href="https://fonts.googleapis.com/css?family=Barlow+Condensed:400,700|PT+Sans:400,700|Cabin&display=swap" rel="stylesheet">

  <!-- Bootstrap4 -->
  <script src="<?= base_url ?>/public/bootstrap4/js/bootstrap.min.js" type="text/javascript"></script>
  <script src="<?= base_url ?>/public/bootstrap4/js/popper.min.js" type="text/javascript"></script>
  <link rel="stylesheet" href="<?= base_url ?>/public/bootstrap4/css/bootstrap.min.css">

  <!-- Data Table -->

  <link rel="stylesheet" href="<?= base_url ?>/public/datatable/dataTables.bootstrap4.min.css">

  <script src="<?= base_url ?>/public/datatable/jquery.dataTables.min.js" text="text/javascript"></script>
  <script src="<?= base_url ?>/public/datatable/dataTables.bootstrap4.min.js"></script>

  <!-- Select2 -->

  <link rel="stylesheet" href="<?= base_url ?>/public/select2/select2.min.css">
  <script src="<?= base_url ?>/public/select2/select2.full.min.js" text="text/javascript"></script>

  <!-- AlertifyJS -->

  <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />

  <!-- ChartJS -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>

</head>

<body>

  <?php if (isset($_SESSION['admin']) || isset($_SESSION['identity'])) : ?>

    <div class="loader">
      <div class="loading">
        <div class="load">

          <div class="loadingio-spinner-spin-cx0o90u04yc">
            <div class="ldio-1q5n8ygi9ox">
              <div>
                <div></div>
              </div>
              <div>
                <div></div>
              </div>
              <div>
                <div></div>
              </div>
              <div>
                <div></div>
              </div>
              <div>
                <div></div>
              </div>
              <div>
                <div></div>
              </div>
              <div>
                <div></div>
              </div>
              <div>
                <div></div>
              </div>
            </div>
          </div>


        </div>
      </div>
    </div>

    <section class="contenido">

      <aside class="sidebar clearfix">
        <nav class="app-menu">
          <div class="logo">
            <span><?php echo $_SESSION['identity']->username ?> </span>
          </div>

          <ul id="accordion" class="accordion">
            <li>
              <div class="link"><a href="<?= base_url ?>home/index"><i class="mr-3 fas fa-home"></i>Inicio</a></div>
            </li>

            <li class="dropdown-1">
              <div class="link"><i class="mr-3 fas fa-arrow-circle-down"></i>Ventas <i class="fas fa-chevron-down"></i></div>
              <ul class="submenu ">
                <li class="page"><a href="<?= base_url ?>invoices/index">Factura de venta</a> <a href="<?= base_url ?>invoices/addpurchase"><i class="fas fa-plus-circle"></i></a></li>
                <li class="page"><a href="<?= base_url ?>services/invoices">Factura de servicio</a> <a href="<?= base_url ?>services/addpurchase"><i class="fas fa-plus-circle"></i></a></li>
                <li><a href="<?= base_url ?>payments/index">Pagos recibidos</a> </li>

              </ul>
            </li>

            <li class="dropdown-2">
              <div class="link"><i class="mr-3 fas fa-box"></i>Inventario <i class="fas fa-chevron-down"></i></div>
              <ul class="submenu ">
                <li class="page"><a href="<?= base_url ?>product/index">Items de venta</a> <a href="<?= base_url ?>product/add"><i class="fas fa-plus-circle"></i></a></li>
                <li class="page"><a href="<?= base_url ?>services/index">Items no inventariable</a> <a href="<?= base_url ?>services/add"><i class="fas fa-plus-circle"></i></a></li>
                <li class="page"><a href="<?= base_url ?>inventory_control/index">Ajustes de inventario</a> <a href="<?= base_url ?>inventory_control/add"><i class="fas fa-plus-circle"></i></a></li>
                <li><a href="<?= base_url ?>inventory_control/inventory">Valor de inventario</a></li>
                <li class="page"><a href="<?= base_url ?>price_list/index">Lista de précios</a> <a href="<?= base_url ?>price_list/add"><i class="fas fa-plus-circle"></i></a></li>
                <!-- <li class="page"><a href="">Almacenes</a></li> -->
                <li class="page"><a href="<?= base_url ?>categories/index">Categorías</a> <a href="<?= base_url ?>categories/add"><i class="fas fa-plus-circle"></i></a></li>
                <li class="page"><a href="<?= base_url ?>taxes/index">Impuestos</a> <a href="<?= base_url ?>taxes/add"><i class="fas fa-plus-circle"></i></a></li>

              </ul>
            </li>

            <li class="dropdown-3">
              <div class="link"><i class="mr-3 fas fa-address-book"></i>Contactos <i class="fas fa-chevron-down"></i></div>
              <ul class="submenu">
                <li class="page"><a href="<?= base_url ?>contacts/index">Contactos</a> <a href="<?= base_url ?>contacts/add"><i class="fas fa-plus-circle"></i></a></li>
              </ul>
            </li>

            <li class="dropdown-4">
              <div class="link"><i class="mr-3 fas fa-project-diagram"></i>Reportes <i class="fas fa-chevron-down"></i></div>
              <ul class="submenu">
                <li><a href="<?= base_url ?>">Ventas</a></li>
              </ul>
            </li>




            <!-- <li class="dropdown-6">
            <div class="link"><i class="mr-3 fas fa-users"></i>Usuarios <i class="fas fa-chevron-down"></i></div>
            <ul class="submenu">
              <li><a href="<?= base_url ?>contacts/add">Nuevo usuario</a></li>
              <li><a href="<?= base_url ?>users/index">Usuarios</a></li>
            </ul>
          </li> -->
            <!-- 
          <li>
            <div class="link"><a href="<?= base_url ?>">Configuración</a></div>
          </li> -->


            <li>
              <a id="logout" href="#"><i class="mr-3 fas fa-home"></i>Cerrar sesión</a>
            </li>

          </ul>2


        </nav>
      </aside>

      <header class="admin-bar">

        <!-- <div class="cantainer">
        <div class="option">
          <i class="menu-option fas fa-th-large"></i>
          <ul class="nav-option">

            <li><a href="">Nueva Factura</a></li>
            <li><a href="">Créditos</a></li>
            <li><a href="">Productos</a></li>
          </ul>

          <input class="form-search" type="search" name="" value="Buscar" id="">
        </div>

        </div>

        <div class="admin">
        <strong> Admin | </strong>
        <a>Cerrar sesion</a>
      </div> -->
      </header>

      <div class="main wrap">
        <main>



        <?php endif; ?>