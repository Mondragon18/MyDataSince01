<?= $cabecera ?>
<div class="flex">
    <h1>Informacion de categorias por paises (jquery)</h1>
</div>

<div class="d-flex justify-content-start w-full">

    <div class="mx-2" style="width: 15rem;">
        <h5>Paises</h5>
        <ol class="list-group list-group-numbered" id="paises"></ol>
    </div>

    <div class="mb-2" style="width: 15rem;">
        <h5>Categorias</h5>
        <ol class="list-group list-group-numbered" id="categorias"></ol>
    </div>

    <div class="mb-2">
        <div class="d-flex" id="detalles"></div>
    </div>

</div>

<script src="https://code.jquery.com/jquery-3.6.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(function() {

        getPaises();

        function getPaises() {
            $.ajax({
                type: "GET",
                url: "<?php echo base_url('mercadolibre/paises/listar/jquery'); ?>",
                dataType: "JSON",
                timeout: 500,
                success: function(resp) {
                    $("#paises").html(resp.message);
                }
            });
        }

        $(document).delegate('.btn-selecc-pais', 'click', function(e) {
            e.preventDefault();
            const id = $(this).attr('id');

            $.ajax({
                type: 'post',
                url: "<?php echo base_url('mercadolibre/categoria/listar/jquery'); ?>",
                data: {
                    'id': id
                },
                timeout: 500,
                dataType: "JSON",
                success: function(resp) {
                    $("#categorias").html(resp.message);
                }
            });
        });

        $(document).delegate('.btn-selecc-ctg', 'click', function(e) {
            e.preventDefault();
            const id = $(this).attr('id');
            $.ajax({
                type: 'post',
                url: "<?php echo base_url('mercadolibre/categoria/detalle/jquery'); ?>",
                data: {
                    'id': id
                },
                timeout: 500,
                dataType: "JSON",
                success: function(resp) {
                    console.log(resp);
                    $("#detalles").html(resp.message);
                }
            });
        });

    });
</script>