<?php
include_once "../MODELOS/ModeloDataBase.php";
$objeto = new conexion();
$conexion = $objeto->ConectarDB();
// Recepción de los datos enviados mediante POST desde el JS   

$id = (isset($_POST['id'])) ? $_POST['id'] : '';
$ciudad = (isset($_POST['ciudad'])) ? $_POST['ciudad'] : '';
$direccion = (isset($_POST['direccion'])) ? $_POST['direccion'] : '';
$cuenta = (isset($_POST['cuenta'])) ? $_POST['cuenta'] : '';
$cci = (isset($_POST['cci'])) ? $_POST['cci'] : '';

$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
//echo '<script language="javascript">alert("juas");</script>';
switch($opcion){
    case 1: //alta
        $consulta = "call SP_InsertaAgencia ('$ciudad','$direccion','$cuenta','$cci') ";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 

        $consulta = "SELECT * FROM `agencia` ORDER BY id DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetch(PDO::FETCH_ASSOC);
        break;
    case 2: //modificación
        $consulta="call sp_actualizarAgencia ('$id','$ciudad','$direccion','$cuenta','$cci')";
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
