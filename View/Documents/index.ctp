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
                    <?php echo $this->Ajax->link(' Eliminar', array('controller' => 'Documents', 'action' => 'delete', $Document['Document']['id'], $Document['Document']['entity_id'], $Document['Document']['foreign_id'], $Document['Document']['document_type_id']), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-danger fa fa-trash'), '¿Realmente desea borrar el documento?'); ?>
                </td>
                <td>
                    <?php
                    if (file_exists("../webroot/files/".$nombre_entidad."/".$Document['Document']['document_type_id']. "_" . $foreign_id . "_" . $Document['Document']['id'] . ".".$Document['DocumentType']['extension']))
                        echo $this->Html->link('  Adjunto', "../webroot/files/".$nombre_entidad."/".$Document['Document']['document_type_id']. "_" . $foreign_id . "_" . $Document['Document']['id'] . ".".$Document['DocumentType']['extension'], array('target' => 'blank', 'indicator' => 'loading', 'class' => 'btn btn-info fa fa-file-pdf-o', 'download' => "Documento-" . $aleatorio . ".".$Document['DocumentType']['extension']));
                    ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<br><br><br>
<?php
echo $this->Ajax->link(' Adicionar', array('controller' => 'Documents', 'action' => 'add', $foreign_id, $entity_id), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-success fa fa-plus-square-o'));
?>