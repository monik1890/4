<?php
require_once "../../../conexion.php";

$id_usuario = $_POST['id_usuario'];
$id_pedido = $_POST['id_pedido'];
$departamento = $_POST['departamento'];
$municipio = $_POST['municipio'];
$cod_envio = $_POST['cod_envio'];
$total_pedido = $_POST['total_pedido'];
$direccion = $_POST['direccion'];

// Crear la sentencia de inserción
$query = "UPDATE pedidos_usuario SET cod_envio='$cod_envio',total_pedido='$total_pedido',direccion='$direccion',municipio_id='$municipio',departamento_id='$departamento' WHERE id = '$id_pedido'";

// Ejecutar la consulta
if (mysqli_query($link, $query)) {
    echo '<script language="javascript">alert("El registro se edito correctamente.");</script>';
    echo "<script>
            window.location = './pedido.php?u=".$id_usuario."';
         </script>";
} else {
    echo "Error al insertar el registro: " . mysqli_error($link);
}

// Cerrar la conexión
mysqli_close($link);
?>