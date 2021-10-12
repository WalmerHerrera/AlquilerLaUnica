<?php 
require_once "../MODELOS/ModeloEnlacesPagina.php";
class ContoladorEnlacesPaginas{
	/*para ver la paltilla principal*/
	static public  function ControladorEnlaces(){
		if(isset($_GET["action"])){
			$enlaces=$_GET["action"];
		}else{
			$enlaces="principal";
		}			
		$respuesta=new EnlacesPaginas();
		$cadena=$respuesta->enlacesPaginasModelo($enlaces);
		require_once $cadena;
	}
	public function ControladorRegistro(){

	}
	public function Respuesta(){
		if(isset($_GET["respuesta"])){
			if($_GET["respuesta"]=="ok"){
				echo '
				<div class="alert alert-success">
				<strong>ok</strong> el usuario a sido actualizado.
				</div>';
			}

		}
	}
	
}


?>