
<table id="tabla" class="tabla" width="100%">
    <thead>
        <tr>
            <th>Username</th>
            <th>Nombre</th>
            <th>Primer apellido</th>
            <th colspan="3">
    <form style="clear: both" >
        <table border="0" cellspacing="0" cellpaddding="0" style="width: 200px;height: 20px; padding: 0px 0px 0px 0px">
            <tr>
                <td ><input type="text"  name="data[User][busqueda]" style="width: 130px" ></td>
                <td ><?php echo $this->Ajax->submit('Buscar', array('url' => array('controller' => 'Users', 'action' => 'list_users'), 'update' => 'content', 'indicator' => 'loading')); ?></td>
            </tr>
        </table>
    </form>
</th>
</tr>
</thead>
<tbody>
    <?php foreach ($User as $usuario): ?>
        <tr>
            <td><?php echo $usuario['User']['username'] ?> </td>
            <td><?php echo $usuario['User']['nombre'] ?></td>
            <td><?php echo $usuario['User']['primer_apellido'] ?></td>
            <td><?php echo $this->Ajax->link("Proyectos asignados", array('controller' => "UserProyects", "action" => "index", $usuario['User']['id']), array('update' => 'content','indicator' => 'loading')) ?></td>
            <td><?php echo $this->Ajax->link("editar", array('controller' => "Users", "action" => "edit", $usuario['User']['id']), array('update' => 'content', 'indicator' => 'loading')) ?></td>
            <td><?php echo $this->Ajax->link($this->Html->image("delete.png", array('width' => '30', 'heigth' => '30', 'alt' => 'Adicionar usuario')), array('controller' => "Users", "action" => "delete", $usuario['User']['id']), array('update' => 'content', 'complete' => 'cargar()', 'indicator' => 'loading', 'escape' => false), '¿Esta seguro de eliminar el usuario? ') ?></td>
        </tr>
    <?php endforeach; ?>
</tbody>
</table>
<?php echo "<br>"; ?>
<?php echo $this->Ajax->link($this->Html->image("user_add.png", array('width' => '30', 'heigth' => '30', 'alt' => 'Adicionar usuario')), array('controller' => 'Users', 'action' => 'add_users'), array('update' => 'content', 'indicator' => 'loading', 'escape' => false)); ?>