<?php echo $this->Session->flash(); ?>
<h3 align="center">CONYUGUE  <?php echo $nombre; ?></h3>
<div id="loading" style="display: none;">
    <?php echo $this->Html->image('loading.gif', array('border' => "0", 'align' => 'center')); ?>
</div>
<table class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
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
                    <?php if ($permitir) echo $this->Ajax->link(" Editar", array('controller' => 'Beneficiaries', "action" => "edit", $can['Beneficiary']['id'], $can['Beneficiary']['beneficiary_id'], 0), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-success fa fa-pencil')) ?>
                </td>
                <td>
                    <br>
                    <?php
                    if (file_exists("../webroot/files/Beneficiarios/documento_identidad-" . $can['Beneficiary']['id'] . ".pdf"))
                        echo $this->Html->link(' Documento_identidad', "../files/Beneficiarios/documento_identidad-" . $can['Beneficiary']['id'] . ".pdf", array('target' => 'blank', 'indicator' => 'loading', 'class' => 'btn btn-info fa fa-file-pdf-o', 'download' => "Documento_identidad-" . $aleatorio . ".pdf"));
                    ?>
                    <br>
                    <br>
                    <?php
                    if (file_exists("../webroot/files/Beneficiarios/policia-" . $can['Beneficiary']['id'] . ".pdf"))
                        echo $this->Html->link(' Certificado_policía', "../files/Beneficiarios/policia-" . $can['Beneficiary']['id'] . ".pdf", array('target' => 'blank', 'indicator' => 'loading', 'class' => 'btn btn-info fa fa-file-pdf-o', 'download' => "Certificado_policia-" . $aleatorio . ".pdf"));
                    ?>
                    <br>
                    <br>
                    <?php
                    if (file_exists("../webroot/files/Beneficiarios/contraloria-" . $can['Beneficiary']['id'] . ".pdf"))
                        echo $this->Html->link(' Certificado_contraloría', "../files/Beneficiarios/contraloria-" . $can['Beneficiary']['id'] . ".pdf", array('target' => 'blank', 'indicator' => 'loading', 'class' => 'btn btn-info fa fa-file-pdf-o', 'download' => "Certificado_contraloria-" . $aleatorio . ".pdf"));
                    ?>
                    <br>
                    <br>
                    <?php
                    if (file_exists("../webroot/files/Beneficiarios/procuraduria-" . $can['Beneficiary']['id'] . ".pdf"))
                        echo $this->Html->link(' Certificado_procuraduría', "../files/Beneficiarios/procuraduria-" . $can['Beneficiary']['id'] . ".pdf", array('target' => 'blank', 'indicator' => 'loading', 'class' => 'btn btn-info fa fa-file-pdf-o', 'download' => "Certificado_procuraduria-" . $aleatorio . ".pdf"));
                    ?>
                    <br>
                    <br>
                    <?php
                    if (file_exists("../webroot/files/Beneficiarios/sisben-" . $can['Beneficiary']['id'] . ".pdf"))
                        echo $this->Html->link(' SISBEN', "../files/Beneficiarios/sisben-" . $can['Beneficiary']['id'] . ".pdf", array('target' => 'blank', 'indicator' => 'loading', 'class' => 'btn btn-info fa fa-file-pdf-o', 'download' => "SISBEN-" . $aleatorio . ".pdf"));
                    ?>

                </td>
                <td><?php if ($permitir) echo $this->Ajax->link(" Borrar", array('controller' => 'Beneficiaries', "action" => "delete", $can['Beneficiary']['id'], $can['Beneficiary']['proyect_id'], 0), array('update' => 'content', 'class' => 'btn btn-danger fa fa-trash', 'indicator' => 'loading'), "¿Realmente desea borrar el registro?") ?></td>
            </tr>
        <?php endforeach; ?>
        <?php foreach ($families as $rel): ?>
            <tr style="background: #daf6eb">
                <td><?php echo $rel['Family']['numero_identificacion'] ?></td>
                <td><?php echo $rel['Family']['nombres'] ?></td>
                <td><?php echo $rel['Family']['primer_apellido'] ?></td>
                <td><?php echo $rel['Family']['segundo_apellido'] ?></td>
                <td><?php echo $rel['Family']['parentesco'] ?></td>
                <td><?php echo $this->Ajax->link(" Editar", array('controller' => 'Families', "action" => "edit", $rel['Family']['id']), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-success fa fa-pencil')) ?></td>
                <td><?php echo $this->Ajax->link(" Borrar", array('controller' => 'Families', "action" => "delete", $rel['Family']['id'], $can), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-danger fa fa-trash'), "¿Realmente desea borrar el registro?") ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<br>
<?php
if ($conteo == 0 and $permitir) {
    echo $this->Ajax->link(" Agregar Conyuge", array('controller' => 'Beneficiaries', "action" => "add", $property_id, $beneficiary_id, 0), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-success fa fa-plus-square-o'));
}
?>