<!DOCTYPE html>
<html lang="es" style="min-height: 100%">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Datos Sonda</title>
    <link rel="stylesheet" href="css/datos_sondas.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/luxon@2.4.0/build/global/luxon.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-luxon@1.1.0/dist/chartjs-adapter-luxon.min.js"></script>
</head>

<body>
    <!-- Header -->
    <div id="scroll_arriba"></div>
    <header class="header-area">
        <div class="logo">
            <a href="../index.html"><img src="../assets/logo_gti.svg" alt="logo_empresa" width="150" /></a>
        </div>
        <div class="dropdown">
            <a class="dropbtn" href="./logout.php"><img src="../assets/cerrar_sesion.png" alt="Boton de cerrar sesion"></a>
        </div>
    </header>
    <!-- Fin header -->
    <a class="atras" href="parcelas.html?usuario=<?php echo $_GET['userID'] ?>"><img src="../assets/atras.svg"></a>
    <div class="chart-container">
        <canvas id="temperatura"></canvas>
        <canvas id="salinidad"></canvas>
        <canvas id="luz"></canvas>
        <canvas id="humedad"></canvas>
    </div>

    <script src="./js/canvas.js"></script>

</body>

</html>