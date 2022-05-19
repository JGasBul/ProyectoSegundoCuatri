<!DOCTYPE html>
<html lang="es" style="min-height: 100%">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuario Nuevo</title>
    <link rel="stylesheet" href="css/registro.css" type="text/css">
</head>

<body>
    <!--Inicio Cabecera-->
    <header class="header-area">
        <div class="logo">
            <a href="../index.html"><img src="../assets/logo.svg" alt="logo_empresa" width="150" /></a>
        </div>
    </header>
    <!--Fin Cabecera-->
    <!--Inicio Contenido-->
    <div class="contenido">
        <!--Titulo Contactanos-->
        <div class="titulo">
            <a href="./admin.php"><img src="../assets/atras.svg" alt="flecha_volver"></a>
            <h1>Usuario Nuevo</h1>
        </div>
        <!--Inicio Formulario-->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <!--Nombre-->
            <div>
                <img src="../assets/importante.svg" alt="importante">
                <label for="nombre">Nombre</label>
            </div>
            <input id="nombre" name="nombre" placeholder="Introduzca el nombre de usuario" type="text" required>
            <!--Apellidos-->
            <div>
                <img src="../assets/importante.svg" alt="importante">
                <label for="apellidos">Apellidos</label>
            </div>
            <input id="apellidos" name="apellidos" placeholder="Introduzca el apellido" type="text" required>
            <!--E-mail-->
            <div>
                <img src="../assets/importante.svg" alt="importante">
                <label for="email">E-mail</label>
            </div>
            <input id="email" name="email" placeholder="Introduzca el e-mail del usuario" type="email" required>
            <!--Empresa-->
            <div>
                <img src="../assets/importante.svg" alt="importante">
                <label for="empresa">Empresa</label>
            </div>
            <input id="empresa" name="empresa" placeholder="Introduzca la empresa del usuario" type="texts" required>
            <!--Contraseña-->
            <div>
                <img src="../assets/importante.svg" alt="importante">
                <label for="pass">Contraseña</label>
            </div>
            <input id="pass" name="pass" placeholder="Introduzca la contraseña deseada" type="password" required>
            <!--Rol-->
            <div>
                <img src="../assets/importante.svg" alt="importante">
                <label for="selector-rol">Rol en la web</label>
            </div>
            <select name="selector-rol" id="selector-rol">
                <option>Seleccione una opción</option>
                <option>Administrador</option>
                <option>Usuario</option>
            </select>
            <label id="aviso-asunto">Elija una opción</label>
            <!--Botón Enviar-->
            <input type="submit" value="ENVIAR">

        </form>
        <!--Fin Formulario-->
    </div>
    <!--Fin Contenido-->

</body>

</html>
<?php
$username = $password = $email = $rol = "";
$login_err = $rol_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["nombre"]) . ' ' . trim($_POST["apellidos"]);
    $email = trim($_POST["email"]);
    $empresa = trim($_POST["empresa"]);
    $password = trim($_POST["pass"]);
    $rol = trim($_POST['selector-rol']);

    switch ($rol) {
        case 'Administrador':
            $rol = "admin";
            break;
        case 'Usuario':
            $rol = "normal";
            break;
        default:
            $rol_err = "No se ha seleccionado opcion";
            break;
    }

    if (!$rol_err) {
        echo "<script> document.getElementById('aviso-asunto').style.visibility = 'hidden'; </script>";

        $data = array("email" => $email, "pass" => $password, "nombre" => $username, "empresa" => $empresa, "rol" => $rol);
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_URL, "http://localhost/src/api/user.php/insert");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $result = curl_exec($curl);
        var_dump($result);
        $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        if ($http_code == 200) {
            echo "<script>alert(\"Usuario insertado con exito\")</script>";
        } else {
            $result = json_decode($result);
            if ($result->error == "There is already a user with this email.") {
                echo "<script>alert(\"Ya existe un usuario con este correo. Intentelo de nuevo con un correo diferente.\")</script>";
            } else {
                echo "<script>alert(\"Ha habido un problema al intentar insertar el usuario. Contacte un tecnico y se lo resolveremos lo antes posible. Disculpe las molestias\")</script>";
            }
        }
    } else {
        echo "<script> document.getElementById('aviso-asunto').style.visibility = 'visible'; </script>";
    }
}
?>