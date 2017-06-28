<?php echo $this->Session->flash(); ?>
<table class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th>ID </th>
            <th>Nombre</th>
            <th>Orden</th>
            <th>Icono</th>
            <th colspan="2">Icono</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($menus as $men): ?>
            <tr>
                <td><?php echo $men['Menu']['id'] ?></td>
                <td><?php echo $men['Menu']['nombre'] ?></td>
                <td><?php echo $men['Menu']['orden'] ?></td>
                <td><?php echo $men['Menu']['icono'] ?></td>
                <td><?php echo $this->Ajax->link(' Editar', array('controller' => 'Menus', 'action' => 'edit', $men['Menu']['id']), array('update' => 'content', 'class' => 'btn btn-success fa fa-pencil')) ?></td>
                <td><?php echo $this->Ajax->link(' Eliminar', array('controller' => 'Menus', 'action' => 'delete', $men['Menu']['id']), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-danger fa fa-trash'), '¿Esta seguro de borrar el menú?') ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<br><br>
<?php echo $this->Ajax->link(" Agregar Menu", array('controller' => "Menus", "action" => "add"), array('update' => 'content', 'class' => 'btn btn-success fa fa-plus-square-o')) ?>