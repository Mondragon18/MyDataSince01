<?= $cabecera ?>
<div class="mb-5">
    <div class="d-flex gap-2 justify-content-between align-items-center">
        <h1>Listado de producto <small class="text-muted">Tus productos</small></h1>
        <a class="active btn btn-link" aria-current="page" href="<?=base_url('mercadolibre/productos/categorias'); ?>">Busqueda de producto</a>
    </div>
    <div class="d-flex justify-content-start w-full flex-column flex-xl-row mt-2" id="productos">
        <div class="card w-full">
            <div class="card-body">
                <h5>Informacion de todos los productos</h5>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Categoria</th>
                        <th scope="col">Descripciòn</th>
                        <th scope="col">Acciòn</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="prod in prods">
                            <th scope="row">{{prod.id}}</th>
                            <td>{{prod.title}}</td>
                            <td>{{prod.category_id}}</td>
                            <td>ver descripcion</td>
                            <td class="w-10 justify-content-end">
                                <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                    <button type="button" class="btn btn-danger">Borrar</button>
                                    <button type="button" class="btn btn-success">Ver</button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

    let productos = new Vue({
        el: "#productos",
        data: {
            prods :[],
            btn: 1,
            btn2: 0,
            paises : [],
            producto :[],
            atributos : [],
            active_pais : 'MCO',
            active_ctg : '',
            card_categoria : false,
            card_atributo : false,
            activeaux2: false,
            ultimoDato: [],

            id_producto: '', //id del producto agregado
            title : '', //nombre del producto
            price: '',  //precio del producto
            active_ctg : '',    // id de la categoria del producto
            available_quantity : '',    // cantidad disponibles del producto
            days: '',   //dias disponibles del producto
            seller_custom_field: '',    //SKU del producto
            imagenes: [], // imagenes del producto
            categorias : [], //categorias del producto;
            url: '',
            sale_terms: [],
            get_atributos: [],  
            description: '',

            error_list: [],
            alert_list: []
        },

        mounted() {
            this.getProductos();
        },

        
        methods: {
            getProductos() {
                $.ajax({
                    type: "GET",
                    url: "<?php echo base_url('mercadolibre/producto/listar'); ?>",
                    dataType: "JSON",
                    success: function(resp) {
                        productos.prods = resp;
                        console.log(resp);
                        // productos.paises = resp;
                    }
                });
            },

            type_input(type) {
                if (type == 'string') {
                    return 'text'
                }
                if (type == 'number' || type == 'number_unit') {
                    return 'number'
                }
                if (type == 'list') {
                    return 'select'
                }
            },

            validated_campos(valiadate_campos) {
                for (var i = 0; i < valiadate_campos.length; i++) {
                    if (valiadate_campos[i] == 'catalog_required' || valiadate_campos[i] == 'required') {
                        return true
                    } else {
                        return false
                    }
                };
            },

            setDescripcion(){
                productos.id_producto = 'MCO967251453';
                if(productos.id_producto){
                    if(productos.description == ''){ Swal.fire('informacion!','El campo de la descripcion no puede ir vacio!','info'); return; }
                    $.ajax({
                        type: "post",
                        url: "<?= base_url('mercadolibre/item/agg'); ?>/" + productos.id_producto,
                        data: {
                            'plain_text': productos.description,
                        },
                        dataType: "json",
                        success: function(response) {
                            console.log(response);
                            if(response.error){
                                swal.fire('advertencia', response.message, 'warning');
                                return;
                            }
                            Swal.fire('proceso completado!','Se agrego la descripcion del producto correctamente!','success');
                        }
                    });    
                }  
            },
    
            updateDescripcion(){
                productos.id_producto = 'MCO967251453';
                if(productos.id_producto){
                    if(productos.description == ''){ Swal.fire('informacion!','El campo de la descripcion no puede ir vacio!','info'); return; }
                    $.ajax({
                        type: "post",
                        url: "<?= base_url('mercadolibre/item/update'); ?>/" + productos.id_producto,
                        data: {
                            'plain_text': productos.description,
                        },
                        dataType: "json",
                        success: function(response) {
                            console.log(response);
                            if(response.error){
                                swal.fire('advertencia', response.message, 'warning');
                                return;
                            }
                            Swal.fire('proceso completado!','Se actualizo la descripcion del producto correctamente!','success');
                        }
                    });    
                }  
            },
                
            
            delete_item(id){
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "GET",
                            url: "<?php echo base_url('mercadolibre/productos/delete'); ?>/" + id,
                            dataType: "JSON",
                            success: function(resp) {
                                Swal.fire( 'Eliminado!', resp.msg, 'success' )
                            }
                        });

                        
                    }
                });
            }

        },
    })
</script>