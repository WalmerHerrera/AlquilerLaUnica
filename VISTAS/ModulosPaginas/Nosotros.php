<h1>Nosotros</h1>
<?php  
$usuarios=ControladorDataBase::ctrSeleccionar("alumno");
?>
<h2>Contextual Classes</h2>
<p>Contextual classes can be used to color the table, table rows or table cells. The classes that can be used are: .table-primary, .table-success, .table-info, .table-warning, .table-danger, .table-active, .table-secondary, .table-light and .table-dark:</p>
<?php
$respuesta=new ContoladorEnlacesPaginas();
$respuesta->Respuesta();
?>

<table class="table table-bordered table-dark table-hover">
	<thead>
		<tr>
			<th>#</th>
			<th>nombre</th>
			<th>Codigo</th>
			<th>Contraseña</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($usuarios as $key => $value): ?>
			<tr>
				<th><?php echo ($key+1) ?></th>
				<th><?php echo $value["Nombre"] ?></th>
				<th><?php echo $value["codigo"] ?></th>
				<th><?php echo $value["Password"] ?></th>
				<th>
					<div class="btn-group">
						<div class="px-1">
							<a href="index.php?action=Editar&id=<?php echo $value["idAlumno"] ?>" type="button" class="btn btn-warning"><i class="fas fa-user-edit"></i></a>
						</div>						
						<form method="post">
							<input type="hidden" name="idEliminar" value="<?php echo $value["idAlumno"] ?>">							
							<button  type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
							
							<?php 
							$Eliminar=new ControladorDataBase();
							$Eliminar->ctrDeleteRegistro();					
							?>
						</form>
					</div>						
				</th>
			</tr>
		<?php endforeach ?>

	</tbody>
</table>
<?php 
include_once "Editar.php";
?>