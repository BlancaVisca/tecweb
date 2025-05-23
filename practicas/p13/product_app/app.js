$(document).ready(function() {
    let edit = false;
    
    listarProductos();

    // FUNCIÓN PARA LISTAR PRODUCTOS
    function listarProductos() {
        $.get('http://localhost/tecweb/practicas/p13/product_app/backend/products', function(response) {
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
                                <td><a href="#" class="product-item">${producto.nombre}</a></td>
                                <td><ul>${descripcion}</ul></td>
                                <td>
                                    <button class="product-delete btn btn-danger">Eliminar</button>
                                </td>
                            </tr>
                        `;
                    });

                    // SE INSERTA LA PLANTILLA EN EL ELEMENTO CON ID "products"
                    $('#products').html(template);
                }
            }
        );
    }

    $('#search').keyup(function() {
        if($('#search').val()) {
            let search = $('#search').val();
            $.get('http://localhost/tecweb/practicas/p13/product_app/backend/products1', { search }, function(response) {
                    if(!response.error) {
                        // SE OBTIENE EL OBJETO DE DATOS A PARTIR DE UN STRING JSON
                        const productos = JSON.parse(response);
                        
                        // SE VERIFICA SI EL OBJETO JSON TIENE DATOS
                        if(Object.keys(productos).length > 0) {
                            // SE CREA UNA PLANTILLA PARA CREAR LAS FILAS A INSERTAR EN EL DOCUMENTO HTML
                            let template = '';
                            let template_bar = '';

                            productos.forEach(producto => {
                                // SE CREA UNA LISTA HTML CON LA DESCRIPCIÓN DEL PRODUCTO
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
                                            <button class="product-delete btn btn-danger">
                                                Eliminar
                                            </button>
                                        </td>
                                    </tr>
                                `;

                                template_bar += `
                                    <li>${producto.nombre}</il>
                                `;
                            });
                            // SE HACE VISIBLE LA BARRA DE ESTADO
                            $('#product-result').show();
                            // SE INSERTA LA PLANTILLA PARA LA BARRA DE ESTADO
                            $('#container').html(template_bar);
                            // SE INSERTA LA PLANTILLA EN EL ELEMENTO CON ID "productos"
                            $('#products').html(template);    
                        }
                    }
                }
            );
        }
        else {
            $('#product-result').hide();
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



    // AGREGAR O MODIFICAR UN PRODUCTO
    $('#product-form').submit(e => {
        e.preventDefault();
        //Elimina los mensaje de las validaciones anterirores
        $(".status-bar").remove();
        $('#error-message').hide();
        
        // SE CONVIERTE EL JSON DE STRING A OBJETO
        let postData = {
            nombre: $('#name').val(),
            precio: parseFloat($('#precio').val()),
            unidades: parseInt($('#unidades').val()),
            modelo: $('#modelo').val(),
            marca: $('#marca').val(),
            detalles: $('#detalles').val(),
            imagen: $('#imagen').val(),
            id: $('#productId').val()
        };
         // VALIDAR CAMPOS OBLIGATORIOS ANTES DE ENVIAR A BD
         let camposValidos = true;
         $("#name, #precio, #unidades, #modelo, #marca").each(function() {
             if ($(this).val().trim() === "") {
                 validarCampo($(this)); 
                 camposValidos = false;
             }
         });
         $("#imagen").each(function() {
            if ($(this).val().trim() === "") {
                validarImagen($(this)); 
                camposValidos = false;
            }
        });
         if (!camposValidos) return;

         
        const url = edit === false ? 'http://localhost/tecweb/practicas/p13/product_app/backend/productos' : 'http://localhost/tecweb/practicas/p13/product_app/backend/productos/editar';
        
        $.post(url, postData, (response) => {
            // SE OBTIENE EL OBJETO DE DATOS A PARTIR DE UN STRING JSON
            let respuesta = JSON.parse(response);
            
            // SE CREA UNA PLANTILLA PARA CREAR INFORMACIÓN DE LA BARRA DE ESTADO
            let template_bar = `
                <li>Status: ${respuesta.status}</li>
                <li>Mensaje: ${respuesta.message}</li>
            `;

            $('button.btn-primary').text("Agregar Producto");
            // SE REINICIA EL FORMULARIO
            $('#product-form')[0].reset();
            // SE HACE VISIBLE LA BARRA DE ESTADO
            $('#product-result').show();
            // SE INSERTA LA PLANTILLA PARA LA BARRA DE ESTADO
            $('#container').html(template_bar);
            // SE LISTAN TODOS LOS PRODUCTOS
            listarProductos();
            // SE REGRESA LA BANDERA DE EDICIÓN A false
            edit = false;
        });
    });


    //FUNCION EXTRA PARA LA VALIDACION DEL NOMBRE
    $('#name').keyup(function() {
        let search = $('#name').val(); 
        if (search.length > 0) { 
            $.ajax({
                url: 'http://localhost/tecweb/practicas/p13/product_app/backend/productos/nombre',
                type: 'GET',
                data: { name: search },
                success: function (response) {
                    const data = JSON.parse(response);  
                    if(data.error) {
                        $('#name').addClass('invalid');
                        $('#error-message').text(data.message)  
                            .css('color', 'red');
                    } else {
                        
                        $('#name').removeClass('invalid');
                        $('#error-message').text(data.message)  
                            .css('color', '#72d600').show(); 
                    }
                },
            });
        } 
    });
    
    
  

    // ELIMINAR PRODUCTO
    $(document).on('click', '.product-delete', function () {
        if (confirm('¿Deseas eliminar el Producto?')) {
            let id = $(this).closest('tr').attr('productId');
            console.log("ID del producto a eliminar:", id);
    
            $.ajax({
                url: `http://localhost/tecweb/practicas/p13/product_app/backend/productos/${id}`,
                type: 'DELETE',
                success: function (response) {
                    console.log("Respuesta del servidor:", response);
                    let respuesta = typeof response === 'string' ? JSON.parse(response) : response;
    
                    let template_bar = `
                        <li style="list-style: none;">status: ${respuesta.status}</li>
                        <li style="list-style: none;">message: ${respuesta.message}</li>
                    `;
                    $('#container').html(template_bar);
                    $('#product-result').addClass('d-block');
                    listarProductos();
                },
                error: function (xhr, status, error) {
                    console.error("Error al eliminar el producto:", error);
                }
            });
        }
    });
    

    // EDITAR PRODUCTO   -----------> ID

    
    $(document).on('click', '.product-item', function(e) {
        e.preventDefault();
        const element = $(this).closest('tr');
        const id = element.attr('productId');

        $.get('http://localhost/tecweb/practicas/p13/product_app/backend/product', { id }, (response) => {
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


/*
    // EDITAR PRODUCTO POR NOMBRE
    $(document).on('click', '.product-item', function(e) {
    e.preventDefault();
    const element = $(this).closest('tr');  // Selecciona la fila completa que contiene el nombre

    // Obtener el nombre del producto desde el enlace <a> con la clase product-item
    const name = element.find('td a.product-item').text();
    console.log('Nombre del producto:', name);

    $.get('http://localhost/tecweb/practicas/p13/product_app/backend/productos/buscar-nombre', { name }, (response) => {
        // SE CONVIERTE A OBJETO EL JSON OBTENIDO
        let product = JSON.parse(response);

        // SE INSERTAN LOS DATOS ESPECIALES EN LOS CAMPOS CORRESPONDIENTES
        $('#name').val(product.nombre);
        $('#productId').val(product.id);  // Aquí seguimos usando el id para actualización
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
*/

});
