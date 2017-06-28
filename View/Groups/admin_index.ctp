<table  id="tabla" class="tabla" >

    <thead>
        <tr>
            <th>ID</th>
            <th>NOMBRE</th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <?php foreach ($group as $usuario): ?>
        <tbody>
            <tr>
                <td><?php echo $usuario['Group']['id'] ?></td>
                <td><?php echo $usuario['Group']['name'] ?></td>
                <td><?php echo $this->Ajax->link("editar", array('controller' => 'Groups', "action" => "edit", $usuario['Group']['id']),array('update'=>'content')) ?></td>
                <td><?php echo $this->Ajax->link("Asignar menus", array('controller' => 'GroupsItems', "action" => "edit", $usuario['Group']['id']),array('update'=>'content')) ?></td>
                <td><?php echo $this->Ajax->link("Asignar tabs", array('controller' => 'GroupsTabs', "action" => "edit", $usuario['Group']['id']),array('update'=>'content')) ?></td>
          
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php echo $this->Ajax->link("Agregar grupo", array("controller" => "Groups", "action" => "add"), array("update" => "content")) ?>
