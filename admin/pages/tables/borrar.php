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

// Crear la sentencia de inserción
$query = "DELETE FROM pedidos_usuario WHERE id = $id_pedido";

// Ejecutar la consulta
if (mysqli_query($link, $query)) {
    echo '<script language="javascript">alert("El registro se elimino correctamente.");</script>';
    echo "<script>
            window.location = './pedido.php?u=".$id."';
         </script>";
} else {
    echo "Error al insertar el registro: " . mysqli_error($link);
}

// Cerrar la conexión
mysqli_close($link);
?>