let map;
let parcelas;
let zoom = false;
let posiciones = {};


async function initMap() {

    let urlParams = new URLSearchParams(window.location.search);
    let usuario = urlParams.get("usuario");
    let parcela = urlParams.get("parcela");

    if (usuario) {
        obtenerParcelasUsuario(usuario);
    } else if (parcela) {
        obtenerParcela(parcela)
    } else {
        obtenerParcelasUsuario(1);
    }
}

function crearMapa() {
    map = new google.maps.Map(document.getElementById('mapa'), {
        center: {
            lat: 39.9965055,
            lng: -0.1674364
        },
        zoom: 18,
        mapTypeId: 'hybrid',
        styles: [{
            featureType: 'poi',
            stylers: [{
                visibility: 'off'
            }]
        }, {
            featureType: 'transit',
            stylers: [{
                visibility: 'off'
            }]
        }],
        mapTypeControl: false,
        streetViewControl: false,
        rotateControl: false,
    });
}

async function obtenerParcela(parcela) {
    crearMapa();
    let consulta = await fetch("http://localhost/src/api/parcela.php/parcela?id=" + parcela);
    parcelas = [];
    parcelas[0] = await consulta.json();
    await crearPoligono(parcelas[0]);
    ajustarMapa();
}

async function obtenerParcelasUsuario(usuario) {
    crearMapa();
    let consulta = await fetch("http://localhost/src/api/parcela.php/user?usuario=" + usuario);
    parcelas = await consulta.json();
    for (let index = 0; index < parcelas.length; index++) {
        await crearPoligono(parcelas, index, usuario);
    }
    ajustarMapa();
}

function crearSelector() {
    let selector = document.getElementById("selector-parcelas");
    parcelas.forEach(function(parcela, index) {
        let label = document.createElement('label');
        label.textContent = parcela.nombre_parcela;
        label.setAttribute("for", "button" + index);
        let check = document.createElement('input');
        check.setAttribute("id", "button" + index);
        check.type = 'checkbox';
        check.addEventListener('change', function() {
            mostrarOcultarParcela(index, check.checked);
        })
        selector.append(check);
        selector.append(label);
    })
}

async function crearPoligono(parcelas, x, usuario) {
    let parcela = parcelas[x];
    let id = parcela.parcela || parcela.id;
    let titulo = document.getElementById('titulo');
    let consulta = await fetch("http://localhost/src/api/parcela.php/vertices?parcela=" + id);
    let vertices = await consulta.json();
    parcela.polygon = new google.maps.Polygon({
        paths: vertices,
        strokeColor: "#" + parcela.color,
        strokeOpacity: 0.8,
        strokeWeight: 2,
        fillColor: "#" + parcela.color,
        fillOpacity: 0.35,
        map: map
    });
    google.maps.event.addListener(parcela.polygon, 'click', function(event) {
        for (let y = 0; y < parcelas.length; y++) {
            const parcela = parcelas[y];
            if (!zoom) {
                if (x != y) {
                    if (parcela.polygon) {
                        parcela.polygon.setMap(null);
                        titulo.textContent = "SELECCIONE SU SONDA";
                        crearMarcadores(usuario, id);
                    }
                }
            } else {
                if (x != y) {
                    if (parcela.polygon) {
                        parcela.polygon.setMap(map);
                        titulo.textContent = "SELECCIONE SU CAMPO";
                        for (const key in posiciones) {
                            if (Object.hasOwnProperty.call(posiciones, key)) {
                                const mark = posiciones[key];
                                mark.setMap(null);
                            }
                        }
                        posiciones = {};
                    }
                }
            }
        }
        if (!zoom) {
            zoom = true;

        } else {
            zoom = false;
        }
        ajustarMapa();
        //alert(parcela.parcela || parcela.id);
    });
}

async function crearMarcadores(userID, parcelaID) {
    let consulta = await fetch("http://localhost/src/api/sonda.php/getMarcadores?user=" + userID + "&parcela=" + parcelaID);
    sondas = await consulta.json();
    count = 0;
    sondas.forEach(sonda => {
        mark = new google.maps.Marker({
            position: {
                lat: parseFloat(sonda.latitud),
                lng: parseFloat(sonda.longitud)
            },
            draggable: false,
            id: sonda.id_sonda
        });
        posiciones["sonda" + count] = mark;
        count++;
    });
    for (const key in posiciones) {
        if (Object.hasOwnProperty.call(posiciones, key)) {
            const mark = posiciones[key];
            mark.setMap(map);
            google.maps.event.addListener(mark, 'click', function(event) {
                window.location.href = "datos_sondas.html?idSonda=" + mark.id;
            });
        }
    }
}

async function mostrarOcultarParcela(index, mostrar) {
    let parcela = parcelas[index];
    if (mostrar) {
        if (parcela.polygon) {
            parcela.polygon.setMap(map);
        } else {
            await crearPoligono(parcela);
        }
    } else {
        if (parcela.polygon) parcela.polygon.setMap(null);
    }
    ajustarMapa();
}

function ajustarMapa() {
    let bounds = new google.maps.LatLngBounds();
    parcelas.forEach(function(parcela) {
        if (parcela.polygon && parcela.polygon.getMap()) {
            parcela.polygon.getPath().getArray().forEach(function(v) {
                bounds.extend(v);
            })
        }
    })
    if (!bounds.isEmpty()) map.fitBounds(bounds);
}