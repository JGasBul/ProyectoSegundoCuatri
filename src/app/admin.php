<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] != 1) {
    header("location: login.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina de demostracion de admin</title>
    <link href="./css/admin.css" rel="stylesheet" type="text/css">
</head>

<body>
    <div id="contenedor">
        <!-- Barra top: Logo y boton menu -->
        <div id="cabecera_contenedor">
            <div id="area_logo">
                <a href="../index.html">
                    <img src="../assets/logo.svg" alt="imagen de logo" id="imagen_logo_GTI">
                </a>
            </div>
            <div class="dropdown">
                <a class="dropbtn" href="./logout.php"><img src="../assets/cerrar_sesion.png" alt="Boton de cerrar sesion"></a>
            </div>
        </div>

        <!-- Fin de Barra top -->
        <h1 class="titulo-admin">Bienvenido, admin</h1>

        <!-- Aqui empieza la area de busqueda y añadir usuario -->
        <div id="area_busqueda">
            <form action="buscar_usuario.php" method="get" id="busca_usuario">
                <input type="text" name="busqueda" id="barra_busqueda" placeholder="Busca un usuario">
                <button id="boton_buscar">
                    <img src="../assets/icono_busqueda.svg" alt="icono de busqueda" id="icono_busqueda">
                </button>
            </form>

            <a id="boton_borrar" href="registro.php">
                <img src="../assets/anyadir.svg" alt="Icono de añadir usuario">
            </a>
        </div>

        <!-- Aqui empieza los datos de los usuarios -->
        <section id="contenedor_datos">

            <?php
            $curl = curl_init();

            curl_setopt($curl, CURLOPT_URL, "http://localhost/src/api/user.php/list");
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

            $result = curl_exec($curl);
            $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);

            $result = json_decode($result);

            if ($result > 0) {
                foreach ($result as $user) {
            ?>
                    <!-- Primera persona -->
                    <div class="area_usuario">
                        <div class="area_iz">

                            <div class="area_datos">
                                <p class="nombre"><?php echo $user->nombre; ?></p>
                                <p class="tipo"><?php
                                                if ($user->rol == "admin") {
                                                    echo "Administrador";
                                                } else {
                                                    echo "Usuario";
                                                }
                                                ?></p>
                            </div>
                        </div>
                        <div class="area_der">
                            <div class="area_borrar">
                                <button class="boton_borrar" onclick="delete_user('<?php echo $user->nombre ?>', '<?php echo $user->email ?>')"><img src="../assets/icono_borrar.svg" alt="icono de borrar" class="borrar"></button>
                            </div>
                            <div class="Dropdown">
                                <button class="boton_mas_informacion"><img src="../assets/desplegable.svg" alt="Icono mas informacion"></button>
                                <div class="informacion-content">
                                    <!-- primera fila -->
                                    <div class="primera_fila">
                                        <div class="dato_iz">
                                            <div class="negrita">
                                                <h3>Empresa:</h3>
                                            </div>
                                            <div class="normal">
                                                <p> &nbsp; <?php echo $user->empresa; ?></p>
                                            </div>
                                        </div>

                                        <div class="dato_der">
                                            <div class="negrita">
                                                <h3>Antigüedad:</h3>
                                            </div>
                                            <div class="normal">
                                                <p> &nbsp;<?php
                                                            // Cambio formato a la inicial
                                                            $timestamp_bbdd = strtotime($user->fecha_creacion);
                                                            $timestamp_inicial = date('Y-m-d H:i:s', $timestamp_bbdd);

                                                            $timestamp_ahora = new DateTime();
                                                            $timestamp_final = date('Y-m-d H:i:s', $timestamp_ahora->getTimestamp());

                                                            $tiempo_segundos = strtotime($timestamp_final) - strtotime($timestamp_inicial);

                                                            $dias_diferencia = $tiempo_segundos / (60 * 60 * 24);
                                                            $dias_diferencia = abs($dias_diferencia);
                                                            $dias_diferencia = floor($dias_diferencia);

                                                            if ($dias_diferencia < 30) {
                                                                if ($dias_diferencia == 1) {
                                                                    echo $dias_diferencia . " dia";
                                                                } else {
                                                                    echo $dias_diferencia . " dias";
                                                                }
                                                            } elseif ($dias_diferencia >= 30 && $dias_diferencia < 365) {
                                                                $meses_diferencia = $dias_diferencia / 30;
                                                                if ($meses_diferencia == 1) {
                                                                    echo $meses_diferencia . " mes";
                                                                } else {
                                                                    echo $meses_diferencia . " meses";
                                                                }
                                                            } else {
                                                                $años_diferencia = $dias_diferencia / 365;
                                                                $años_diferencia = abs($años_diferencia);
                                                                $años_diferencia = floor($años_diferencia);
                                                                if ($años_diferencia == 1) {
                                                                    echo $años_diferencia . ' año';
                                                                } else {
                                                                    echo $años_diferencia . ' años';
                                                                }
                                                            }
                                                            ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- segunda fila -->
                                    <div class="segunda_fila">
                                        <div class="dato_iz">
                                            <div class="negrita">
                                                <h3>Email:</h3>
                                            </div>
                                            <div class="normal">
                                                <p> &nbsp;<?php echo $user->email; ?></p>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>

            <?php

                }
            }
            ?>
            <!-- Icono de subir arriba -->
            <div id="area_final">
                <button id="arriba">
                    <a href="#"><img src="../assets/Icono arriba.svg" alt="Icono subir arriba"></a>
                </button>
            </div>
        </section>
        <script>
            async function delete_user(name, email) {
                let text = "Esta seguro que desea eliminar a " + name + " con email " + email;
                if (confirm(text) == true) {
                    let consulta = await fetch("http://localhost/src/api/user.php/delete?email=" + email);
                    deleteComplete = await consulta.json();
                    if (deleteComplete) {
                        location.reload();
                        alert("Eliminado con exito");
                    } else {
                        alert("No se ha podido realizar la accion solicitada. Porfavor, si sigue ocurriendo este error contacte con los tecnicos. Lamentamos las molestias");
                        location.reload();
                    }
                }
            }
        </script>
    </div>
</body>

</html>