<?php

include('db.php');

$USUARIO=$_POST['usuario'];
$CONTRASEÑA=$_POST['password'];

$consulta="SELECT* FROM Personal where usuario= '$USUARIO' and password = '$CONTRASEÑA' ";
$resultado= mysqli_query($conexion, $consulta);
$filas=mysqli_num_rows($resultado);

if($filas){
    header("location:home.html");

}else{
    include("index.html");
    ?>
    <h1>ERROR DE AUTENTIFICACIÓN</h1>
<?php
}
mysqli_free_result($resultado);
mysqli_close($conexion);
?>