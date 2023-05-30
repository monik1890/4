<?php
   require_once "../../../conexion.php";
   //Traemos el id del usuario
   $id = $_GET['u'];
   $sql = "SELECT * FROM usuarios WHERE id = $id";
   $result = mysqli_query($link,$sql);
   while($row = mysqli_fetch_array($result)) {
     $usuario = $row['usuario'];
   }
   //Traemos el id del pedido
   $id_pedido = $_GET['id'];
   $sql_pedido = "SELECT * FROM pedidos_usuario WHERE id = $id_pedido";
   $result_pedido = mysqli_query($link,$sql_pedido);
   while($row = mysqli_fetch_array($result_pedido)) {
     $cod_envio = $row['cod_envio'];
   }
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Sistema envios | Pedidos</title>
      <!-- Google Font: Source Sans Pro -->
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
      <!-- Font Awesome -->
      <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
      <!-- DataTables -->
      <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
      <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
      <link rel="stylesheet" href="../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
      <!-- Theme style -->
      <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
   </head>
   <body class="hold-transition sidebar-mini">
      <div class="wrapper">
         <!-- Main Sidebar Container -->
         <!-- Main Sidebar Container -->
         <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="index3.html" class="brand-link">
            <img src="../../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">Sistema envios</span>
            </a>
            <!-- Sidebar -->
            <div class="sidebar">
               <!-- Sidebar user panel (optional) -->
               <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                  <div class="image">
                     <img src="../../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                  </div>
                  <div class="info">
                     <a href="#" class="d-block"><?php echo $usuario; ?></a>
                  </div>
               </div>
               <!-- Sidebar Menu -->
               <nav class="mt-2">
                  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                     <!-- Add icons to the links using the .nav-icon class
                        with font-awesome or any other icon font library -->
                     <li class="nav-item menu-open">
                        <a href="../../index.php?u=<?php echo $id?>" class="nav-link">
                           <i class="nav-icon fas fa-tachometer-alt"></i>
                           <p>
                              Dashboard
                           </p>
                        </a>
                     </li>
                     <li class="nav-item menu-open">
                        <a href="#" class="nav-link active">
                           <i class="nav-icon fas fa-table"></i>
                           <p>
                              Pedidos
                              <i class="fas fa-angle-left right"></i>
                           </p>
                        </a>
                        <ul class="nav nav-treeview">
                           <li class="nav-item">
                              <a href="./pedido.php?u=<?php echo $id; ?>" class="nav-link active">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Ver pedidos</p>
                              </a>
                           </li>
                           <li class="nav-item">
                              <a href="./nuevo_pedido.php?u=<?php echo $id; ?>" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Nuevo pedido</p>
                              </a>
                           </li>
                        </ul>
                     </li>
                     <li class="nav-item menu-open">
                        <a href="../../../cerrar-sesion.php?>">
                           <p>
                              Cerrar sesion
                           </p>
                        </a>
                     </li>
                  </ul>
               </nav>
               <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
         </aside>
         <!-- Content Wrapper. Contains page content -->
         <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
               <div class="container-fluid">
                  <div class="row mb-2">
                     <div class="col-sm-6">
                        <h1>Hoja de pedidos</h1>
                     </div>
                     <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                           <li class="breadcrumb-item">Inicio</li>
                           <li class="breadcrumb-item active">Ver pedidos</li>
                        </ol>
                     </div>
                  </div>
               </div>
               <!-- /.container-fluid -->
            </section>
            <!-- Main content -->
            <section class="content">
               <div class="container-fluid">
               <div class="row">
          <!-- ./col -->
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-text-width"></i>
                  Description del envio <?php echo $cod_envio; ?>
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <dl class="row">
                    <?php
                        // Consulta SQL para obtener los datos
                        $sql = "SELECT p.id, p.fecha_pedido, p.cod_envio, p.direccion, p.total_pedido, m.municipio, d.departamento
                        FROM pedidos_usuario p
                        INNER JOIN municipios m ON p.municipio_id = m.id_municipio
                        INNER JOIN departamentos d ON p.departamento_id = d.id_departamento
                        WHERE p.id = $id_pedido";
                        
                        // Ejecutar la consulta
                        $resultado = mysqli_query($link, $sql);
                        
                        // Verificar si se encontraron resultados
                        if (mysqli_num_rows($resultado) > 0) {
                                // Recorrer los resultados y mostrar cada fila en la tabla
                        while ($fila = mysqli_fetch_assoc($resultado)) {
                            echo"
                                <dt class='col-sm-4'>Codigo de envio</dt>
                                <dd class='col-sm-8'>".$fila['cod_envio']."</dd>
                                <dt class='col-sm-4'>Fecha y hora de la solicitud</dt>
                                <dd class='col-sm-8'>".$fila['fecha_pedido']."</dd>
                                <dt class='col-sm-4'>Valor total del envio</dt>
                                <dd class='col-sm-8'>$".$fila['total_pedido']."</dd>
                                <dt class='col-sm-4'>Direccion del destino</dt>
                                <dd class='col-sm-8'>".$fila['direccion']."</dd>
                                <dt class='col-sm-4'>Departamento</dt>
                                <dd class='col-sm-8'>".$fila['departamento']."</dd>
                                <dt class='col-sm-4'>Municipio</dt>
                                <dd class='col-sm-8'>".$fila['municipio']."</dd>  
                                <dt class='col-sm-4'>Acciones</dt>
                                <dd class='col-sm-8'>                
                                    <a class='btn btn-app bg-secondary' href='javascript:history.back()' style='text-decoration:none;'>
                                        <i class='fas fa-backward' style='color: white'></i>Regresar
                                    </a>
                                    <a class='btn btn-app bg-danger'  href='borrar.php?id=".$id_pedido."&u=".$id."' style='text-decoration:none;'>
                                    <i class='fas fa-expand-arrows-alt' style='color: white'></i> Eliminar
                                    </a>
                                    <a class='btn btn-app bg-warning' href='editar.php?id=".$id_pedido."&u=".$id."' style='text-decoration:none;'>
                                        <i class='fas fa-file-audio'></i> Editar
                                    </a>                                       
                                </dd>                                                                                                                                                                
                            ";
                        }
                        } else {
                        echo "No se encontraron resultados.";
                        }
                        
                        // Cerrar la conexión
                        mysqli_close($link);
                    ?>                  
                </dl>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- ./col -->
        </div>
                  <!-- /.row -->
               </div>
               <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
         </div>
         <!-- /.content-wrapper -->
         <footer class="main-footer">
    <strong></strong>
    
    <div class="float-right d-none d-sm-inline-block">
      <b></b>
    </div>
  </footer>
         <!-- Control Sidebar -->
         <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
         </aside>
         <!-- /.control-sidebar -->
      </div>
      <!-- ./wrapper -->
      <!-- jQuery -->
      <script src="../../plugins/jquery/jquery.min.js"></script>
      <!-- Bootstrap 4 -->
      <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
      <!-- DataTables  & Plugins -->
      <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
      <script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
      <script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
      <script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
      <script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
      <script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
      <script src="../../plugins/jszip/jszip.min.js"></script>
      <script src="../../plugins/pdfmake/pdfmake.min.js"></script>
      <script src="../../plugins/pdfmake/vfs_fonts.js"></script>
      <script src="../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
      <script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
      <script src="../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
      <!-- AdminLTE App -->
      <script src="../../dist/js/adminlte.min.js"></script>
      <!-- Page specific script -->
      <script>
         $(function () {
           $("#example1").DataTable({
             "responsive": true, "lengthChange": false, "autoWidth": false,
             "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
           }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
           $('#example2').DataTable({
             "paging": true,
             "lengthChange": false,
             "searching": false,
             "ordering": true,
             "info": true,
             "autoWidth": false,
             "responsive": true,
           });
         });
      </script>
   </body>
</html>