<?php

echo $this->Session->flash(); ?>
<table id="tabla" class="tabla" >
    <thead>
        <tr>
            <th>ID </th>
            <th>Nombre</th>
            <th>Icono</th>
            <th>Orden</th>
            <th colspan="2">opciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($tabs as $tab): ?>
        <tr>
            <td><?php echo $tab['Tab']['id'] ?></td>
            <td><?php echo $tab['Tab']['titulo'] ?></td>
            <td><?php echo $tab['Tab']['icono'] ?></td>
            <td><?php echo $tab['Tab']['orden'] ?></td>
            <td><?php echo $this->Ajax->link("Editar", array("action" => "edit", $tab['Tab']['id']), array('update' => 'content', 'class' => 'acciones')); ?></td>
            <td><?php echo $this->Ajax->link("Borrar", array("action" => "delete", $tab['Tab']['id']), array('update' => 'content', 'class' => 'acciones'), '¿Está seguro de borrar el registro?'); ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<br><br>
<?php echo $this->Ajax->link("Adicionar Pestaña", array("action" => "add"), array('update' => 'content', 'class' => 'acciones')); ?>





