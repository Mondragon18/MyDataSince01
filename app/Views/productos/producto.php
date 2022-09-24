<?= $cabecera ?>
<div class="mb-5">
    <h1>Busqueda de producto con sus categorias</h1>
    
    <div class="d-flex justify-content-start w-full flex-column flex-xl-row mt-2" id="productos">
        <div>
            <?= $this->include('productos/partials/pais') ?>
        </div>
        <div class="flex-grow-1  ms-1 mt-2">
            <h5>Informacion de productos</h5>
            <form action="javascript:void(0);" id="form_producto">
                <?= $this->include('productos/partials/form') ?>
                <?= $this->include('productos/partials/description') ?>
                <?= $this->include('productos/partials/file') ?>
                <?= $this->include('productos/partials/categoria') ?>           
                <?= $this->include('productos/partials/atributos') ?>
                <div class="d-grid gap-2 mt-3 d-md-flex justify-content-md-end">
                    <button class="btn btn-warning me-md-2" type="button" v-if="btn == 1" @click="delete_item()">delete</button>
                    <button class="btn btn-success" type="button" @click="publicar_item()" v-if="btn == 1">Publicar</button>
                </div>
            </form>
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
            this.get_all_paises();
            this.get_all_categorias('MCO');
        },

        
        methods: {
            
            get_all_paises() {
                $.ajax({
                    type: "GET",
                    url: "<?php echo base_url('mercadolibre/paises/listar'); ?>",
                    dataType: "JSON",
                    success: function(resp) {
                        productos.paises = resp;
                    }
                });
            },

            selecc_pais(id) {
                if (id) {   
                    productos.active_pais = id;
                    productos.categorias.splice(0, productos.categorias.length);
                    productos.get_all_categorias(id);
                }
            },

            get_all_categorias(id) {
                $.ajax({
                    type: "get",
                    url: "<?php echo base_url('mercadolibre/categoria/listar'); ?>/"+ id,
                    dataType: "JSON",
                    success: function(response) {
                        productos.categorias.push(response);
                    }
                });
            },

            get_sub(id, indice) {
                $.ajax({
                    type: "get",
                    url: "<?php echo base_url('mercadolibre/categoria/detalle/listar'); ?>/" +id,
                    dataType: "JSON",
                    success: function(response) {
    
                        if(response.id){
                            productos.ultimoDato = response;
                            productos.categorias.splice(indice+1, productos.categorias.length);
                            productos.getAtributosrequerido(response.id);
                        }else{
                            productos.categorias.splice(indice+1, productos.categorias.length);
                            productos.categorias.push(response);
                            productos.activeaux2 = true;
                        }
                    }
                });
                productos.active_ctg = id;
            },

            busqueda() {

                if (productos.title == "") { return; }
                if (productos.active_pais == "") { productos.active_pais = 'MCO' }

                url = "<?php echo base_url('mercadolibre/productos/categorias/listar'); ?>";
                $.ajax({
                    type: 'post',
                    url: url,
                    data: {
                        'pais': productos.active_pais,
                        'name': productos.title,
                    },
                    dataType: "JSON",
                    success: function(resp) {
                        productos.producto = resp.producto;
                        productos.card_categoria = true;
                        productos.title = resp.producto.title;
                        productos.price = resp.producto.price;
                        productos.available_quantity = resp.producto.available_quantity;
                        resp.producto.sale_terms.forEach(data => {
                            if( data.id == 'MANUFACTURING_TIME' ){ productos.days = data.value_struct.number }
                        })
                        productos.seller_custom_field = resp.producto.seller_custom_field;
                        productos.imagenes = [];
                        resp.producto.pictures.forEach(data =>{
                            productos.imagenes.push({
                                'source': data.url
                            });
                        });
                        productos.categorias.splice(1, productos.categorias.length);
                        cont = 0;
                        resp.categorias.forEach(data => {
                            productos.get_sub(data.id, cont);
                            cont = cont + 1;
                        });

                        if(resp.description.alert == 'error'){
                            productos.description = '';s
                            productos.alert_list = resp.description;
                        }else{
                            productos.description = resp.description.plain_text;
                            productos.alert_list = '';
                        }
                    }
                });             
                
            },

            setImagen(){
                if (productos.url == "") { return; }
                productos.imagenes.push({ 'source': productos.url });
                productos.url = '';
            },  //ingresar url de la imagen

            deleteImagen(url){
                if (url == "") { return; }
                productos.imagenes = productos.imagenes.filter((item) => item.source !== url  );
            }, //eliminar url de la imagen

            getAtributosrequerido(id) {
                if (id) {
                    productos.active_ctg = id;
                    url = "<?php echo base_url('mercadolibre/productos/categorias/atributos'); ?>/" + id;
                    $.ajax({
                        type: "GET",
                        url: url,
                        dataType: "JSON",
                        success: function(resp) {
                            productos.atributos = resp;
                            productos.card_atributo = true;
                        }
                    });
                }
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

            publicar_item(){

                productos.error_list = [];
                productos.sale_terms = [];
                
                var formData = new FormData($("#form_producto")[0]);
                productos.get_atributos = [];
                for (let [name, value] of formData) {
                    let unit = $('#' + name + '-unit').val()
                    if(unit){
                        productos.get_atributos.push({ 'id': name, 'value_name': value + ' ' + unit })
                    } else if (value){
                        productos.get_atributos.push({ 'id': name, 'value_name': value })
                    }
                }

                if(productos.days){
                    productos.sale_terms.push({ 'id': 'MANUFACTURING_TIME', 'value_name': productos.days +' dias' });
                }

                $.ajax({
                    type: "post",
                    url: "<?= base_url('mercadolibre/productos/publicar'); ?>",
                    data: {
                        'title': productos.title,
                        'price': productos.price,
                        'category_id': productos.active_ctg,
                        'available_quantity': productos.available_quantity,
                        'id_pais': productos.active_pais,
                        'sale_terms': productos.sale_terms,
                        'seller_custom_field': productos.seller_custom_field,
                        'pictures': productos.imagenes,
                        'attributes': productos.get_atributos
                    },
                    dataType: "json",
                    success: function(response) {
                        if(response.error){
                            swal.fire('advertencia', response.message, 'warning');
                        }
                        if(response.error){
                            response.cause.forEach(data => {
                                productos.error_list.push(data);
                            });
                            return;
                        }
                        productos.id_producto = response.id;
                        productos.btn2 = 1;
                        Swal.fire('proceso completado!','Se publico el producto correctamente!','success');
                    }
                });

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