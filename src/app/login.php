<?php
// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == 1) {
    if ($_SESSION["rol"] == "normal") {
        header("location: parcelas.html?usuario=" . $_SESSION["id"]);
        exit;
    } else {
        header("location: admin.php");
        exit;
    }
}

?>
<!DOCTYPE html>
<html lang="es" style="min-height: 100%">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/login.css" type="text/css">
</head>

<body>
    <!-- Header -->
    <div id="scroll_arriba"></div>
    <header class="header-area">
        <div class="logo">
            <a href="../index.html"><img src="../assets/logo.svg" alt="logo_empresa" width="150" /></a>
        </div>
        <!--
        <nav>
            <div class="dropdown">
                <button class="dropbtn"><img src="../assets/menu.svg" alt="Boton de menu"></button>
                <div class="dropdown-content">
                    <a href="#">Sobre Nosotros</a>
                    <a href="#">Catálogo</a>
                    <a href="#">Servicios</a>
                </div>
            </div>
        </nav>
-->
    </header>
    <!-- Fin header -->
    <!--Inicio Mobile First-->
    <div class="mobile-first">
        <h1 class="titulo-login">Usuario</h1>
        <!--Imagen de Cuenta-->
        <img src="../assets/account.svg" alt="icono de Cuenta02" class="account">
        <!--Creamos un contenedor que contendrá el formulario de login y el cuadro de error-->
        <!--Inicio Contenedor-Login-->
        <div class="contenedor-login">
            <!--Inicio del formulario-->
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <!--Inicio Email-->
                <div class="contenido-email">
                    <img src="../assets/icon01.svg" alt="icono de Email" class="email-icon">
                    <div class="contenido-email-interior">
                        <label for="email-mobile">Email:</label>
                        <input id="email-mobile" name="email" placeholder="Ponga su email" type="email" required>
                    </div>
                </div>
                <!--Fin Email-->
                <!--Inicio Contraseña-->
                <div class="contenido-contraseña">
                    <img src="../assets/icon02.svg" alt="icono de candado" class="lock-icon">
                    <div class="contenido-contraseña-interior">
                        <label for="contraseña-mobile">Contraseña:</label>
                        <input id="contraseña-mobile" name="password" placeholder="Ponga su contraseña" type="password" required>
                    </div>
                    <!--Inicio MostrarOcultar Contraseña-->
                    <section class="Mostrar-Ocultar-Contraseña" onclick="MostrarOcultarPassword(this)">
                        <div class="ojo">
                            <img class="ojo-cerrado" src="../assets/ojo_abierto_desactivado.svg" alt="icono ocultar contraseña">
                        </div>
                    </section>
                    <!--Fin MostrarOcultar Contraseña-->
                </div>
                <!--Fin Contraseña-->
                <input type="submit" value="Login">
            </form>
            <!--Fin del formulario-->
            <!--Inicio Contenedor-Error-->
            <!--Si los datos dan error, se mostrará dentro del contenedor que los datos son incorrectos-->
            <div id="error-mobile">
                Datos incorrectos
            </div>
            <!--Fin Contenedor-Error-->
        </div>
        <!--Fin Contenedor-Login-->
    </div>
    <!--Fin Mobile First-->
    <!--<script src="js/login.js">-->
    </script>
</body>
<script>
    function MostrarOcultarPassword(params) {
        var tipo = document.getElementById("contraseña-mobile");
        if (tipo.type == "password") {
            tipo.type = "text";
        } else {
            tipo.type = "password";
        }
    }
</script>

</html>

<?php
$username = $password = "";
$username_err = $password_err = $login_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if username is empty
    if (empty(trim($_POST["email"]))) {
        $username_err = "Please enter username.";
    } else {
        $username = trim($_POST["email"]);
    }

    // Check if password is empty
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter your password.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate credentials
    if (empty($username_err) && empty($password_err)) {
        $data = array("email" => $username, "password" => $password);
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_URL, "http://localhost/src/api/user.php/login");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $result = curl_exec($curl);
        $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        if ($http_code != 200) {
            //var_dump($http_code);
            echo "<script> document.getElementById('error-mobile').style.visibility = 'visible'; </script>";
        } else {
            $result = json_decode($result);

            session_start();
            foreach ($result as $key => $value) {
                $_SESSION["{$key}"] = $value;
            }
            if ($_SESSION["rol"] == "normal") {
                header("location: parcelas.html?usuario=" . $_SESSION["id"]);
            } else {
                header("location: admin.php");
            }
        }
    }
}
?>