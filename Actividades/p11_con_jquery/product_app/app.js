
$(document).ready(function()  {
   
    listarProductos();


    let edit = false;
    
    listarProductos();

    // FUNCIÓN PARA LISTAR PRODUCTOS
    function listarProductos() {
        $.ajax({
            url: './backend/product-list.php',
            type: 'GET',
            success: function(response) {
                // SE OBTIENE EL OBJETO DE DATOS A PARTIR DE UN STRING JSON
                const productos = JSON.parse(response);
                // SE VERIFICA SI EL OBJETO JSON TIENE DATOS
                if (Object.keys(productos).length > 0) {
                    let template = '';
                    
                    productos.forEach(producto => {
                        // SE CREA UNA LISTA HTML CON LA DESCRIPCIÓN DEL PRODUCTO
                        let descripcion = `
                            <li>Precio: ${producto.precio}</li>
                            <li>Unidades: ${producto.unidades}</li>
                            <li>Modelo: ${producto.modelo}</li>
                            <li>Marca: ${producto.marca}</li>
                            <li>Detalles: ${producto.detalles}</li>
                        `;
                        
                        template += `
                            <tr productId="${producto.id}">
                                <td>${producto.id}</td>
                                <td>${producto.nombre}</td>
                                <td><ul>${descripcion}</ul></td>
                                <td>
                                    <button class="product-delete btn btn-danger">Eliminar</button>
                                </td>
                                <td>
                                        <button class="product-edit btn btn-warning" onclick="">
                                            Editar
                                        </button>     
                                    </td>
                            </tr>
                        `;
                    });

                    // SE INSERTA LA PLANTILLA EN EL ELEMENTO CON ID "products"
                    $('#products').html(template);
                }
            }
        });
    }


///FUNCIÓN PARA BUSCAR PRODUCTOS

$('#search').keyup(function() {
    if($('#search').val()) {
        let search = $('#search').val();
        $.ajax({
            url: './backend/product-search.php',
            data: {search},
            type: 'GET',
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
                                    <td>${producto.nombre}</td>
                                    <td><ul>${descripcion}</ul></td>
                                    <td>
                                        <button class="product-delete btn btn-danger" onclick="">
                                            Eliminar
                                        </button>     
                                    </td>
                                    <td>
                                        <button class="product-edit btn btn-warning" onclick="">
                                            Editar
                                        </button>     
                                    </td>
                                    
                                </tr>
                            `;

                            template_bar += `
                                <li>${producto.nombre}</il>
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
        listarProductos(); 
    }
});

// VALIDAR CAMPOS AL CAMBIAR DE FOCO
$("#name, #precio, #unidades, #modelo, #marca").blur(function() {
    validarCampo($(this));
});

function validarCampo(elemento) {
    let valor = elemento.val().trim();
    let mensaje = "";

    if (valor === "") {
        mensaje = `El campo ${elemento.attr('id')} es obligatorio.`;
    } else {
        switch (elemento.attr('id')) {
            case 'precio':
                if (isNaN(valor) || valor <= 0) mensaje = "El Precio debe ser un número mayor que 0.";
                break;
            case 'unidades':
                if (!Number.isInteger(parseInt(valor)) || parseInt(valor) <= 0) mensaje = "Debe ser un número entero mayor que 0.";
                break;

        }
    }

    mostrarEstado(mensaje, elemento);
}


function validarImagen(elemento) {
    let valor = elemento.val().trim();
    if (valor === "") {
        elemento.val("default-image.jpg");
        mostrarEstado("Se ha asignado una imagen por defecto.", elemento);
    }
}

$("#imagen").blur(function() {
    validarImagen($(this));
});

function mostrarEstado(mensaje, elemento) {
    let estadoCampo = elemento.next('.status-bar'); // Buscar barra de estado junto al campo
    // Si no hay barra de estado, la creamos
    if (!estadoCampo.length && mensaje) {
        estadoCampo = $('<div class="status-bar" style="color:#ffe18b; font-size:12px;"></div>');
        elemento.after(estadoCampo);
    }
    
    // Si hay un mensaje, lo mostramos
    if (mensaje) {
        estadoCampo.text(mensaje).show(); // Muestra el mensaje
    } else {
        estadoCampo.remove(); // Si no hay mensaje, eliminamos la barra
    }
}



// FUNCIÓN PARA AGREGAR PRODUCTOS
$('#product-form').submit(function (e) {
    e.preventDefault();

    // Elimina los mensajes de validaciones anteriores
    $(".status-bar").remove();
    $('#error-message').hide();

    // SE CONVIERTE EL JSON DE STRING A OBJETO
    let postData = {
        nombre: $('#name').val().trim(),
        precio: parseFloat($('#precio').val()) || 0,
        unidades: parseInt($('#unidades').val()) || 0,
        modelo: $('#modelo').val().trim(),
        marca: $('#marca').val().trim(),
        detalles: $('#detalles').val().trim(),
        imagen: $('#imagen').val().trim(),
        id: $('#productId').val().trim()
    };

    // VALIDAR CAMPOS OBLIGATORIOS ANTES DE ENVIAR A BD
    let camposValidos = true;
    let errores = [];

    $("#name, #precio, #unidades, #modelo, #marca").each(function () {
        if ($(this).val().trim() === "") {
            validarCampo($(this));
            camposValidos = false;
        }
    });

    if ($("#imagen").val().trim() === "") {
        validarImagen($("#imagen"));
        camposValidos = false;
    }

    if (!camposValidos) return;

    let url = edit ? './backend/product-edit.php' : './backend/product-add.php';

    // Convertir datos a JSON
    let productoJsonString = JSON.stringify(postData);

    $.ajax({
        url: url,
        type: 'POST',
        contentType: 'application/json',
        data: productoJsonString,
        success: function (response) {
            try {
                let respuesta = JSON.parse(response);

                let template_bar = `
                    <li style="list-style: none;">Status: ${respuesta.status}</li>
                    <li style="list-style: none;">Message: ${respuesta.message}</li>
                `;

                $('#product-result').removeClass('d-none').addClass('d-block');
                $('#container').html(template_bar);

                edit = false;
                init();
                $('#product-form')[0].reset(); // Limpia el formulario

                setTimeout(() => {
                    listarProductos();
                }, 500);
            } catch (error) {
                console.error("Error al procesar la respuesta del servidor:", error);
            }
        },
        error: function (xhr, status, error) {
            console.error("Error en la petición AJAX:", status, error);
        }
    });
});


// FUNCIÓN PARA ELIMINAR PRODUCTOS

$(document).on('click', '.product-delete', function () {
    if (confirm('¿Deseas eliminar el Producto?')) {

        let id = $(this).closest('tr').attr('productId');
        console.log("ID del producto a eliminar:", id);
        $.get('./backend/product-delete.php', { id: id }, function (response) {
            let respuesta = JSON.parse(response);
            let template_bar = `
                <li style="list-style: none;">status: ${respuesta.status}</li>
                <li style="list-style: none;">message: ${respuesta.message}</li>
            `;
            $('#container').html(template_bar);
            $('#product-result').addClass('d-block');
            listarProductos();
        })
    }
});
$('#name').keyup(function() {
    let search = $('#name').val(); 
    if(search.length > 0) { 
        $.ajax({
            url: './backend/product-name.php?name=' + search, 
            type: 'GET',
            success: function (response) {
                const data = JSON.parse(response); 
    
                // Si ya existe un producto con el nombre
                if(data.error) {
                    // Muestra un mensaje de "nombre inválido" en rojo
                    $('#name').addClass('invalid');
                    $('#error-message').text('Nombre inválido, ya existe un producto con ese nombre')
                        .css('color', 'red') 
                } else {
                    // Si el nombre es válido, muestra el mensaje en verde
                    $('#name').removeClass('invalid');
                    $('#error-message').text('Nombre válido').css('color', '#72d600').show(); 
                }
            },

        });
    } 
});


///FUNCIÓN PARA EDITAR PRODUCTOS

$(document).on('click', '.product-edit', function(e) {
    e.preventDefault();
    const element = $(this).closest('tr');
    const id = element.attr('productId');

    $.post('./backend/product-single.php', { id }, (response) => {
        // SE CONVIERTE A OBJETO EL JSON OBTENIDO
        let product = JSON.parse(response);
        // SE INSERTAN LOS DATOS ESPECIALES EN LOS CAMPOS CORRESPONDIENTES
        $('#name').val(product.nombre);
        $('#productId').val(product.id);
        $('#precio').val(product.precio);
        $('#unidades').val(product.unidades);
        $('#modelo').val(product.modelo);
        $('#marca').val(product.marca);
        $('#detalles').val(product.detalles);
        $('#imagen').val(product.imagen);
        
        // SE PONE LA BANDERA DE EDICIÓN EN true
        edit = true;
        $('button.btn-primary').text("Modificar Producto");
    });

});


});


