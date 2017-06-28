<?php

echo $this->Session->flash(); ?>
<h3>MUNICIPIOS ASOCIADOS AL PROYECTO <?php echo $codigo; ?></h3>
<div id="loading" style="display: none;">
    <?php echo $this->Html->image('loading.gif', array('border' => "0", 'align' => 'center')); ?>
</div>
<table class="table table-striped table-bordered table-hover" >
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Divipol</th>
            <th>Borrar</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($cities as $city): ?>
        <tr>
            <td><?php echo $city['City']['name'] ?></td>
            <td><?php echo $city['City']['divipol'] ?></td>
            <td><?php echo $this->Ajax->link("Borrar", array('controller' => 'CityProyects', "action" => "delete", $city['CityProyect']['id'], $proyect_id), array('update' => 'content', 'class' => 'btn btn-danger fa fa-trash', 'indicator' => 'loading'), "¿Realmente desea borrar el registro?"); ?></td>
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
                <?php echo $this->Ajax->link("Agregar municipio", array('controller' => 'CityProyects', "action" => "add", $proyect_id), array('update' => 'content', 'indicator' => 'loading', 'class'=>'btn btn-success fa fa-plus-square-o'));?>
            </td>
        </tr>
    </tbody>
</table>