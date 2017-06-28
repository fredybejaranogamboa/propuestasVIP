<?php echo $this->Session->flash(); ?>
<h3>USUARIOS ASOCIADOS A LA DIRECCIÓN TERRITORIAL <?php echo $territorial ?></h3>
<div id="loading" style="display: none;">
    <?php echo $this->Html->image('loading.gif', array('border' => "0", 'align' => 'center')); ?>
</div>
<table class="table table-striped table-bordered table-hover" >
    <thead>
        <tr>
            <th>Usuario</th>
            <th>Nombre</th>
            <th>Borrar</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?php echo $user['User']['username'] ?></td>
                <td><?php echo $user['User']['nombre'] . " " . $user['User']['primer_apellido'] . " " . $user['User']['segundo_apellido'] ?></td>
                <td><?php echo $this->Ajax->link("Borrar", array('controller' => 'BranchUsers', "action" => "delete", $user['BranchUser']['id'], $branch_id), array('update' => 'content', 'class' => 'btn btn-danger fa fa-trash', 'indicator' => 'loading'), "¿Realmente desea borrar el registro?"); ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<br>
<br>
<table style="border: 1px solid" width="50%" align="center">
    <tbody>
        <tr>
            <td align="center">
                <?php echo $this->Ajax->link("Agregar usuario", array('controller' => 'BranchUsers', "action" => "add", $branch_id), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-success fa fa-plus-square-o')); ?>
            </td>
        </tr>
    </tbody>
</table>