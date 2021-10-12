<?php 
require_once "vistas/parte_superior.php";
include_once "../CONTROLADORES/ControladorPaginas.php";
include_once "../CONTROLADORES/ControladorDataBase.php";
include_once "../MODELOS/ModeloEnlacesPagina.php";
include_once "../MODELOS/ModeloDataBase.php";

$controlador= new ContoladorEnlacesPaginas();
$controlador->ControladorEnlaces();

require_once "vistas/parte_inferior.php";
?>

