<?=$cabecera?>

    <div class="flex">
        <h1>Listar libros</h1>
        <a class="btn btn-success" href="<?=base_url('libros/crear'); ?>"> Crear un libro </a>
    </div>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Imagen</th>
                        <th>Nombre</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($libros as $libro): ?>
                        <tr>
                            <td> <?=$libro['id']; ?> </td>
                            <td>
                                <img src=" <?=base_url()?>/uploads/<?=$libro['imagen'];?>" class="img-thumbnail" width="100" alt="">
                            </td>
                            <td> <?=$libro['nombre'];  ?> </td>
                            <td>
                                <a href="<?=base_url('libros/editar/'.$libro['id']);?>" class="btn btn-info" type="button">Editar</a> 
                                <a href="<?=base_url('libros/borrar/'.$libro['id']);?>" class="btn btn-danger" type="button">Eliminar</a> 
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
<?=$pie?>
