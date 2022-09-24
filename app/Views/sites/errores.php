     <!-- <div class="mx-2 max-100" v-if="subs.length" v-for="subs in categorias">
            <h5>Sub-categorias</h5>
            <ol class="list-group">
                <li class="list-group-item d-flex justify-content-between align-items-start" v-for="sub in subs" :key="sub.id" @click="get_sub(sub.id)">
                    <div class="ms-2 me-auto">
                        <div class="fw-bold">{{sub.name}}</div>
                        {{sub.id}}
                    </div>
                </li>
            </ol>
        </div> -->


        <!-- <div class="mx-2 max-100">
            <div class="d-flex ">
                <div class="mx-2">
                    <h5 :class="(activeaux2==true) ?'visible': 'invisible'">subcategorias</h5>
                    <ol class="list-group" :class="(activeaux2==true) ? 'global': ''">
                        <li class="list-group-item d-flex justify-content-between align-items-start"v-for="subss in subs" :key="subCategoria.id">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">{{subss.name}}</div>
                                {{subss.id}}
                            </div>
                        </li>
                    </ol>
                </div>

                <div class="mx-2" v-if="detalle.name">
                    <h6>Informacion general</h6>
                    <div class="card mt-3" style="width: 30rem;">
                        <img :src="image" alt="" class="w-50 p-3 h-25 mx-auto">
                        <div class="card-body">
                            <h5 class="card-title">{{detalle.name}}</h5>
                            <h6 class="card-subtitle mb-2 text-muted">Total categorias: {{detalle.total_items_in_this_category}}</h6>
                            <a :href="detalle.permalink" target="_blank" class="card-link">{{detalle.permalink}}</a>
                            <p class="card-text"><small class="text-muted">{{detalle.date_created}}</small></p>
                        </div>
                    </div>
                </div>

            </div>
        </div> -->

        <!-- get_sub(id) {
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url('mercadolibre/categoria/detalle/listar'); ?>",
                    data: {
                        'id': id
                    },
                    timeout: 500,
                    dataType: "JSON",
                    success: function(response) {
                        if(response){
                            categorias.categorias.push(response);
                            categorias.activeaux2 = true;
                        }else{
                            alert('no hay registro')
                        }
                    }
                });
                categorias.active_categoria = id;
            }, -->

