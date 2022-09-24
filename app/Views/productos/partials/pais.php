<div class="me-3 w-100 w-xl-60 me-3">
    <h5>Paises</h5>
    <ol class="list-group container-y-scroll mt-3 h-96 pe-1">
        <li v-for="pais in paises" :class="('MCO'==pais.id) ? 'active' : ''" @click="selecc_pais(pais.id)" class="list-group-item d-flex justify-content-between align-items-start cursor-pointer list-group-item-action">
            <div class="ms-2 me-auto">
                <div class="fw-bold">{{pais.name}}</div>
                <small>{{pais.id}}</small>
            </div>
        </li>
    </ol>
</div>