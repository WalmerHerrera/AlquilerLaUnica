 <?php 
include_once"Conexion.php";
class Usuario {
    
    static public function ExisteUsuario($usuario,$password){
        $objeto = new conexion();
        $conexion = $objeto->conectarDB();
        $consulta = "SELECT * FROM USUARIO WHERE usuario='$usuario' AND contraseña='$password' ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        if($resultado->rowCount() >= 1){
            return $data = $resultado->fetch(PDO::FETCH_ASSOC);
        }
        return null;
     
    }
}


  ?>