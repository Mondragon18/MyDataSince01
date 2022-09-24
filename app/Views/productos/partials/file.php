<div class="card w-100 mt-4">
    <div class="card-body">
        <h4 class="card-title">Imagenes del producto <small class="text-muted h6"> Incluyen imagenes del producto</small></h4>
        <div class="mx-1 my-2">
            <div class="input-group">
                <div class="form-floating">
                    <input type="search" class="form-control" v-model="url" placeholder="Ingrese el url de la imagen" @keyup.enter="setImagen()">
                    <label for="floatingInput">Url de la imagen</label>
                </div>
                <button class="btn btn-outline-secondary" type="button" @click="setImagen()">agregar</button>
                
            </div>

            <div class="container w-full h-32 min-w-full max-w-screen-sm container-x-scroll d-flex mt-2">
                <div class="position-relative pt-4 me-4 mb-2" v-for="(ims, indice) in imagenes">
                    <span @click="deleteImagen(ims.source)" class="position-absolute top-3 right-3 start-100 translate-middle badge rounded-pill bg-danger" v-if="imagenes != ''">
                        <i class="fa-solid fa-xmark"></i>
                    </span>
                    <img :src="ims.source" class="rounded me-2 w-24 h-24 object-center object-cover border ">
                </div>
            </div>
        </div>
    </div>
</div>