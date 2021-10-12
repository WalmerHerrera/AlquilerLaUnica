<?php
include_once "../MODELOS/ModeloDataBase.php";
$objeto = new conexion();
$conexion = $objeto->ConectarDB();
// Recepción de los datos enviados mediante POST desde el JS   

$id = (isset($_POST['id'])) ? $_POST['id'] : '';
$idReserva = (isset($_POST['idReserva'])) ? $_POST['idReserva'] : '';
$id_vehiculo = (isset($_POST['id_vehiculo'])) ? $_POST['id_vehiculo'] : '';
$fechaSalida = (isset($_POST['fechaSalida'])) ? $_POST['fechaSalida'] : '';
$fechaEntrada = (isset($_POST['fechaEntrada'])) ? $_POST['fechaEntrada'] : '';
$observaciones = (isset($_POST['observaciones'])) ? $_POST['observaciones'] : '';

$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
//echo '<script language="javascript">alert("juas");</script>';
switch($opcion){
    case 1: //alta
        $consulta = "call sp_Insertar_alquiler ($idReserva,'$id_vehiculo','$fechaSalida','$fechaEntrada','$observaciones') ";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 

        $consulta = "SELECT * FROM `alquiler` ORDER BY id DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetch(PDO::FETCH_ASSOC);
        break;
    case 2: //modificación
        $consulta="call sp_actualizarAgencia ($id,'$ciudad','$direccion','$cuenta','$cci')";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        $consulta = "SELECT * FROM `agencia` WHERE id='$id' ";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;        
    case 3://baja
        $consulta = "call sp_eliminarAgencia('$id') ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                           
        break;        
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
