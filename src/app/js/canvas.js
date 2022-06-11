async function cargarDatos() {
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);

    let peticion = await fetch('http://localhost/src/api/sonda.php/getMediciones?idSonda=' + urlParams.get('idSonda'));
    let mediciones = await peticion.json();

    let labels = []; //array de fechas

    let valor_temperatura = []; //array de importe
    let valor_humedad = []; //array de importe
    let valor_luz = []; //array de importe
    let valor_salinidad = []; //array de importe

    let datasets_temperatura = [{
        label: 'Sensor de Temperatura (ºC)',
        data: [],
        //fill: true, //Relleno==true
        backgroundColor: 'rgba(255,69,34,.5)', //Color de fondo
        borderColor: 'rgb(255,110,86)', //Color de linea
    }]; //array de datos

    let datasets_humedad = [{
        label: 'Sensor de Humedad (%)',
        data: [],
        //fill: true, //Relleno==true
        backgroundColor: 'rgba(39, 76, 245, 0.8)', //Color de fondo
        borderColor: 'rgba(39, 76, 245, 0.8)', //Color de linea
    }]; //array de datos

    let datasets_salinidad = [{
        label: 'Sensor de Salinidad (%)',
        data: [],
        //fill: true, //Relleno==true
        backgroundColor: 'rgba(122, 66, 27, 0.94) ', //Color de fondo
        borderColor: 'rgba(122, 66, 27, 0.94)', //Color de linea
    }]; //array de datos

    let datasets_luz = [{
        label: 'Sensor de Luz (%)',
        data: [],
        //fill: true, //Relleno==true
        backgroundColor: 'rgba(245, 178, 39, 0.8)', //Color de fondo
        borderColor: 'rgba(245, 178, 39, 0.8)', //Color de linea
    }]; //array de datos

    /*
    datasets_conjunto = [{
        label: 'Sensor de Salinidad (%)',
        data: [],
        //fill: true, //Relleno==true
        backgroundColor: 'rgba(122, 66, 27, 0.94) ', //Color de fondo
        borderColor: 'rgba(122, 66, 27, 0.94)', //Color de linea
    }, {
        label: 'Sensor de Luz (%)',
        data: [],
        //fill: true, //Relleno==true
        backgroundColor: 'rgba(245, 178, 39, 0.8)', //Color de fondo
        borderColor: 'rgba(245, 178, 39, 0.8)', //Color de linea
    }, {
        label: 'Sensor de Humedad (%)',
        data: [],
        //fill: true, //Relleno==true
        backgroundColor: 'rgba(39, 76, 245, 0.8)', //Color de fondo
        borderColor: 'rgba(39, 76, 245, 0.8)', //Color de linea
    }];
*/
    mediciones.forEach(function(sensor) {
        let fecha = sensor.hora;
        fecha = fecha.slice(11, -3);
        switch (sensor.sensor) {
            case 'Humedad':
                labels.push(fecha);
                valor_humedad.push(parseFloat(sensor.medicion));
                break;
            case 'Temperatura':
                valor_temperatura.push(parseFloat(sensor.medicion));
                break;
            case 'Luz':
                valor_luz.push(parseFloat(sensor.medicion));
                break;
            case 'Salinidad':
                valor_salinidad.push(parseFloat(sensor.medicion));
                break;
            default:
                break;
        }
    })

    datasets_temperatura[0].data = valor_temperatura;
    datasets_humedad[0].data = valor_humedad;
    datasets_salinidad[0].data = valor_salinidad;
    datasets_luz[0].data = valor_temperatura;

    datos_temperatura.labels = labels;
    datos_temperatura.datasets = datasets_temperatura;

    datos_humedad.labels = labels;
    datos_humedad.datasets = datasets_humedad;

    datos_salinidad.labels = labels;
    datos_salinidad.datasets = datasets_salinidad;

    datos_luz.labels = labels;
    datos_luz.datasets = datasets_luz;

    crearGrafica();
}

//datos de la gráfica de temperatura
let datos_temperatura = {
    labels: [],
    datasets: []
};
//datos de la gráfica de temperatura

let datos_humedad = {
    labels: [],
    datasets: []
};
//datos de la gráfica de temperatura

let datos_salinidad = {
    labels: [],
    datasets: []
};

//datos de la gráfica de temperatura
let datos_luz = {
    labels: [],
    datasets: []
};

const config = {
    options: {
        responsive: true,
        //maintainAspectRatio: false,
    },
    plugins: {
        legend: {
            position: 'bottom',
            align: 'center'
        },
        title: {
            display: true,
            text: 'Mediciones de las ultimas 12 horas'
        },
        tooltip: {
            backgroundColor: '#fff',
            titleColor: '#000',
            titleAlign: 'center',
            bodyColor: '#333',
            borderColor: '#666',
            borderWidth: 1,
        }
    }
};

let temperatura = document.getElementById('temperatura');
let humedad = document.getElementById('humedad');
let salinidad = document.getElementById('salinidad');
let luz = document.getElementById('luz');

cargarDatos();

function crearGrafica() {
    let grafica_temperatura = new Chart(temperatura, {
        type: 'line',
        data: datos_temperatura,
        options: config
    });

    let grafica_humedad = new Chart(humedad, {
        type: 'line',
        data: datos_humedad,
        options: config
    });

    let grafica_salinidad = new Chart(salinidad, {
        type: 'line',
        data: datos_salinidad,
        options: config
    });

    let grafica_luz = new Chart(luz, {
        type: 'line',
        data: datos_luz,
        options: config
    });

}