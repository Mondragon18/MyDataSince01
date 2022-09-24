<div class="card mt-3">
    <div class="card-body">
        <h4 class="card-title">
            Datos del producto
            <small class="text-muted h6">
                <a :href="producto.permalink" class="text-muted h6" target="_blank" v-if="producto.id">
                    {{producto.title}} ({{producto.id}})
                </a>
            </small>
        </h4>
        <div class="mx-1 my-2">

            <div>
                <input type="hidden" v-model="active_pais">
                <div class="input-group">
                    <select class="form-select w-20" id="inputGroupSelect04" aria-label="Example select with button addon">
                        <option selected>Buscar por</option>
                        <option value="name">Nombre</option>
                        <option value="id">ID del producto</option>
                    </select>
                    <div class="form-floating w-75">
                        <input type="search" required class="form-control" v-model="title" placeholder="Ingrese el nombre del producto" @keyup.enter="busqueda()">
                        <label for="floatingInput">Nombre del producto</label>
                    </div>
                    <button class="btn btn-outline-secondary" type="button" @click="busqueda()">Buscar</button>
                </div>
            </div>

            <div v-if="error_list != []" class="col-12 mt-3">
                <div v-for="err in error_list" class="alert alert-danger" role="alert">
                    {{err.message}}
                </div>
            </div>

            <div class="row mt-4">
                <div class="form-floating col-12 col-xl-4 col-xxl-3 mt-2">
                    <input type="number" class="form-control" v-model="price" placeholder="1000">
                    <label for="floatingInput" class="ms-3">Precio</label>
                </div>
                <div class="form-floating col-12 col-xl-4 col-xxl-3 mt-2">
                    <input type="text" class="form-control" v-model="active_ctg" placeholder="MC01234235">
                    <label for="floatingInput" class="ms-3">codigo de la categoria</label>
                </div>
                <div class="form-floating col-12 col-xl-4 col-xxl-2 mt-2">
                    <input type="number" class="form-control" v-model="available_quantity" placeholder="20">
                    <label for="floatingInput" class="ms-3">cantidad disponible</label>
                </div>
                <div class="form-floating col-12 col-xl-4 col-xxl-2 mt-2">
                    <input type="text" class="form-control" v-model="days" placeholder="9">
                    <label for="floatingInput" class="ms-3">dias de disponibilidad</label>
                </div>

                <div class="form-floating col-12 col-xl-4 col-xxl-2 mt-2">
                    <input type="string" class="form-control" v-model="seller_custom_field" placeholder="SKU">
                    <label for="floatingInput" class="ms-3">SKU</label>
                </div>
            </div>

        </div>
    </div>
</div>