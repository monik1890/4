<?php
require_once "../../../conexion.php";

$id_usuario = $_POST['id_usuario'];
$departamento = $_POST['departamento'];
$municipio = $_POST['municipio'];
$cod_envio = $_POST['cod_envio'];
$total_pedido = $_POST['total_pedido'];
$direccion = $_POST['direccion'];

// Crear la sentencia de inserción
$query = "INSERT INTO pedidos_usuario (cod_envio, id_usuario, total_pedido, direccion, municipio_id, departamento_id) 
          VALUES ('$cod_envio', '$id_usuario', '$total_pedido', '$direccion', '$municipio', '$departamento')";

// Ejecutar la consulta
if (mysqli_query($link, $query)) {
    echo '<script language="javascript">alert("El registro se insertó correctamente.");</script>';
    echo "<script>
            window.location = './pedido.php?u=".$id_usuario."';
         </script>";
} else {
    echo "Error al insertar el registro: " . mysqli_error($link);
}

// Cerrar la conexión
mysqli_close($link);
?>