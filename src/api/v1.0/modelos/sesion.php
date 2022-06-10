<?php

if (!isset($peticion)) die();

if ($peticion->metodo() === 'POST') {

    $sql = "SELECT * 
            FROM usuarios 
            WHERE usuario = '" . $peticion->parametrosPost()['usuario']
            . "' AND password = '" . $peticion->parametrosPost()['contraseña'] . "'" ;

    require "../includes/conexion.php";
    if (!isset($conn)) die();
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        session_start();
        $row = mysqli_fetch_assoc($result);
        $_SESSION['id'] = $row['id'];
        $_SESSION['usuario'] = $row['usuario'];
        $_SESSION['rol'] = $row['rol'];

    } else {
        http_response_code(401);
        die();
    }
}

if($peticion->metodo() === 'GET') {
    //PAra iniciar la sesión, usamos este metodo start
    session_start();
    if(isset($_SESSION['id']) && !empty($_SESSION['id'])) {
        /*if(count($peticion->parametrosPath()) > 0) {
            if($_SESSION['rol'] !== $peticion->parametrosPath()[0]) {
                http_response_code(401);
                die();
            }
        }*/
    } else {
        http_response_code(401);
        die();
    }
}

if($peticion->metodo() === 'DELETE') {
    session_start();
    //No es obligatorio, pero es recomendable...
    $_SESSION['id'] = '';
    //
    //Luego, destruyo la sesion
    session_destroy();
    //Advertencia, no se elimina la Cookie. Eso se hace manualmente.
    //Lo importante es que en el servidor se ha borrado la sesion
}