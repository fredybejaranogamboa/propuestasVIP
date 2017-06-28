<?php echo $this->Session->flash(); ?>
<table class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th>Usuario</th>
            <th>Código</th>
            <th>Convocatoria</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($asignados as $asignado): ?>
            <tr>
                <td><?php echo $asignado['User']['username'] ?> </td>
                <td><?php echo $asignado['Proyect']['codigo'] ?> </td>
                <td><?php echo $asignado['Call']['nombre'] ?> </td>
                <td><?php echo $this->Ajax->link(' Eliminar', array('controller' => 'UserProyects', 'action' => 'delete', $asignado["UserProyect"]["id"], $user_id), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-danger fa fa-trash'), '¿Desea eliminar la asignación?'); ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php
echo $this->Ajax->link("  Adicionar", array('controller' => 'UserProyects', "action" => "add", $user_id), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-success fa fa-plus-square-o'));
?>