async function validarUsuario(ok, error) {
    let consulta = await fetch('../api/v1.0/sesion');
    //Si me devuelve un codigo que no sea 200, me dará error
    if (consulta.status !== 200) {
        if(error) error();
    } else {
        if(ok) ok();
    }
}
