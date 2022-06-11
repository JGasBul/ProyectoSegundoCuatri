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
    let fechas = new Map();
    valoresFinales = new Map();

    sondas.forEach(sonda => {
        mark = new google.maps.Marker({
            position: {
                lat: parseFloat(sonda.latitud),
                lng: parseFloat(sonda.longitud)
            },
            draggable: false,
            id: sonda.id_sonda,
            title: "Sonda numero " + sonda.id_sonda,
        });
        posiciones["sonda" + count] = mark;
        count++;
    });
    for (const key in posiciones) {
        if (Object.hasOwnProperty.call(posiciones, key)) {
            const mark = posiciones[key];
            mark.setMap(map);

            let peticion = await fetch('http://localhost/src/api/sonda.php/getMediciones?idSonda=' + mark.id);
            let mediciones = await peticion.json();
            mediciones.forEach(function(sensor) {
                let fecha = sensor.hora;
                fechas.set(sensor.sensor, fecha);
            });

            mediciones.forEach(function(sensor) {
                switch (sensor.sensor) {
                    case "Temperatura":
                        if (sensor.hora == fechas.get("Temperatura")) {
                            valoresFinales.set("Temperatura", sensor.medicion)
                        }
                        break;
                    case "Salinidad":
                        if (sensor.hora == fechas.get("Salinidad")) {
                            valoresFinales.set("Salinidad", sensor.medicion)
                        }
                        break;
                    case "Luz":
                        if (sensor.hora == fechas.get("Luz")) {
                            valoresFinales.set("Luz", sensor.medicion)
                        }
                        break;
                    case "Humedad":
                        if (sensor.hora == fechas.get("Humedad")) {
                            valoresFinales.set("Humedad", sensor.medicion)
                        }
                        break;

                    default:
                        break;
                }
            });

            const contentString =
                '<div id="content">' +
                '<div id="siteNotice">' +
                '<h1 id="firstHeading" class="firstHeading">Sonda numero ' + mark.id + '</h1>' +
                "</div>" +
                '<div id="bodyContent">' +
                '<h2>Mediciones de la última hora </h2>' +
                '<p><b>Temperatura: </b>' + valoresFinales.get("Temperatura") + "ºC" + ' </p>' +
                '<p><b>Humedad: </b>' + valoresFinales.get("Humedad") + "%" + '</p>' +
                '<p><b>Salinidad: </b>' + valoresFinales.get("Salinidad") + "%" + ' </p>' +
                '<p><b>Cantidad de luz: </b>' + valoresFinales.get("Luz") + "%" + ' </p>' +
                '<h3>Pulse el marcador para mas información</h3>' +
                "</div>" +
                "</div>";

            const infowindow = new google.maps.InfoWindow({
                content: contentString,
            });

            google.maps.event.addListener(mark, 'mouseover', function(event) {
                infowindow.open({
                    anchor: mark,
                    map,
                    shouldFocus: false,
                });
            });

            google.maps.event.addListener(mark, 'mouseout', function(event) {
                infowindow.close({});
            });

            google.maps.event.addListener(mark, 'click', function(event) {
                window.location.href = "datos_sondas.php?idSonda=" + mark.id + "&userID=" + userID;
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