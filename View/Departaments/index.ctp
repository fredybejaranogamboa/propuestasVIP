<?php

echo $this->Session->flash(); ?>
<table class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th>Nombre</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
<?php foreach ( $Departaments as $Departament):?>
        <tr>
            <td><?php echo $Departament['Departament']['name']; ?></td>
            <td><?php echo $this->Ajax->link('Editar', array('controller'=>'Departaments','action'=>'edit',$Departament["Departament"]["id"]),array('update'=>'content','indicator'=>'loading', 'class'=>'btn btn-success fa fa-pencil')); ?></td>
        </tr>
<?php endforeach;?>
    </tbody>
</table>
<?php echo $this->Ajax->link('Adicionar',array('controller'=>'Departaments','action'=>'add'),array('update'=>'content','indicator'=>'loading','complete'=>'formularioAjax()')); ?>
