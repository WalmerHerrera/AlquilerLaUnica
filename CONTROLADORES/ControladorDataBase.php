<?php
class ControladorDataBase{
	static public function ctrRegistro(){
		if(isset($_POST["nombreRegistro"])){
			include_once "../MODELOS/ModeloDataBase.php";
			$tabla="alumno";
			$ItemsTabla=array("nombre"=>$_POST["nombreRegistro"],"codigo"=>$_POST["codigoRegistro"],"password"=>$_POST["contraseñaRegistro"]);
			$respuesta=ModeloBD::InsertarRegistro($tabla,$ItemsTabla);
			return $respuesta;
		}
	}
	static public function ctrSeleccionar($tabla){
		$respuesta=new ModeloBD();
		return $respuesta->SeleccionarTodoRegistro($tabla);
	}
	static public function ctrSeleccionarVehiculo(){
		$respuesta=new ModeloBD();
		return $respuesta->Seleccionarvehiculo();
	}
	

}


?>