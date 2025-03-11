
$(document).ready(function() {
    let edit = false;
    

    listarProductos();

    // FUNCIÓN PARA LISTAR PRODUCTOS
    function listarProductos() {
        $.ajax({
            url: './backend/product-list.php',
            type: 'GET',
            success: function(response) {
                const productos = JSON.parse(response);
                if (Object.keys(productos).length > 0) {
                    let template = '';
                    
                    productos.forEach(producto => {
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

                    $('#products').html(template);
                }
            }
        });
    }

    // BÚSQUEDA DE PRODUCTOS
    $('#search').keyup(function() {
        let search = $('#search').val();
        if (search) {
            $.ajax({
                url: `./backend/product-search.php?search=${search}`,
                type: 'GET',
                success: function(response) {
                    if (!response.error) {
                        const productos = JSON.parse(response);
                        let template = '';
                        let template_bar = '';

                        productos.forEach(producto => {
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
                            template_bar += `<li>${producto.nombre}</li>`;
                        });

                        $('#product-result').show();
                        $('#container').html(template_bar);
                        $('#products').html(template);
                    }
                }
            });
        } else {
            $('#product-result').hide();
        }
    });

    // AGREGAR O MODIFICAR UN PRODUCTO
    $('#product-form').submit(e => {
        e.preventDefault();
        
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

        const url = edit ? './backend/product-edit.php' : './backend/product-add.php';
        
        $.post(url, postData, (response) => {
            let respuesta = JSON.parse(response);
            
            let template_bar = `
                <li>Status: ${respuesta.status}</li>
                <li>Mensaje: ${respuesta.message}</li>
            `;

            $('button.btn-primary').text("Agregar Producto");
            $('#product-form')[0].reset();
            $('#product-result').show();
            $('#container').html(template_bar);
            listarProductos();
            edit = false;
        });
    });

    // ELIMINAR PRODUCTO
    $(document).on('click', '.product-delete', function() {
        if (confirm('¿Realmente deseas eliminar el producto?')) {
            const element = $(this).closest('tr');
            const id = element.attr('productId');
            $.post('./backend/product-delete.php', { id }, (response) => {
                $('#product-result').hide();
                listarProductos();
            });
        }
    });

    // EDITAR PRODUCTO
    $(document).on('click', '.product-item', function(e) {
        e.preventDefault();
        const element = $(this).closest('tr');
        const id = element.attr('productId');

        $.post('./backend/product-single.php', { id }, (response) => {
            let product = JSON.parse(response);
            $('#name').val(product.nombre);
            $('#productId').val(product.id);
            $('#precio').val(product.precio);
            $('#unidades').val(product.unidades);
            $('#modelo').val(product.modelo);
            $('#marca').val(product.marca);
            $('#detalles').val(product.detalles);
            $('#imagen').val(product.imagen);
            
            edit = true;
            $('button.btn-primary').text("Modificar Producto");
        });
    });
});
