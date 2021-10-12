
	<?php 
	include_once 'MODELOS/Usuario.php';
	include_once 'MODELOS/UsuarioSecion.php';
	include_once "MODELOS/ModeloDataBase.php";
	//include_once "CONTROLADORES/ControladorDataBase.php";
	$usuario = new usuario();
	$usuarioSesion=new UsuarioSession();
	if(isset($_SESSION['Usuario'])){
		//$usuario->SetUsuario($usuarioSecion->getUsuarioActual());	
		header("Location: dashboard/index.php");
	}else if(isset($_POST['usuario']) && isset($_POST['password'])){
		$usuarioForm = $_POST['usuario'];
		$ContraseñaForm = $_POST['password'];
		$respuesta=$usuario->ExisteUsuario($usuarioForm,$ContraseñaForm);
		if($respuesta!=null){
			if($respuesta["usuario"]==$usuarioForm && $respuesta["contraseña"]==$ContraseñaForm){
				$usuarioSesion->setUsuarioActual($respuesta["usuario"]);
				header("Location: dashboard/index.php");
			}else{
				$errorLogin ='<div class="alert alert-warning">
				<strong>Error!</strong> Nombre de usuario y/o password es incorrecto.
				</div>' ;
				include_once 'login.php';
			}
		}else{
			include_once 'login.php';
		}
		

	}else{
		require_once 'login.php';
	}

	?>
	

