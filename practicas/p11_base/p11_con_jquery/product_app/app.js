// JSON BASE A MOSTRAR EN FORMULARIO
var baseJSON = {
    "precio": 0.0,
    "unidades": 1,
    "modelo": "XX-000",
    "marca": "NA",
    "detalles": "NA",
    "imagen": "img/default.png"
  };


function init() {
    /**
     * Convierte el JSON a string para poder mostrarlo
     * ver: https://developer.mozilla.org/es/docs/Web/JavaScript/Reference/Global_Objects/JSON
     */
    var JsonString = JSON.stringify(baseJSON,null,2);
    document.getElementById("description").value = JsonString;

    // SE LISTAN TODOS LOS PRODUCTOS
    listarProductos();
}


///FUNCIÓN PARA LISTAR LOS PRODUCTOS AL INICIO

function listarProductos() {
    $.ajax({
        url: './backend/product-list.php',
        type: 'GET',
        success: function (response) {
            let productos = JSON.parse(response);
            let template = '';
            productos.forEach(producto => {
                let descripcion = `
                    <li>precio: ${producto.precio}</li>
                    <li>unidades: ${producto.unidades}</li>
                    <li>modelo: ${producto.modelo}</li>
                    <li>marca: ${producto.marca}</li>
                    <li>detalles: ${producto.detalles}</li>
                `;
                template += `
                    <tr productId="${producto.id}">
                        <td>${producto.id}</td>
                        <td>
                            <a href="#" class="product-item">${producto.nombre}</a>
                        </td>
                        <td><ul>${descripcion}</ul></td>
                        <td><button class="product-delete btn btn-danger">Eliminar</button></td>
                    </tr>
                `;
            });

            $('#products').html(template);
        }
    });
}


///FUNCIÓN PARA BUSCAR PRODUCTOS

$('#search').keyup(function() {
    if($('#search').val()) {
        let search = $('#search').val();
        $.ajax({
            url: './backend/product-search.php', 
            data: { search: search },
            type: 'POST',
            success: function (response) {
                if(!response.error) {
                    const productos = JSON.parse(response);

                    if(Object.keys(productos).length > 0) {
                        let template = '';
                        let template_bar = '';

                        productos.forEach(producto => {
                            
                            let descripcion = '';
                            descripcion += '<li>precio: '+producto.precio+'</li>';
                            descripcion += '<li>unidades: '+producto.unidades+'</li>';
                            descripcion += '<li>modelo: '+producto.modelo+'</li>';
                            descripcion += '<li>marca: '+producto.marca+'</li>';
                            descripcion += '<li>detalles: '+producto.detalles+'</li>';
                        
                            template += `
                                <tr productId="${producto.id}">
                                    <td>${producto.id}</td>
                                    <td><a href="#" class="product-item">${producto.nombre}</a></td>
                                    <td><ul>${descripcion}</ul></td>
                                    <td>
                                        <button class="product-delete btn btn-danger" onclick="">
                                            Eliminar
                                        </button>
                                    </td>
                                </tr>
                            `;

                            template_bar += `
                                <li>${producto.nombre}</li> <!-- Corregido el cierre de la etiqueta 'li' -->
                            `;
                        });
                        $('#product-result').removeClass('d-none').show();
                        $('#container').html(template_bar);
                        $('#products').html(template);    
                    }
                }
            }
        });
    }
    else {
        $('#product-result').hide();
    }
});



///FUNCION DE VALIDACIÓN
function validarProducto(finalJSON, nombre) {
    let errores = [];

    // Validación de nombre
    if (!nombre || nombre.length > 100) {
        errores.push("El nombre es obligatorio y debe tener 100 caracteres o menos.");
    }

    // Validación de marca
    let marca = finalJSON.marca ? finalJSON.marca.trim() : "";
    if (!marca || marca == "NA") {
        errores.push("La marca es obligatoria.");
    }

    // Validación de modelo
    let modelo = finalJSON.modelo ? finalJSON.modelo.trim() : "";
    let modeloRegex = /^[a-zA-Z0-9\-]+$/; // Solo letras, números y guiones
    if (!modelo || modelo.length > 25 || !modeloRegex.test(modelo)) {
        errores.push("El modelo es obligatorio, alfanumérico y debe tener 25 caracteres o menos.");
    }

    // Validación de precio
    let precio = parseFloat(finalJSON.precio);
    if (isNaN(precio) || precio <= 99.99) {
        errores.push("El precio es obligatorio y debe ser mayor a 99.99.");
    }

    // Validación de detalles
    let detalles = finalJSON.detalles ? finalJSON.detalles.trim() : "";
    if (detalles.length > 250) {
        errores.push("Los detalles deben tener 250 caracteres o menos.");
    }

    // Validación de unidades
    let unidades = parseInt(finalJSON.unidades);
    if (isNaN(unidades) || unidades <= 0) {
        errores.push("Las unidades son obligatorias y deben ser 0 o más.");
    }

    return errores;
}

// FUNCIÓN PARA AGREGAR PRODUCTOS
$('#product-form').submit(function (e) {
    e.preventDefault();

 
    var productoJsonString = $('#description').val();
    var finalJSON = JSON.parse(productoJsonString);
    finalJSON['nombre'] = $('#name').val();
    finalJSON['id'] = $("#productId").val();
    productoJsonString = JSON.stringify(finalJSON, null, 2);

    var errores = validarProducto(finalJSON, finalJSON['nombre']);

    if (errores.length > 0) {
  
        let template_bar = '';
        errores.forEach(function(error) {
            template_bar += `<li style="list-style: none; color: #ffe18b;">${error}</li>`;
        });
        $('#product-result').removeClass('d-none').addClass('d-block');
        $('#container').html(template_bar);
        return; 
    }

    $.ajax({
        url: './backend/product-add.php',
        type: 'POST',
        contentType: 'application/json',
        data: productoJsonString,
        success: function (response) {
            console.log(response);

            let respuesta = JSON.parse(response);

            let template_bar = `
                <li style="list-style: none;">status: ${respuesta.status}</li>
                <li style="list-style: none;">message: ${respuesta.message}</li>
            `;

            $('#product-result').removeClass('d-none').addClass('d-block');
            $('#container').html(template_bar);
            listarProductos();
        },
        error: function (xhr, status, error) {
            console.error("Error al agregar el producto:", error);
        }
    });
});

// FUNCIÓN PARA ELIMINAR PRODUCTOS

$(document).on("click", ".product-delete", function () {
    if (confirm("¿Deseas eliminar el Producto?")) {
        let id = $(this).closest("tr").attr("productId");
        $.get("./backend/product-delete.php", { id: id }, function (response) {
            let respuesta = JSON.parse(response);
            let template_bar = `
                <li style="list-style: none;">status: ${respuesta.status}</li>
                <li style="list-style: none;">message: ${respuesta.message}</li>
            `;
            $("#container").html(template_bar);
            $("#product-result").addClass("d-block");
            listarProductos();
        });
    }
});