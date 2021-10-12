<?php
include_once "../MODELOS/ModeloDataBase.php";
$objeto = new conexion();
$conexion = $objeto->ConectarDB();
// Recepción de los datos enviados mediante POST desde el JS   

$id = (isset($_POST['id'])) ? $_POST['id'] : '';
$nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';
$Apellidos = (isset($_POST['Apellidos'])) ? $_POST['Apellidos'] : '';
$correo = (isset($_POST['correo'])) ? $_POST['correo'] : '';
$telefono= (isset($_POST['telefono'])) ? $_POST['telefono'] : '';
$usuario= (isset($_POST['usuario'])) ? $_POST['usuario'] : '';
$contraseña= (isset($_POST['contraseña'])) ? $_POST['contraseña'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';

switch($opcion){
    case 1: //alta
        $consulta = "call SP_insertaUsuario ('$nombre','$Apellidos','$correo','$telefono','$usuario','$contraseña') ";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 

        $consulta = "SELECT * FROM `USUARIO` ORDER BY id DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetch(PDO::FETCH_ASSOC);
        break;
    case 2: //modificación
        $consulta = "call SP_ActualizarUsuario ('$id','$nombre','$Apellidos','$correo','$telefono','$usuario','$contraseña')";	
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        $consulta = "SELECT * FROM `USUARIO` WHERE id='$id' ";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;        
    case 3://baja
        $consulta = "call SP_EliminaUsuario ('$id') ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                           
        break;        
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
