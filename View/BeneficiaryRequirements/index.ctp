<table border="1" width="100%">
    <thead>
        <tr>
            <th align="center"><h1>REQUISITOS ASPIRANTE <?php
if (isset($requisitos[0]['Beneficiary']['nombres'])) {
    echo $requisitos[0]['Beneficiary']['nombres'] . " " . $requisitos[0]['Beneficiary']['primer_apellido'];
}
?></h1></th>
</tr>
</thead>
</table>
<table id="tabla" class="tabla"  >
    <thead>
        <tr>
            <th>ID </th>
            <th>TEXTO</th>
            <th>Concepto</th>
            <th>Calificación</th>
            <th colspan="3">Opciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($requisitos as $rec): ?>
            <tr>
                <td><?php echo $rec['BeneficiaryRequirement']['id'] ?></td>
                <td><?php echo $rec['InitialRequirement']['texto']; ?></td>
                <td><?php echo $rec['BeneficiaryRequirement']['concepto'] ?></td>
                <td><?php echo $rec['BeneficiaryRequirement']['calificacion'] ?></td>
                <td><?php if($cerrado==0)echo $this->Ajax->link("Ver concepto", array('controller' => 'BeneficiaryRequirements', "action" => "edit", $rec['BeneficiaryRequirement']['id']), array('update' => 'aspirantes', 'complete' => 'formularioAjax()', 'indicator' => 'loading', 'class' => 'acciones')) ?></td>
                <td><?php if($cerrado==0)echo $this->Ajax->link("Eliminar", array('controller' => 'BeneficiaryRequirements', "action" => "delete", $rec['BeneficiaryRequirement']['id'],$rec['BeneficiaryRequirement']['beneficiary_id']), array('update' => 'aspirantes', 'complete' => 'formularioAjax()', 'indicator' => 'loading', 'class' => 'acciones'),'¿Desea eliminar el registro?') ?></td>
                <td></td>

            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php echo $this->Ajax->link("REGRESAR", array('controller' => 'Beneficiaries', "action" => "review_index", $rec['Beneficiary']['property_id']), array('update' => 'aspirantes', 'indicator' => 'loading', 'class' => 'acciones')) ?>