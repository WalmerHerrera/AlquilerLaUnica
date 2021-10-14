<?php 
    require "../../MODELOS/Conexion.php";
require "plantilla.php";
$objeto = new conexion();
$conexion = $objeto->ConectarDB();
$consulta = "SELECT `cod`, `dni`, `nombre`, `direccion`, `telefono` FROM `cliente` WHERE 1";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);


//if (!empty($_POST)) {

    $pdf = new PDF("P", "mm", "letter");
    $pdf->AliasNbPages();
    $pdf->SetMargins(10, 10, 10);
    $pdf->AddPage();

    $pdf->SetFont("Arial", "B", 9);

    $pdf->Cell(20, 10, "cod", 1, 0, "C");
    $pdf->Cell(30, 10, "dni", 1, 0, "C");
    $pdf->Cell(60, 10, "nombre", 1, 0, "C");
    $pdf->Cell(50, 10, "direccion", 1, 0, "C");
    $pdf->Cell(30, 10, "telefono", 1, 1, "C");

    $pdf->SetFont("Arial", "", 9);

    foreach($data as $fila) {
        $pdf->Cell(20, 5, $fila['cod'], 1, 0, "C");
        $pdf->Cell(30, 5, utf8_decode($fila['dni']), 1, 0, "C");
        $pdf->Cell(60, 5, $fila['nombre'], 1, 0, "C");
        $pdf->Cell(50, 5, $fila['direccion'], 1, 0, "C");
        $pdf->Cell(30, 5, $fila['telefono'], 1, 1, "C");
    }

    $pdf->Output();
 ?>