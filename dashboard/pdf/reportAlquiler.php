<?php 
require "../../MODELOS/Conexion.php";
require "plantilla.php";
$objeto = new conexion();
$conexion = $objeto->ConectarDB();
$consulta = "SELECT `id`, `idReserva`, `id_vehiculo`, `fechaSalida`, `fechaEntrada`, `observaciones` FROM `Alquiler` WHERE 1";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);


//if (!empty($_POST)) {

    $pdf = new PDF("P", "mm", "letter");
    $pdf->AliasNbPages();
    $pdf->SetMargins(10, 10, 10);
    $pdf->AddPage();

    $pdf->SetFont("Arial", "B", 9);

    $pdf->Cell(10, 10, "id", 1, 0, "C");
    $pdf->Cell(40, 10, "idReserva", 1, 0, "C");
    $pdf->Cell(20, 10, "id_vehiculo", 1, 0, "C");
    $pdf->Cell(40, 10, "fechaSalida", 1, 0, "C");
    $pdf->Cell(30, 10, "fechaEntrada", 1, 0, "C");
    $pdf->Cell(50, 10, "observaciones", 1, 1, "C");

    $pdf->SetFont("Arial", "", 9);

    foreach($data as $fila) {
        $pdf->Cell(10, 5, $fila['id'], 1, 0, "C");
        $pdf->Cell(40, 5, utf8_decode($fila['idReserva']), 1, 0, "C");
        $pdf->Cell(20, 5, $fila['id_vehiculo'], 1, 0, "C");
        $pdf->Cell(40, 5, $fila['fechaSalida'], 1, 0, "C");
        $pdf->Cell(30, 5, $fila['fechaEntrada'], 1, 0, "C");
        $pdf->Cell(50, 5, $fila['observaciones'], 1, 1, "C");
    }

    $pdf->Output();

 ?>