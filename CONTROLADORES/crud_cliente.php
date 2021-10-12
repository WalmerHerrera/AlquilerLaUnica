<?php
include_once "../MODELOS/ModeloDataBase.php";
$objeto = new conexion();
$conexion = $objeto->ConectarDB();
// Recepción de los datos enviados mediante POST desde el JS   

$cod = (isset($_POST['cod'])) ? $_POST['cod'] : '';
$dni = (isset($_POST['dni'])) ? $_POST['dni'] : '';
$nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';
$direccion = (isset($_POST['direccion'])) ? $_POST['direccion'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$telefono= (isset($_POST['telefono'])) ? $_POST['telefono'] : '';

switch($opcion){
    case 1: //alta
        $consulta = "call sp_InsertaCliente ('$dni','$nombre','$direccion','$telefono');";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 

        $consulta = "SELECT * FROM `cliente` ORDER BY cod DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetch(PDO::FETCH_ASSOC);
        break;
    case 2: //modificación
        $consulta = "call sp_actualizarCliente ('$cod','$dni','$nombre','$direccion','$telefono')";	
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        $consulta = "SELECT * FROM `cliente` WHERE cod='$cod' ";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;        
    case 3://baja
        $consulta = "call sp_eliminarCliente ('$cod') ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                           
        break;        
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
