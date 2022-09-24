<div class="mt-4" v-if="card_atributo">
    <div class="card w-100">
        <div class="card-body">
            <h4 class="card-title">Atributos obligatorios de las categorias <small class="text-muted h6">Todos los atributos</small></h4>
            <div class="row mx-1 my-2" v-for="atributo in atributos" v-if="atributo.label == 'Características principales'">
                <!-- for principal -->
                <h5 class="card-title"> <i class="fa-solid fa-layer-group"></i> {{atributo.label}}</h5>
                <div class="col-lg-6 col-xl-4 d-flex align-content-stretch" v-for="com in atributo.components">
                    <!-- segundo for -->
                    <div v-for="atr in com.attributes" class="w-100 me-2 mb-2">
                        <label class="form-label w-100">{{atr.name}}  <small class="" v-for="config in com.ui_config.hint">{{config}}</small> </label>
                        <select  v-if="atr.value_type == 'list' || atr.value_type == 'boolean'"   class="form-select" :name="atr.id" :id="atr.id+atr.name">
                            <option disabled value="">Seleccione un {{atr.name}}</option>
                            <option v-for="value in atr.values" :value="value.name"> {{value.name}} </option>
                        </select>
                        <input v-if="atr.value_type == 'string'" :list="atr.id" type="text" class="form-control" placeholder="" :name="atr.id" :id="atr.id+atr.name"> 
                        <input v-if="atr.value_type == 'number'" type="number" class="form-control" :name="atr.id" :id="atr.id+atr.name"> 
                        <datalist :id="atr.id" v-if="atr.value_type == 'string'">
                            <option v-for="value in atr.values"> {{value.name}} </option>
                        </datalist>
                        <div v-if="atr.value_type == 'number_unit'" class="input-group mb-3">
                            <input type="text" class="form-control w-80" :id="atr.id+atr.name" :name="atr.id">
                            <select v-if="atr.units != ''" class="form-select" :id="atr.id+'-unit'">
                                <option disabled value="">Seleccione un elemento</option>
                                <option v-for="unit in atr.units" :value="unit.name"> {{unit.name}}</option>
                            </select>
                        </div>
                        <small class="text-small-danger text-danger"> {{validated_campos(com.attributes[0]['tags']) ? 'Campo requerido*' : ''}} </small> <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>