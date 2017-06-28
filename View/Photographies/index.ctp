<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Fotografías
            </div>
            <div class="dataTable_wrapper">
                <h3>Fotografías</h3>
                <div>
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th style="width: 5%">ID</th>
                                <th style="width: 50%">Comentarios</th>
                                <th class="sorter-false" style="width: 15%"></th>
                                <th class="sorter-false" style="width: 15%"></th>
                                <th class="sorter-false" style="width: 15%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($Photographies as $Photografy): ?>
                                <?php
                                $rutaDocumento = APP . "webroot" . DS . "files" . DS . "Seguimiento" . DS . "Fotografia-" . $Photografy['Photography']['id'] . ".jpg";
                                ?>
                                <tr>
                                    <td><?php echo $Photografy['Photography']['id']; ?></td>
                                    <td><?php echo $Photografy['Photography']['comentario']; ?></td>
                                    <td>
                                        <?php
                                        if (file_exists($rutaDocumento)) {
                                            echo $this->Html->link('  Imagen ', '..' . DS . "files" . DS . "seguimiento" . DS . "Fotografia-" . $Photografy['Photography']['id'] . ".jpg", array('target' => 'blank', 'indicator' => 'loading', 'class' => 'btn btn-info fa fa-file-image-o', 'download' => "FotografíaVisita-" . $aleatorio . ".jpg"));
                                        }
                                        ?>
                                    </td>
                                    <td><?php echo $this->Ajax->link(' Editar', array('controller' => 'Photographies', 'action' => 'edit', $Photografy['Photography']['id']), array('class' => 'btn btn-success fa fa-pencil', 'update' => 'content', 'indicator' => 'loading'));?></td>
                                    <td><?php echo $this->Ajax->link(' Eliminar', array('controller' => 'Photographies', 'action' => 'delete', $Photografy['Photography']['id'], $Photografy['Photography']['visit_id']), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-danger fa fa-trash'), '¿Realmente desea borrar la fotografía?'); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>  
                <br><br><br>
                <?php
                    echo $this->Ajax->link(' Adicionar', array('controller' => 'Photographies', 'action' => 'add', $visit_id), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-success fa fa-plus-square-o'));
                ?>
            </div>
        </div>
    </div>
</div>