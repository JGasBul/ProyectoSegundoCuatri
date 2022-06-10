function enviarLogin(event) {
    event.preventDefault();

    let formData = new FormData(event.target);

    let url = "api/v1.0/sesion";

    fetch(url, {
        method: 'post',
        body: formData
    }).then(function (respuesta) {
        //console.log(respuesta);
        return respuesta.json();
    }).then(function (datos) {
        //Si va bien, lo reenvio al test-formulario
        console.log(datos.nombre);
        location.href = "app/test-formulario.html";
    }).catch(function () {
        //Si hay un error, hago visible el mensaje de error
        document.getElementById("error").style.visibility = "visible";
    });
}
//-----------------------------------------------------------------------------------
//MostrarOcultarPassword
//-----------------------------------------------------------------------------------
function MostrarOcultarPassword() {
    var tipo = document.getElementById("password");
    if (tipo.type == "password") {
        tipo.type = "text";
    } else {
          tipo.type = "password";
    }
}