var form = document.getElementById('formularioProductos'); // Correcto ID
var mensaje1 = '';
var mensaje2 = '';
var mensaje3 = '';
var mensaje4 = '';
var mensaje5 = '';
var mensaje6 = '';
var mensaje7 = '';

function validar_nombre() {
    let entrada = document.getElementById("form-nombre").value;
    let sinErrores = true;

    if (entrada.trim() === "" || entrada.length > 100) {
        mensaje1 = "El campo de nombre no puede estar vacío y la longitud máxima es 100 caracteres.";
        sinErrores = false;
    }

    return sinErrores;
}

function validar_marca() {
    let entrada = document.getElementById("form-marca").value;
    let sinErrores = true;

    if (entrada.trim() === "") {
        mensaje2 = "Selecciona una marca";
        sinErrores = false;
    }

    return sinErrores;
}

function validar_modelo() {
    let entrada = document.getElementById("form-modelo").value;
    let sinErrores = true;
    let exp = /^[a-zA-Z0-9\s]{1,25}$/;

    if (entrada.trim() === "" || !exp.test(entrada)) {
        mensaje3 = "El modelo es obligatorio, debe ser alfanumérico y no exceder los 25 caracteres.";
        sinErrores = false;
    }

    return sinErrores;
}

function validar_precio() {
    let entrada = document.getElementById("form-precio").value;
    let sinErrores = true;

    if (entrada <= 99.99) {
        mensaje4 = "El precio debe ser un número mayor a 99.99.";
        sinErrores = false;
    }

    return sinErrores;
}

function validar_detalles() {
    let entrada = document.getElementById("form-detalles").value;
    let sinErrores = true;

    if (entrada.trim() !== "" && entrada.length > 250) {
        mensaje5 = "Los detalles no pueden tener más de 250 caracteres.";
        sinErrores = false;
    }

    return sinErrores;
}

function validar_unidades() {
    let entrada = document.getElementById("form-unidades").value;
    let sinErrores = true;

    if (entrada === "" || isNaN(entrada) || parseFloat(entrada) < 1) {
        mensaje6 = "Las unidades son requeridas y deben ser un número mayor a 0.";
        sinErrores = false;
    }

    return sinErrores;
}

function validar_imagen() {
    let entrada = document.getElementById("form-img").value;
    let sinErrores = true;
    if (entrada === "") {
        document.getElementById("form-img").value = "../p07-base/img/imagen.png"; 
        mensaje7 = "Si no agrega una imagen, esta será seleccionada por defecto";
    }

    return sinErrores;
}

form.addEventListener('submit', function(event) {
    event.preventDefault();
    let hayErrores = false;

    if (!validar_nombre()) {
        let div1 = document.getElementById("res1");
        div1.innerHTML = '<span>' + mensaje1 + '</span>';
        hayErrores = true;
    }

    if (!validar_marca()) {
        let div2 = document.getElementById("res2");
        div2.innerHTML = '<span>' + mensaje2 + '</span>';
        hayErrores = true;
    }

    if (!validar_modelo()) {
        let div3 = document.getElementById("res3");
        div3.innerHTML = '<span>' + mensaje3 + '</span>';
        hayErrores = true;
    }

    if (!validar_precio()) {
        let div4 = document.getElementById("res4");
        div4.innerHTML = '<span>' + mensaje4 + '</span>';
        hayErrores = true;
    }

    if (!validar_detalles()) {
        let div5 = document.getElementById("res5");
        div5.innerHTML = '<span>' + mensaje5 + '</span>';
        hayErrores = true;
    }

    if (!validar_unidades()) {
        let div6 = document.getElementById("res6");
        div6.innerHTML = '<span>' + mensaje6 + '</span>';
        hayErrores = true;
    }

    if (!validar_imagen()) {
        let div7 = document.getElementById("res7");
        div7.innerHTML = '<span>' + mensaje7 + '</span>';
        hayErrores = true;
    }

    if (!hayErrores) {
        this.submit();
    }
});
