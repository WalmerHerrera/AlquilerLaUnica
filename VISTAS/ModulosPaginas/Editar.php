<?php 
if(isset($_GET["id"])){
	$tabla="alumno";
	$item="idAlumno";
	$valor=$_GET["id"];
	$usuarioEdit=ControladorDataBase::ctrBuscarRegistro($tabla,$item,$valor);
}else{
	return;
}	

?>
<h2>Registro</h2>
<form action="" class="p-5 bg-light" method="POST">
	<div class="form-group">	
		<label for="codigo">Nombre:</label>
		<div class="input-group-prepend">
			<span class="input-group-text"><i class="fas fa-user"></i></span>
			<input type="text" class="form-control" id="uname" placeholder="Nombre" name="actualizarNombre" value="<?php echo $usuarioEdit["Nombre"];?>" required>

		</div>
	</div>
	<div class="form-group">	
		<label for="codigo">Codigo de alumno:</label>
		<div class="input-group-prepend">
			<span class="input-group-text"><i class="fas fa-barcode"></i></span>
			<input type="text" class="form-control" id="uname" placeholder="Código" name="actualizarCodigo" value="<?php echo $usuarioEdit["codigo"];?>" required>
		</div>
	</div>
	<div class="form-group">
		<label for="pwd">Contraseña:</label>
		<div class="input-group">
			<div class="input-group-prepend">
				<span class="input-group-text"><i class="fas fa-unlock"></i></span>      		
			</div>
			<input type="password" class="form-control" id="pwd" placeholder="contraseña" name="actualizarContraseña" value="<?php echo $usuarioEdit["Password"];?>"  required>
			<input type="hidden" name="passwordActual" value="<?php echo $usuarioEdit["Password"];?>">
			<input type="hidden" name="id" value="<?php echo $usuarioEdit["idAlumno"];?>">
		</div>
	</div>
	<div class="boton">
		<button type="submit" class="btn btn-primary">actualizar</button>
	</div>
	<?php 
	$actualizar=ControladorDataBase::ctrActualizarRegistro();
	if(isset($actualizar)){
		if($actualizar=="ok"){
			header("location: index.php?action=Nosotros&respuesta=ok");
		}else{
			echo '<div class="alert alert-warning">
			<strong>Error!</strong> '.$respuesta.'.
			</div>';
		}					
	}
	?>
</form>

