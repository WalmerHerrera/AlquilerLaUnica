<?php
include_once "../MODELOS/ModeloDataBase.php";
$objeto = new conexion();
$conexion = $objeto->ConectarDB();
// Recepción de los datos enviados mediante POST desde el JS   

$id = (isset($_POST['id'])) ? $_POST['id'] : '';
$codCliente = (isset($_POST['codCliente'])) ? $_POST['codCliente'] : '';
$idUsuario = (isset($_POST['idUsuario'])) ? $_POST['idUsuario'] : '';
$opcion= (isset($_POST['opcion'])) ? $_POST['opcion'] : '';

switch($opcion){
    case 1: //alta
        $consulta = "call sp_InsertaReserva ('$codCliente','$idUsuario') ";	
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 

        $consulta = "SELECT * FROM `reserva` ORDER BY id DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetch(PDO::FETCH_ASSOC);
        break;
    case 2: //modificación
        $consulta = "call SP_ActualizarReserva ('$id','$codCliente','$idUsuario') ";	
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        $consulta = "Select r.id, c.nombre as cliente, u.nombre as usuario,r.costoTotal 
        from reserva r 
        inner join cliente c on c.cod=r.codCliente 
        inner join USUARIO u on u.id=r.idUsuario 
        WHERE id='$id' ";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;        
    case 3://baja
        $consulta = "call SP_EliminaReserva ('$id') ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                           
        break;        
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
