//----------------------------------------------------------------------------------------------------------------------
//region ---SeleccionAsunto---
function SeleccionAsunto(){
    let Asunto=document.getElementById("selector-asunto").value
    if(Asunto==="Seleccione una opción"){
        return false
    }
    return true
}
//endregion
//region ---EnviarFormulario---
function enviarFormulario(event){
    event.preventDefault() //Esto previene su comportamiento normal, es decir, que no se envia
    //Primero iniciamos las comprobaciones
    //region ---Segunda Comprobacion---
    let compr2=SeleccionAsunto()
    if(compr2===false){
        document.getElementById("aviso-asunto").style.visibility="visible"
        return "error"
    }
    //endregion
    //Si no ocurre nada fuera de lo normal con respecto a las comprobaciones, se enviará

    location.href="../app/contactanos_respuesta.html"
    //endregion
}
//endregion
//----------------------------------------------------------------------------------------------------------------------