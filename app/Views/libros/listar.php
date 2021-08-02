<?=$cabecera?>
    <h1>Lista de libros</h1>
    <? if(session('mensaje'))?>
    <div class="alert alert-danger" role="alert">
        <?php echo session('mensaje')?>
    </div>
    <? endif  ?>
    <div class="container">
        <div class="btn-group" role="group" aria-label="Button group">
            <button class="btn btn-primary" type="button" id="crear">Crear</button>
        </div>
        <table class="table table-light">
            <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>Imagen</th>
                    <th>Nobre</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($libros as $libro):?>

                <tr>
                    <td><?=$libro['id']?></td>
                    <td><img class="img-thumbnail" src="<?=base_url()?>/uploads/<?=$libro['imagen']?>" width="100" alt="img"></td>
                    <td><?=$libro['nombre']?></td>
                    <td>
                        <a class="btn btn-warning" type="button" href="#" onclick="editar(<?=$libro['id']?>, '<?=$libro['nombre']?>', '<?=$libro['imagen']?>')">Editar</a>
                        <a class="btn btn-danger" type="button" href="<?=base_url('borrar/'.$libro['id'])?>">Borrar</a>
                    </td>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>

    <div id="my-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="my-modal-title">Crear</h5>
                    <button class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="guardar" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="Nombre">Nombre</label>
                            <input id="Nombre" class="form-control" type="text" name="nombre" value="<?=old('nombre')?>">
                        </div>
                        <div class="form-group">
                            <label for="imagen">Imagen</label>
                            <input id="imagen" class="form-control-file" type="file" name="imagen">
                        </div>
                        <button class="btn btn-primary" type="submit">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="my-modal-editar" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="my-modal-title">Editar</h5>
                    <button class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="<?=base_url('editar')?>" enctype="multipart/form-data" id="form_edit">
                        <input type="hidden" id="id_edit" name="id">
                        <div class="form-group">
                            <label for="Nombre_edit">Nombre</label>
                            <input id="Nombre_edit" class="form-control" type="text" name="nombre">
                        </div>
                        <img class="img-thumbnail" src="" width="100" alt="img" id="img_src">
                        <div class="form-group">
                            <label for="imagen_edit">Imagen</label>
                            <input id="imagen_edit" class="form-control-file" type="file" name="imagen">
                        </div>
                        <button class="btn btn-primary" type="submit">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <script>
        $("#crear").on("click", function () {
            $("#my-modal").modal("show");
        })
        function editar(id,nombre, imagen) {
            $("#id_edit").val(id);
            $("#Nombre_edit").val(nombre);
            $("#img_src").prop("src", "<?=base_url()?>/uploads/"+imagen)
            $("#my-modal-editar").modal("show");
        }
    </script>
<?=$pie?>
