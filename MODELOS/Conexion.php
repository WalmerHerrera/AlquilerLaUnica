<?php 
class conexion{
     public static function ConectarDB(){
         define('servidor','bpkw1uxdixr9ikhv7zfs-mysql.services.clever-cloud.com');
         define('nombre_bd','bpkw1uxdixr9ikhv7zfs');
         define('usuario','urs07tvoxrwtghnx');
         define('password','gleRsVt88VL2sTk66bs1');         
         $opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
         try{
            $conexion = new PDO("mysql:host=".servidor.";dbname=".nombre_bd, usuario, password, $opciones);             
            return $conexion; 
         }catch (Exception $e){
             die("El error de Conexión es :".$e->getMessage());
         }         
     }
     
 }

?>