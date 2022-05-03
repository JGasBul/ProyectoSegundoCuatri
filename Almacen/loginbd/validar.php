<?php

include('db.php');

$USUARIO=$_POST['usuario'];
$PASSWORD=$_POST['password'];

$consulta="SELECT* FROM Personal where usuario= '$USUARIO' and password = '$PASSWORD' ";
$resultado= mysqli_query($conexion, $consulta);
$filas=mysqli_num_rows($resultado);

if($filas){
    header("location:Pagina_demostarcion_incidencia.html");

}else{
    include("index.html");
    ?>
    <h1>ERROR DE AUTENTIFICACIÓN</h1>
<?php
}
mysqli_free_result($resultado);
?>

<?php

include('db.php');

$USUARIO=$_POST['usuario'];
$PASSWORD=$_POST['password'];

$consulta="SELECT* FROM Admin where usuario= '$USUARIO' and password = '$PASSWORD' ";

$resultado= mysqli_query($conexion, $consulta);
$filas=mysqli_num_rows($resultado);

if($filas){
    header("location:Pagina_Demostracion_admin.html");

}else{
    include("index.html");
    ?>
    <h1>ERROR DE AUTENTIFICACIÓN</h1>
    <?php
}
mysqli_free_result($resultado);
?>
