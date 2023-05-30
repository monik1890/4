<?php
   require_once "../../../conexion.php";
   $id = $_GET['u'];
   $sql = "SELECT * FROM usuarios WHERE id = $id";
   $result = mysqli_query($link,$sql);
   while($row = mysqli_fetch_array($result)) {
     $usuario = $row['usuario'];
   }
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Sistema envios | Pedidos</title>
      
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
      
      <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
     
      <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
      <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
      <link rel="stylesheet" href="../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
      
      <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
   </head>
   <body class="hold-transition sidebar-mini">
      <div class="wrapper">
        
         <aside class="main-sidebar sidebar-dark-primary elevation-4">
           
            <a href="index3.html" class="brand-link">
            <img src="../../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">Sistema envios</span>
            </a>
            
            <div class="sidebar">
               
               <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                  <div class="image">
                     <img src="../../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                  </div>
                  <div class="info">
                     <a href="#" class="d-block"><?php echo $usuario; ?></a>
                  </div>
               </div>
               
               <nav class="mt-2">
                  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                   
                     <li class="nav-item menu-open">
                        <a href="../../index.php?u=<?php echo $id?>" class="nav-link">
                           <i class="nav-icon fas fa-tachometer-alt"></i>
                           <p>
                              Administrador
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
               
            </div>
            
         </aside>
         
         <div class="content-wrapper">
            
            <section class="content-header">
               <div class="container-fluid">
                  <div class="row mb-2">
                     <div class="col-sm-6">
                        <h1>Hoja de pedidos</h1>
                     </div>
                     <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                           <li class="breadcrumb-item">Inicio</li>
                           <li class="breadcrumb-item active">Tabla pedidos</li>
                        </ol>
                     </div>
                  </div>
               </div>
               
            </section>
            
            <section class="content">
               <div class="container-fluid">
                  <div class="row">
                     <div class="col-12">
                        <div class="card">
                           <div class="card-header">
                              <h3 class="card-title">Hoja de pedidos de <?php echo $usuario; ?></h3>
                           </div>
                           
                           <div class="card-body">
                              <table id="example1" class="table table-bordered table-striped">
                                 <thead>
                                    <tr>
                                       <th>Cod. interno</th>
                                       <th>Fecha hora del pedido</th>
                                       <th>Codigo de envio</th>
                                       <th>direccion</th>
                                       <th>Precio</th>
                                       <th>Municipio</th>
                                       <th>Acciones</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php
                                       // Consulta SQL para obtener los datos
                                       $sql = "SELECT p.id_usuario, p.id, p.fecha_pedido, p.cod_envio, p.direccion, p.total_pedido, m.municipio
                                       FROM pedidos_usuario p
                                       INNER JOIN municipios m ON p.municipio_id = m.id_municipio
                                       WHERE p.id_usuario = $id";
                                       
                                       // Ejecutar la consulta
                                       $resultado = mysqli_query($link, $sql);
                                       
                                       // Verificar si se encontraron resultados
                                       if (mysqli_num_rows($resultado) > 0) {
                                             // Recorrer los resultados y mostrar cada fila en la tabla
                                       while ($fila = mysqli_fetch_assoc($resultado)) {
                                         echo "<tr>
                                                 <td class='align-middle text-center'>".$fila['id']."</td>
                                                 <td class='align-middle text-center'>".$fila['fecha_pedido']."</td>
                                                 <td class='align-middle text-center'>".$fila['cod_envio']."</td>
                                                 <td class='align-middle text-center'>".$fila['direccion']."</td>
                                                 <td class='align-middle text-center'>".$fila['total_pedido']."</td>
                                                 <td class='align-middle text-center'>".$fila['municipio']."</td>
                                                 <td class='align-middle text-center'>
                                                 <div class='btn-group'>
                                                 <button type='button' class='btn btn-info'>Seleccione</button>
                                                 <button type='button' class='btn btn-info dropdown-toggle dropdown-icon' data-toggle='dropdown' aria-expanded='false'>
                                                   <span class='sr-only'>Toggle Dropdown</span>
                                                 </button>
                                                 <div class='dropdown-menu' role='menu' style=''>
                                                   <a class='dropdown-item' href='ver.php?id=".$fila['id']."&u=".$id."'>Ver detalles</a>
                                                   <a class='dropdown-item' href='editar.php?id=".$fila['id']."&u=".$id."'>Editar</a>
                                                   <a class='dropdown-item' href='borrar.php?id=".$fila['id']."&u=".$id."'>Eliminar</a>
                                                 </div>
                                               </div></td>
                                             </tr>";
                                       }
                                       } else {
                                       echo "No se encontraron resultados.";
                                       }
                                       
                                       // Cerrar la conexión
                                       mysqli_close($link);
                                       ?>
                                 </tbody>
                                 <tfoot>
                                    <tr>
                                       <th>Cod. interno</th>
                                       <th>Fecha hora del pedido</th>
                                       <th>Codigo de envio</th>
                                       <th>direccion</th>
                                       <th>Precio</th>
                                       <th>Municipio</th>
                                       <th>Acciones</th>
                                    </tr>
                                 </tfoot>
                              </table>
                           </div>
                           
                        </div>
                        
                     </div>
                   
                  </div>
                  
               </div>
               
            </section>
           
         </div>
         
         <footer class="main-footer">
    <strong></strong>
    
    <div class="float-right d-none d-sm-inline-block">
      <b></b> 
    </div>
  </footer>
         
         <aside class="control-sidebar control-sidebar-dark">
            
         </aside>
        
      </div>
      
      <script src="../../plugins/jquery/jquery.min.js"></script>
   
      <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
      
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
      
      <script src="../../dist/js/adminlte.min.js"></script>
      
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