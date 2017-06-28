<script>
    $(document).ready(function () {
        $("#formulario").validate();
    });
</script>
<?php echo $this->Html->link(' Volver', array('controller' => 'Properties', 'action' => 'index'), array('escape' => FALSE, 'update' => 'content', 'class' => 'btn btn-info fa fa-arrow-circle-left')); ?>
<br>
<h2>Documentos predio <?php echo $this->data['Property']['nombre'] ?> </h2>
<?php echo $this->Form->create("Property", array('novalidate' => '', 'id' => 'formulario', 'role' => "form", "class" => "form", 'enctype' => 'multipart/form-data', 'type' => 'file', "action" => "upload_files/" . $this->data['Property']['id'])); ?>
<h2>El análisis jurídico de posesión se realizará teniendo en cuenta los medios probatorios establecidos en el código general del proceso y los documentos a listados son meramente enunciativos, en caso de tener otros documentos utilizar la opción de otros</h2>

<legend>Adjuntar archivo</legend>
<?php
echo $this->Form->hidden('Property.id');
echo $this->Form->hidden('Property.proyect_id');
?>
<table class="table table-striped table-bordered table-hover">
    <tbody>
        <tr>
            <td>F25-GI-PPDRET / F7-GI-PPDRET Análisis jurídico de predios</td>
            <td><?php
                echo $this->Form->file('Property.f25', array('label' => 'Cargar Análisis jurídico de predios',
                    'class' => 'form-control',
                    'accept' => 'application/pdf',
                    'aria-required' => 'true',
                    'extension' => 'pdf'));
                ?></td>
        </tr>
        <tr>
            <td>F4-GI-PPDRET Visita de verificación a predio</td>
            <td><?php
                echo $this->Form->file('Property.f4', array('label' => 'Cargar Visita de verificación a predio',
                    'class' => 'form-control',
                    'accept' => 'application/pdf',
                    'aria-required' => 'true',
                    'extension' => 'pdf'));
                ?></td>
        </tr>
        <?php if ($this->data['Property']['tipo_tenencia'] != "Poseedor"): ?>
            <tr>
                <td>Matrícula inmobiliaria</td>
                <td><?php
                    echo $this->Form->file('Property.archivo_matricula', array('label' => 'Cargar matrícula inmobiliaria',
                        'class' => 'form-control',
                        'accept' => 'application/pdf',
                        'aria-required' => 'true',
                        'extension' => 'pdf'));
                    ?></td>
            </tr>
            <tr>
                <td>Certificación distrito de riego</td>
                <td><?php
                    echo $this->Form->file('Property.distrito', array('label' => 'Cargar Certificación distrito de riego',
                        'class' => 'form-control',
                        'accept' => 'application/pdf',
                        'aria-required' => 'true',
                        'extension' => 'pdf'));
                    ?></td>
            </tr>
            <tr>
                <td>Certificación resguardo indígena</td>
                <td><?php
                    echo $this->Form->file('Property.resguardo', array('label' => 'Cargar matrícula inmobiliaria',
                        'class' => 'form-control',
                        'accept' => 'application/pdf',
                        'aria-required' => 'true',
                        'extension' => 'pdf'));
                    ?></td>
            </tr>
            <tr>
                <td>Certificación consejo comunitario</td>
                <td><?php
                    echo $this->Form->file('Property.consejo', array('label' => 'Cargar matrícula inmobiliaria',
                        'class' => 'form-control',
                        'accept' => 'application/pdf',
                        'aria-required' => 'true',
                        'extension' => 'pdf'));
                    ?></td>
            </tr>
        <?php else: ?>
            <tr>
                <td>Declaración extrajuicio</td>
                <td><?php
                    echo $this->Form->file('Property.declaracion_extrajuicio', array('label' => 'Cargar declaración extrajuicio',
                        'class' => 'form-control',
                        'accept' => 'application/pdf',
                        'aria-required' => 'true',
                        'extension' => 'pdf'));
                    ?></td>
            </tr>
            <tr>
                <td>Junta acción comunal</td>
                <td><?php
                    echo $this->Form->file('Property.junta_accion_comunal', array('label' => 'Cargar junta acción comunal',
                        'class' => 'form-control',
                        'accept' => 'application/pdf',
                        'aria-required' => 'true',
                        'extension' => 'pdf'));
                    ?></td>
            </tr>
            <tr>
                <td>Sana posesión</td>
                <td><?php
                    echo $this->Form->file('Property.sana_posesion', array('label' => 'Cargar sana posesión',
                        'class' => 'form-control',
                        'accept' => 'application/pdf',
                        'aria-required' => 'true',
                        'extension' => 'pdf'));
                    ?></td>
            </tr>
            <tr>
                <td>Manifiesto de colindancias</td>
                <td><?php
                    echo $this->Form->file('Property.manifiesto_colindancias', array('label' => 'Cargar manifiesto colindancias',
                        'class' => 'form-control',
                        'accept' => 'application/pdf',
                        'aria-required' => 'true',
                        'extension' => 'pdf'));
                    ?></td>
            </tr>
        <?php endif; ?>
        <tr>
            <td>Certificación uso del suelo</td>
            <td><?php
                echo $this->Form->file('Property.uso_suelo', array('label' => 'Cargar matrícula inmobiliaria',
                    'class' => 'form-control',
                    'accept' => 'application/pdf',
                    'aria-required' => 'true',
                    'extension' => 'pdf'));
                ?></td>
        </tr>
        <tr>
            <td>F6-GI-PPDRET Cruce ambiental preliminar</td>
            <td><?php
                echo $this->Form->file('Property.verificacion_predial', array('label' => 'Cargar verificacion predial',
                    'class' => 'form-control',
                    'accept' => 'application/pdf',
                    'aria-required' => 'true',
                    'extension' => 'pdf'));
                ?></td>
        </tr>
        <?php if ($this->data['Property']['requiere_permisos_ambientales'] == 1): ?>
            <tr>
                <td>Tramites y permisos ambientales</td>
                <td><?php
                    echo $this->Form->file('Property.tramites_ambientales', array('label' => 'Cargar tramites ambientales',
                        'class' => 'form-control',
                        'accept' => 'application/pdf',
                        'aria-required' => 'true',
                        'extension' => 'pdf'));
                    ?></td>
            </tr>
        <?php endif ?>
    </tbody>
</table>

<?php echo $this->Ajax->link('  Otros documentos', array('controller' => 'Documents', 'action' => 'index', $this->data['Property']['id']), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-success fa fa-plus-square-o')); ?>
<br><br>
<?php echo $this->Form->end(array('label' => 'Guardar', 'class' => 'btn btn-default')) ?>
<br>
<?php echo $this->Html->link(' Volver', array('controller' => 'Properties', 'action' => 'index'), array('escape' => FALSE, 'update' => 'content', 'class' => 'btn btn-info fa fa-arrow-circle-left')); ?>