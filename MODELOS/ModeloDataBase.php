<?php 
include_once"Conexion.php";
class ModeloBD {
	static public function SeleccionarTodoRegistro($tabla){
		$objeto = new conexion();
        $conexion = $objeto->ConectarDB();
        $consulta = "SELECT * FROM $tabla where 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $conexion=null;
        if($resultado->rowCount() >= 1){
            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }
        return null; 
	}
	static public function Seleccionarvehiculo(){
		$objeto = new conexion();
        $conexion = $objeto->ConectarDB();
        $consulta = "SELECT v.placa, m.nombre as modelo, ma.nombre as marca, tv.nombre as tipo, color FROM `vehiculo` as v inner join Modelo m on m.id=v.idModelo inner join Marca ma on ma.id=m.idMarca inner join tipoVehiculo tv on tv.id=v.idTipoVehiculo";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $conexion=null;
        if($resultado->rowCount() >= 1){
            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }
        return null;
	}
}



?>