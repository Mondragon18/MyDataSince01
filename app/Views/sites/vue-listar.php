<?= $cabecera ?>
<div class="flex">
    <h1>Informacion de categorias por paises</h1>
</div>

<div class="container-x-scroll">
    <div class="d-flex justify-content-start w-full" id="paises">

        <div class="mx-2 max-100">
            <h5>Paises</h5>
            <ol class="list-group global">
                <li v-for="pais in paises" :class="(active_pais==pais.id) ? 'active' : ''" @click="get_all_categorias(pais.id)" class="list-group-item d-flex justify-content-between align-items-start cursor-pointer list-group-item-action">
                    <div class="ms-2 me-auto">
                        <div class="fw-bold">{{pais.name}}</div>
                        <small>{{pais.id}}</small>
                    </div>
                </li>
            </ol>
        </div>

        <div class="mx-2 max-100" v-if="categorias.length" v-for="(categoria, indice) in categorias">
            <h5>Categorias</h5>
            <ol class="list-group global">
                <li v-for="ct in categoria" :class="(active_categoria==ct.id) ? 'active' : ''" :key="ct.id" @click="get_sub(ct.id, indice)" class="list-group-item d-flex justify-content-between align-items-start">
                    <div class="ms-2 me-auto">
                        <div class="fw-bold">{{ct.name}}</div>
                        {{ct.id}}
                    </div>
                </li>
            </ol>
        </div>

        <div class="mx-2 max-100" v-if="ultimoDato">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">{{ultimoDato}}</h5>
                </div>
            </div>
        </div>

    </div>
</div>


<script src="/assets/js/jquery-3.6.0.min.js"></script>
<!-- <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>

<script> 
    let categorias = new Vue({
        el: "#paises",
        data: {
            paises: [],
            categorias: [],
            ultimoDato:'',
            active_pais: '',
            active_categoria: '',
        },

        mounted() {
            this.get_all_paises();
        },

        methods: {
            get_all_paises() {
                $.ajax({
                    type: "GET",
                    url: "<?php echo base_url('mercadolibre/paises/listar'); ?>",
                    dataType: "JSON",
                    success: function(resp) {
                        categorias.paises = resp;
                    }
                });
            },

            get_all_categorias(id) {
                $.ajax({
                    type: "get",
                    url: "<?php echo base_url('mercadolibre/categoria/listar'); ?>/"+ id,
                    dataType: "JSON",
                    success: function(response) {
                        console.log(response);
                        // categorias.categorias.splice(3, categorias.categorias.length);
                        categorias.categorias.push(response);
                        categorias.activeaux1 = true;
                    }
                });
                categorias.active_pais = id;
            },

            get_sub(id, indice) {
                $.ajax({
                    type: "get",
                    url: "<?php echo base_url('mercadolibre/categoria/detalle/listar'); ?>/" +id,
                    dataType: "JSON",
                    success: function(response) {
                        if(response.id){
                            categorias.ultimoDato = response.id;
                        }else{
                            categorias.categorias.splice(indice+1, categorias.categorias.length);
                            categorias.categorias.push(response);
                            categorias.activeaux2 = true;
                        }
                    }
                });
                categorias.active_categoria = id;
            },
        },


    })
</script>