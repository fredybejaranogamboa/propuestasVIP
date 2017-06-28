<?php echo $this->Session->flash(); ?>
<table class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th>id</th>
            <th>Nombre</th>
            <th>Alias</th>
            <th>Orden</th>
            <th>Menu</th>
            <th colspan="2">Opciones</th>

        </tr>
    </thead>
    <tbody>
        <?php foreach ($items as $item): ?>
        <tr>
            <td><?php echo $item['Item']['id'] ;?></td>
            <td><?php echo $item['Item']['nombre'] ?></td>
            <td><?php echo $item['Item']['alias'] ?></td>
            <td><?php echo $item['Item']['orden'] ?></td>
            <td><?php echo $item['Menu']['nombre'] ?></td>
            <td><?php echo $this->Ajax->link(' Editar', array('controller' => 'Items', 'action' => 'edit', $item['Item']['id']), array('update' => 'content', 'class' => 'btn btn-success fa fa-pencil')) ?></td>
            <td><?php echo $this->Ajax->link(' Eliminar', array('controller' => 'Items', 'action' => 'delete', $item['Item']['id']), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-danger fa fa-trash'), '¿Esta seguro de borrar el itém?') ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<br><br>
<?php echo $this->Ajax->link(" Agregar itém", array('controller' => "Items", "action" => "add"), array('update' => 'content', 'class' => 'btn btn-success fa fa-plus-square-o')) ?>