<div class="card w-100 mt-4">
    <div class="card-body">
        <h4 class="card-title">Categorias del producto <small class="text-muted h6">Todas las categoria a las que pertenece el producto</small></h4>
        <div class="mx-1 ">
        <div class="container w-full h-80 mt-3 pb-1 min-w-full max-w-screen-sm container-x-scroll d-flex">
                <div class="mx-2 max-100 container-y-scroll pe-1" v-if="categorias.length" v-for="(categoria, indice) in categorias">
                    <ol class="list-group">
                        <li v-for="ct in categoria" :class="(active_ctg==ct.id) ? 'active' : ''" :key="ct.id" @click="get_sub(ct.id, indice)" class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">{{ct.name}}</div>
                                {{ct.id}}
                            </div>
                        </li>
                    </ol>
                </div>

                <div class="mx-2 max-100 h-10" v-if=" ultimoDato != '' ">
                    <ol class="list-group">
                        <li :class="(active_ctg==ultimoDato.id) ? 'active' : ''"  @click="getAtributosrequerido(ultimoDato.id)" class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">{{ultimoDato.name}}</div>
                                {{ultimoDato.id}}
                            </div>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>