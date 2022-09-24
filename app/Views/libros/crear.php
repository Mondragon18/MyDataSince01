<?=$cabecera?>
    <div class="card text-left">
        <div class="card-body">
            <h4 class="card-title">Crear libros</h4>
            <a href="<?=base_url('libros/listar'); ?>"> Listado de libros</a>
        <div>
         
        <form action="<?=site_url('/libros/guardar') ?>" enctype="multipart/form-data" method="post" action="">
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" class="form-control" placeholder="nombre" aria-describedby="helpId">
            </div>
            <div class="form-group">
              <label for="">Imagen</label> <br>
              <input type="file" class="form-control-file" name="imagen" id="imagen" placeholder="Seleccione una imagen" aria-describedby="fileHelpId"> <br>
            </div>
            <br>

            <button type="submit" class="btn btn-success">Crear</button>
        </form>
        
    </div>
<?=$pie?>