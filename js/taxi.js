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
            <td>${data[i].id}</td>
            <td>${data[i].marca}</td>
            <td>${data[i].modelo}</td>
            <td>${data[i].anio}</td>
            <td>${data[i].color}</td>
            <td>${data[i].conductor}</td>
            <td>${data[i].ubicacion}</td>
            <td><button type="button" onclick="deleteTaxi(${data[i].id})">Delete</button>
            <button type="button" onclick="updateTaxi(${data[i].id})">Update</button> 
            <button type="button" onclick="readTaxiById(${data[i].id})">Read</button> </td>
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
    let taxi = {
        marca: document.getElementById('marca').value,
        modelo: document.getElementById('modelo').value,
        anio: document.getElementById('anio').value,
        color: document.getElementById('color').value,
        conductor: document.getElementById('conductor').value,
        ubicacion: document.getElementById('ubicacion').value
    };

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
        document.getElementById('marca').value = res.data.data[0].marca;
        document.getElementById('modelo').value = res.data.data[0].modelo;
        document.getElementById('anio').value = res.data.data[0].anio;
        document.getElementById('color').value = res.data.data[0].color;
        document.getElementById('conductor').value = res.data.data[0].conductor;
        document.getElementById('ubicacion').value = res.data.data[0].ubicacion;
    }).catch(error => {
        console.error(error);
    });
}
