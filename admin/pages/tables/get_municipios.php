<?php
require_once "../../../conexion.php";
// Verifica si se ha recibido el ID del departamento
if (isset($_POST['departamentoId'])) {
    // Obtiene el ID del departamento seleccionado
    $departamentoId = $_POST['departamentoId'];

    // Realiza la consulta para obtener los municipios del departamento seleccionado
    $query = "SELECT * FROM municipios WHERE departamento_id = $departamentoId";
    $result = mysqli_query($link, $query);

    // Genera las opciones para los municipios
    $options = '<option value="">Selecciona un municipio</option>';
    while ($row = mysqli_fetch_assoc($result)) {
        $options .= '<option value="'.$row['id_municipio'].'">'.$row['municipio'].'</option>';
    }

    // Cierra la conexión a la base de datos
    mysqli_close($link);

    // Devuelve las opciones de municipios al archivo JavaScript
    echo $options;
}
?>
