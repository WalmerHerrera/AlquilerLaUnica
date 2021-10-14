<?php 
	require "../../MODELOS/Conexion.php";
require "plantilla.php";
$objeto = new conexion();
$conexion = $objeto->ConectarDB();
$consulta = "SELECT v.placa, m.nombre as modelo, ma.nombre as marca, tv.nombre as tipo, color ,tv.costoDiario,e.nombre as estado
            FROM `vehiculo` as v 
            inner join Modelo m on m.id=v.idModelo 
            inner join Marca ma on ma.id=m.idMarca 
            inner join tipoVehiculo tv on tv.id=v.idTipoVehiculo
            inner join estado e on e.id=v.estado";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);


//if (!empty($_POST)) {

    $pdf = new PDF("P", "mm", "letter");
    $pdf->AliasNbPages();
    $pdf->SetMargins(10, 10, 10);
    $pdf->AddPage();

    $pdf->SetFont("Arial", "B", 9);

    $pdf->Cell(20, 10, "placa", 1, 0, "C");
    $pdf->Cell(30, 10, "nombre", 1, 0, "C");
    $pdf->Cell(20, 10, "modelo", 1, 0, "C");
    $pdf->Cell(30, 10, "marca", 1, 0, "C");
    $pdf->Cell(30, 10, "tipo", 1, 0, "C");
    $pdf->Cell(10, 10, "color", 1, 0, "C");
    $pdf->Cell(20, 10, "costoDiario", 1, 0, "C");
    $pdf->Cell(30, 10, "estado", 1, 1, "C");

    $pdf->SetFont("Arial", "", 9);

    foreach($data as $fila) {
        $pdf->Cell(20, 5, $fila['placa'], 1, 0, "C");
        $pdf->Cell(30, 5, utf8_decode($fila['nombre']), 1, 0, "C");
        $pdf->Cell(20, 5, $fila['modelo'], 1, 0, "C");
        $pdf->Cell(30, 5, $fila['marca'], 1, 0, "C");
        $pdf->Cell(30, 5, $fila['tipo'], 1, 0, "C");
        $pdf->Cell(10, 5, $fila['color'], 1, 0, "C");
        $pdf->Cell(20, 5, $fila['costoDiario'], 1, 0, "C");
        $pdf->Cell(30, 5, $fila['estado'], 1, 1, "C");
    }

    $pdf->Output();
 ?>