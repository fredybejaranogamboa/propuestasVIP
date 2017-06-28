<?php echo $this->Session->flash(); ?>
<h1 align="center">FAMILIARES  <?php echo $nombre; ?></h1>
<div id="loading" style="display: none;">
    <?php echo $this->Html->image('loading.gif', array('border' => "0", 'align' => 'center')); ?>
</div>
<table  id="tabla" class="tabla" >
    <thead>
        <tr style="background: #6b8c7f">

            <th>Identificación</th>
            <th>Nombres</th>
            <th>1er Apellido</th>
            <th>2do Apellido</th>
            <th></th>
            <th colspan="3">Opciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($candidates as $can): ?>
            <tr>

                <td><?php echo $can['Beneficiary']['numero_identificacion'] ?></td>
                <td><?php echo $can['Beneficiary']['nombres'] ?></td>
                <td><?php echo $can['Beneficiary']['primer_apellido'] ?></td>
                <td><?php echo $can['Beneficiary']['segundo_apellido'] ?></td>
                <td><?php echo "Conyuge" ?></td>
                <td>
                    <?php  $this->Ajax->link("Editar", array('controller' => 'Beneficiaries', "action" => "edit", $can['Beneficiary']['id'], $can['Beneficiary']['beneficiary_id']), array('update' => 'familiares', 'complete' => 'formularioAjax()', 'indicator' => 'loading', 'class' => 'acciones')) ?>
                </td>
                
                <td><?php  $this->Ajax->link("Borrar", array('controller' => 'Beneficiaries', "action" => "delete_conyugue", $can['Beneficiary']['id']), array('update' => 'familiares', 'complete' => 'formularioAjax()', 'class' => 'acciones', 'indicator' => 'loading'), "¿Realmente desea borrar el registro?") ?></td>
            </tr>
        <?php endforeach; ?>

        <?php foreach ($families as $rel): ?>

            <tr style="background: #daf6eb">

                <td><?php echo $rel['Family']['numero_identificacion'] ?></td>
                <td><?php echo $rel['Family']['nombres'] ?></td>
                <td><?php echo $rel['Family']['primer_apellido'] ?></td>
                <td><?php echo $rel['Family']['segundo_apellido'] ?></td>
                <td><?php echo $rel['Family']['parentesco'] ?></td>
                <td><?php echo $this->Ajax->link("Editar", array('controller' => 'Families', "action" => "edit", $rel['Family']['id']), array('update' => 'familiares', 'complete' => 'formularioAjax()', 'indicator' => 'loading')) ?></td>
               
                <td><?php echo $this->Ajax->link("Borrar", array('controller' => 'Families', "action" => "delete", $rel['Family']['id'], $beneficiary_id), array('update' => 'familiares', 'complete' => 'formularioAjax()', 'indicator' => 'loading'), "¿Realmente desea borrar el registro?") ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<br>
<br>
<table style="border: 1px solid" width="50%" align="center">
    <tbody>
        <tr>
            <td align="center"></td>
            <td align="center">
                <?php
                if ($conteo == 0)
                    //echo $this->Ajax->link("Agregar Conyuge", array('controller' => 'Beneficiaries', "action" => "add_conyuge", ), array('update' => 'familiares', 'complete' => 'formularioAjax()', 'indicator' => 'loading'))
                    ?>
            </td>
            <td align="center">
                <?php
                
                    echo $this->Ajax->link("Agregar Familiar", array('controller' => 'Families', "action" => "add",$beneficiary_id ), array('update' => 'familiares', 'complete' => 'formularioAjax()', 'indicator' => 'loading'))
                    ?>
            </td>
        </tr>
    </tbody>
</table>