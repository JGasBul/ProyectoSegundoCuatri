//----------------------------------------------------------------------------------------------------------------------
//region ---EnviarLogin---
function enviarLogin(event){
    event.preventDefault() //Esto previene su comportamiento normal, es decir, que no se envia
    console.log("Login enviado")

    //region ---NombreYContraseñaUsuario_URL---
    let email=document.getElementById( "email-mobile").value
    let passEmail=document.getElementById("contraseña-mobile").value
    let url= "api/v0.0/" + email + "-" + passEmail + ".json"
    console.log(url)
    //endregion

    //region ---MétodoFetch()---
    //Si los datos recogidos no son los que tocan, fetch() nos dará un error 404 "Not Found"
    fetch(url).then(function(respuesta) {
        return respuesta.json() //Una vez recibida la respuesta, la convierto a .json
    }).then(function(datos) {
        console.log(datos.nombre)
        location.href="app/Form_env.html"
    }).catch(function(){
        document.getElementById("error-mobile").style.visibility="visible"
        //Si el tamaño de ventana es superior a 600px de ancho, que es el mínimo te los iPhone 12 Pro
        if(screen.width > 600)
            document.getElementById("error-desktop").style.visibility="visible"
        })
    //endregion
}
//endregion
//----------------------------------------------------------------------------------------------------------------------