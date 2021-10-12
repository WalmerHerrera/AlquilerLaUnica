<?php

class UsuarioSession{

    public function __construct(){
        session_start();
    }

    public function setUsuarioActual($usuario){
        $_SESSION['Usuario'] = $usuario;
    }

    public function getUsuarioActual(){
        return $_SESSION['Usuario'];
    }

    public function SerrarSecion(){
        session_unset();
        session_destroy();
    }
}


?>