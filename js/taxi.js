const url = '../api/api_taxi.php';
var data = [];

function readAllTaxis() {
    axios({
        method: 'GET',
        url: url,
        responseType: 'json'
    }).then(res => {
        console.log(res.data);
        this.data = res.data.data;
        console.log(res.data.status);
        if (res.data.status == "error")
            window.location.href = "401.html";
        else
            llenarTabla(data);
    }).catch(error => {
        console.error(error);
    });
}

function llenarTabla(data) {
    document.querySelector('#table-taxi tbody').innerHTML = '';
    for (let i = 0; i < data.length; i++) {
        document.querySelector('#table-taxi tbody').innerHTML +=
            `<tr>
            <td>${data[i].taxi_id}</td>
            <td>${data[i].taxi_marca}</td>
            <td>${data[i].taxi_modelo}</td>
            <td>${data[i].taxi_anio}</td>
            <td>${data[i].taxi_color}</td>
            <td>${data[i].taxi_conductor}</td>
            <td>${data[i].taxi_ubicacion}</td>
            <td><button type="button" onclick="deleteTaxi(${data[i].taxi_id})">Delete</button>
            <button type="button" onclick="updateTaxi(${data[i].taxi_id})">Update</button> 
            <button type="button" onclick="readTaxiById(${data[i].taxi_id})">Read</button> </td>
        </tr>`
    }
}

function deleteTaxi(id_del) {
    let taxi = {
        id: id_del
    };
    axios({
        method: 'DELETE',
        url: url,
        responseType: 'json',
        data: taxi
    }).then(res => {
        console.log(res.data);
        readAllTaxis();
    }).catch(error => {
        console.error(error);
    });
}

function createTaxi() {


    let marca = document.getElementById('marca').value
    let modelo = document.getElementById('modelo').value
    let anio = document.getElementById('anio').value
    let color = document.getElementById('color').value
    let conductor = document.getElementById('conductor').value
    let ubicacion = document.getElementById('ubicacion').value

    let taxi = {
        marca: marca,
        modelo: modelo,
        anio: anio,
        color: color,
        conductor: conductor,
        ubicacion: ubicacion
    };

    let isValid = true;

    Object.keys(taxi).forEach((key) => {
        if (!taxi[key]) {
            isValid = false;
            console.error(`El campo ${key} es obligatorio.`);
            alert(`El campo ${key} es obligatorio.`);
            return;
        }
    });

    if (isValid) {
        console.log("El objeto taxi es válido. Realizar acciones adicionales aquí.");
    }

    axios({
        method: 'POST',
        url: url,
        responseType: 'json',
        data: taxi
    }).then(res => {
        console.log(res.data);
        if (res.data.message === 'Duplicate data')
            alert('Dato duplicado.');
        else
            readAllTaxis();
    }).catch(error => {
        console.error(error);
    });
}

function updateTaxi(id_update) {
    marca_update = document.getElementById('marca').value;

    if (marca_update != "") {

        let taxi = {
            id: id_update,
            marca: marca_update,
            modelo: document.getElementById('modelo').value,
            anio: document.getElementById('anio').value,
            color: document.getElementById('color').value,
            conductor: document.getElementById('conductor').value,
            ubicacion: document.getElementById('ubicacion').value
        };

        axios({
            method: 'PUT',
            url: url,
            responseType: 'json',
            data: taxi
        }).then(res => {
            console.log(res.data);
            if (res.data.status === 'error')
                alert('Dato duplicado.');
            else
                readAllTaxis();
        }).catch(error => {
            console.error(error);
        });
    } else
        alert("Debe colocar una marca");
}

function readTaxiById(id) {
    axios({
        method: 'GET',
        url: url + '?id=' + id,
        responseType: 'json'
    }).then(res => {
        console.log(res.data);
        document.getElementById('marca').value = res.data.data[0].taxi_marca;
        document.getElementById('modelo').value = res.data.data[0].taxi_modelo;
        document.getElementById('anio').value = res.data.data[0].taxi_anio;
        document.getElementById('color').value = res.data.data[0].taxi_color;
        document.getElementById('conductor').value = res.data.data[0].taxi_conductor;
        document.getElementById('ubicacion').value = res.data.data[0].taxi_ubicacion;
    }).catch(error => {
        console.error(error);
    });
}
