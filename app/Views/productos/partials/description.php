<div class="card w-100 mt-4">
    <div class="card-body">
        <h4 class="card-title">Descripcion del producto <small class="text-muted h6">Complementa lo detallado en la ficha técnica {{btn2}}</small></h4>
        <div class="form-floating">
            <textarea class="form-control" v-model="description" placeholder="Ingrese una descripccion sobre el producto" id="floatingTextarea2" style="height: 100px"></textarea>
            <label for="floatingTextarea2">Descripcion</label>
        </div>
        <div class="alert alert-warning mt-2" role="alert" v-if="alert_list.alert">
            {{alert_list.msg}}
        </div>
        <div class="d-grid gap-2 mt-3 d-md-flex justify-content-md-end">
            <button class="btn btn-primary me-md-2" type="button" @click="updateDescripcion()">
                <i class="fa-solid fa-pen-to-square"></i> Actualizar
            </button>
            <button class="btn btn-success" type="button" @click="setDescripcion()" v-if="btn2 == '0'">
                <i class="fa-solid fa-floppy-disk"></i> crear
            </button>
        </div>
    </div>
</div>