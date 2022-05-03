<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LandingPage</title>
    <link href="./css/landingpage.css" rel="stylesheet" type="text/css">
</head>

<body>
    <header class="header-area">
        <div class="logo">
            <a href="#"><img src="./assets/logo.svg" alt="logo_empresa" width="150" /></a>
        </div>
        <nav>
            <a href="./app/login.php" class="login">Login</a>
            <div class="dropdown">
                <button class="dropbtn"><img src="./assets/menu.svg" alt="Boton de menu"></button>
                <div class="dropdown-content">
                    <a href="#">Sobre Nosotros</a>
                    <a href="#">Catálogo</a>
                    <a href="#">Servicios</a>
                </div>
            </div>
        </nav>
    </header>

    <div class="banner-area">
        <div class="titulo">
            CULTIVA INTELIGENTE, CULTIVA MEJOR
        </div>
        <div class="subtitulo">
            LLEVA LA AGRICULTURA AL SIGUIENTE NIVEL CON NUESTRAS SONDAS
        </div>
        <div class="button">
            <button name="Contactanos">Contactanos</button>
        </div>
    </div>

    <div class="content-area">
        <section>
            <div>
                <div class="titulo_seccion">
                    Toda la información a la alcance de tu mano
                </div>
            </div>
            <div class="wrapper_row">
                <div>
                    <img class="img_responsive" src="./assets/img1.jpg" alt="Manos sujetando un movil" />
                </div>
                <div class="text-area">
                    <p>
                        Gracias a nuestra web podrás ver los parámetros de tu campo en tiempo real, recibir alertas en el móvil... ¡Y muchas más cosas!
                    </p>
                </div>
            </div>
        </section>
        <section class="grey">
            <div>
                <div class="titulo_seccion">Mediciones en tiempo real</div>
            </div>
            <div class="wrapper_row">
                <div style="order: 1;">
                    <img class="img_responsive" src="./assets/icons.png" alt="Manos sujetando un movil" />
                </div>
                <div class="text-area">
                    <p>
                        Gracias a nuestra web podrás ver los parámetros de tu campo en tiempo real, recibir alertas en el móvil... ¡Y muchas más cosas!
                    </p>
                </div>
            </div>
        </section>
        <section class="row">
            <div class="wrapper_col">
                <div>
                    <div class="titulo_seccion">Confianza</div>
                </div>
                <div>
                    <img class="icon_responsive icon_small" src="./assets/hands.svg" alt="hands">
                </div>
            </div>
            <div class="wrapper_col">
                <p>Damos una vital importancia a la confianza con nuestros clientes</p>
            </div>
        </section>
        <section class="row grey">
            <div class="wrapper_col">
                <p>Nuestro trabajo consiste en una constante evolución y aprendizaje</p>
            </div>
            <div class="wrapper_col">
                <div>
                    <div class="titulo_seccion">Perseverancia</div>
                </div>
                <div>
                    <img class="icon_responsive" src="./assets/book.svg" alt="hands">
                </div>
            </div>
        </section>
        <section class="row">
            <div class="wrapper_col">
                <div>
                    <div class="titulo_seccion">Comprensión</div>
                </div>
                <div>
                    <img class="icon_responsive" src="./assets/calendar.svg" alt="hands">
                </div>
            </div>
            <div class="wrapper_col">
                <p>
                    Nos adaptamos a su horario sin compromiso</p>
            </div>
        </section>
    </div>
    <footer class="row" div>
        <div class="wrapper_row" div>
            <div>
                <img class=" icon_footer " src="./assets/trash.svg " alt="hands ">
            </div>
            <div>
                <img class="icon_footer " src="./assets/mail.svg " alt="hands ">
            </div>
            <div>
                <img class="icon_footer " src="./assets/chat.svg " alt="hands ">
            </div>
        </div>
        <div>
            <ul class="wrapper_col">
                <a href="#">Contacto</a>
                <a href="#">Términos y Condiciones</a>
            </ul>
        </div>
        <div>
            <ul class="wrapper_col">
                <a href="#">Política de Cookies</a>
                <a href="#">Política de Privacidad</a>
            </ul>
        </div>
    </footer>
</body>

</html>