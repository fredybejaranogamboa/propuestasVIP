<table class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th style="width: 5%">ID</th>
            <th style="width: 15%">Tipo documento</th>
            <th style="width: 10%">Comentario</th>
            <th colspan="3"></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($Documents as $Document): ?>
            <?php
            $rutaDocumento = APP . "webroot" . "/" . "files/resoluciones/" . "pdf";
            ?>
            <tr>
                <td><?php echo $Document['Document']['id']; ?></td>
                <td><?php echo $Document['DocumentType']['nombre']; ?></td>
                <td><?php echo $Document['Document']['comentario']; ?></td>
                <td>
                    <?php
                    echo $this->Ajax->link(' Editar', array('controller' => 'Documents', 'action' => 'edit', $Document['Document']['id']), array('class' => 'btn btn-success fa fa-pencil', 'update' => 'content', 'indicator' => 'loading'));
                    ?>
                </td>
                <td>
                    <?php echo $this->Ajax->link(' Eliminar', array('controller' => 'Documents', 'action' => 'delete', $Document['Document']['id'], $Document['Document']['property_id']), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-danger fa fa-trash'), '¿Realmente desea borrar el documento?'); ?>
                </td>
                <td>
                    <?php
                    if (file_exists("../webroot/files/DocumentosPredios/otroDocumento-" . $Document['Document']['id'] . ".pdf"))
                        echo $this->Html->link('  Adjunto', "../files/DocumentosPredios/otroDocumento-" . $Document['Document']['id'] . ".pdf", array('target' => 'blank', 'indicator' => 'loading', 'class' => 'btn btn-info fa fa-file-pdf-o', 'download' => "Documento-" . $aleatorio . ".pdf"));
                    ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<br><br><br>
<?php
echo $this->Ajax->link(' Adicionar', array('controller' => 'Documents', 'action' => 'add', $property_id), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-success fa fa-plus-square-o'));
?>