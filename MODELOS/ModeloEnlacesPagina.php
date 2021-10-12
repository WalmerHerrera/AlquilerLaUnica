<?php 
class EnlacesPaginas{

	public function enlacesPaginasModelo($enlaces){
		if($enlaces=="vehiculo"||$enlaces=="cliente"||
			$enlaces=="principal"||$enlaces=="usuario"
			||$enlaces=="tipoVehiculo"||$enlaces=="marca"
			||$enlaces=="modelo"||$enlaces=="agencia"||$enlaces=="reserva"
			 ||$enlaces=="alquiler"||$enlaces=="devolucion"||$enlaces=="Pago"){
			$modelo="../VISTAS/".$enlaces.".php";
		}
		else{
			$modelo="../VISTAS/principal.php";
		}
		return $modelo;
	}
}




 ?>