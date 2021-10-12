<?php
include_once "../MODELOS/ModeloDataBase.php";
$objeto = new conexion();
$conexion = $objeto->ConectarDB();
// Recepción de los datos enviados mediante POST desde el JS   

$id = (isset($_POST['id'])) ? $_POST['id'] : '';
$idAlquiler = (isset($_POST['idAlquiler'])) ? $_POST['idAlquiler'] : '';
$horaD = (isset($_POST['horaD'])) ? $_POST['horaD'] : '';
$daños = (isset($_POST['daños'])) ? $_POST['daños'] : '';
$faltantes = (isset($_POST['faltantes'])) ? $_POST['faltantes'] : '';
$cosDaño = (isset($_POST['cosDaño'])) ? $_POST['cosDaño'] : 0;
$cosFaltante= (isset($_POST['cosFaltante'])) ? $_POST['cosFaltante'] : 0;

$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';

switch($opcion){
    case 1: //alta
        $consulta = "call SP_insertaDevolucion ($idAlquiler,'$horaD','$daños','$faltantes',$cosDaño,$cosFaltante)";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 

        $consulta = "SELECT * FROM `devolucion` ORDER BY id DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetch(PDO::FETCH_ASSOC);
        break;
    case 2: //modificación
        $consulta = "call sp_actualizarDevolucion ($id,$idAlquiler,'$horaD','$daños','$faltantes',$cosDaño,$cosFaltante);";	
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        $consulta = "SELECT * FROM `devolucion`WHERE id=$id ";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;        
    case 3://baja
        $consulta = "call sp_eliminarDevolucion ($id); ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                           
        break;       
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
