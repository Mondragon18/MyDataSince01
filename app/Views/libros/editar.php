<?=$cabecera?>
    <div class="card text-left">
        <div class="card-body">
            <h4 class="card-title">Editar libros</h4>
            <a href="<?=base_url('libros/listar'); ?>"> Listado de libros</a>
        <div>
         
        <form action="<?=site_url('/libros/actualizar') ?>" enctype="multipart/form-data" method="post" action="">
        <input type="hidden" name="id" value="<?=$libro['id']?>">   
        <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" value="<?=$libro['nombre']?>" id="nombre" class="form-control" placeholder="nombre" aria-describedby="helpId">
            </div>
            <div class="form-group">
              <label for="">Imagen</label> <br>
              <img src=" <?=base_url()?>/uploads/<?=$libro['imagen'];?>" class="img-thumbnail" width="100" alt="">

              <input type="file" class="form-control-file" name="imagen" id="imagen" placeholder="Seleccione una imagen" aria-describedby="fileHelpId"> <br>
              
            </div>
            <br>
            <button type="submit" class="btn btn-success">Actualizar</button>
        </form>
        
    </div>
<?=$pie?>