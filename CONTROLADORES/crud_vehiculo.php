<?php
include_once "../MODELOS/ModeloDataBase.php";
$objeto = new conexion();
$conexion = $objeto->ConectarDB();
// Recepción de los datos enviados mediante POST desde el JS   


$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$idModelo = (isset($_POST['idModelo'])) ? $_POST['idModelo'] : '';
$idTipoVehiculo = (isset($_POST['idTipoVehiculo'])) ? $_POST['idTipoVehiculo'] : '';
$color = (isset($_POST['color'])) ? $_POST['color'] : '';
$estado = (isset($_POST['estado'])) ? $_POST['estado'] : '';
$placa = (isset($_POST['placa'])) ? $_POST['placa'] : '';
switch($opcion){
    case 1: //alta
        $consulta = "call sp_Insertavehiculo ('$placa','$idModelo','$idTipoVehiculo','$color','$estado') ";	
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 

        $consulta = "SELECT * FROM `vehiculo` ORDER BY $placa DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetch(PDO::FETCH_ASSOC);
        break;
    case 2: //modificación
        $consulta = "call SP_ActualizarVehiculo ('$placa','$idModelo','$idTipoVehiculo','$color','$estado','')";	
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        $consulta = "SELECT * FROM `vehiculo` WHERE $placa='$placa' ";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;        
    case 3://baja
        $consulta = "call SP_EliminaVehiculo ('$placa') ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                           
        break; 
    case 4://consulta
        $consulta = "SELECT `id`, `nombre` FROM `Modelo` WHERE  `idMarca`=$idmarca";      
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        $html="<option value='0'>Seleccionar Modelo</option>";
        foreach ($data as $dat) {
            $html.="<option value='".$dat['id']."'>".$dat['nombre']."</option>";
        } 
        echo $html;                          
        break;        
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
