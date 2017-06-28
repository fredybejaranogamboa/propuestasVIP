<?php echo $this->Session->flash(); ?>
<table class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Departamento</th>
            <th>Divipol</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
<?php foreach ($Cities as $City):?>
        <tr>
            <td><?php echo $City['City']['name']; ?></td>
            <td><?php echo $City['Departament']['name']; ?></td>
            <td><?php echo $City['City']['divipol']; ?></td>
            <td><?php echo $this->Ajax->link('Editar', array('controller'=>'Cities','action'=>'edit',$City["City"]["id"]),array('update'=>'content','indicator'=>'loading', 'class'=>'btn btn-success fa fa-pencil')); ?></td>
        </tr>
<?php endforeach;?>
    </tbody>
</table>
<br><br>
<?php echo $this->Ajax->link(" Agregar municipio", array('controller' => "Cities", "action" => "add"), array('update' => 'content', 'class' => 'btn btn-success fa fa-plus-square-o')) ?>