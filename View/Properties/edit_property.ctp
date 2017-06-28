<script>
    $("input,textarea").keyup(function () {
        if ($(this).attr('id') != 'usr') {
            $(this).val($(this).val().toUpperCase());
        }
    });


    $(document).ready(function () {
        $("#formulario").validate({
            rules: {
                'data[Property][area_total_m]': {
                    range: [0, 9999]
                },
                'data[Property][oficina_matricula]': {
                    maxlength: 3
                },
                'data[Property][numero_matricula]': {
                    range: [0, 99999999]
                }
            }
        });
    });

</script>
<?php echo $this->Html->link(' Volver', array('controller' => 'Properties', 'action' => 'index'), array('escape' => FALSE, 'update' => 'content', 'class' => 'btn btn-info fa fa-arrow-circle-left')); ?>
<br>
<?php echo $this->Form->create("Property", array('novalidate' => '', 'id' => 'formulario', 'role' => "form", "class" => "form", 'enctype' => 'multipart/form-data', 'type' => 'file', 'url' => array("action" => "edit_property", $this->data['Property']['id']))); ?>

<fieldset>
    <table class="table table-striped table-bordered table-hover">
        <tbody>
            <tr>
                <td>
                    <?php
                    echo $this->Form->hidden('Property.proyect_id');
                    echo $this->Form->hidden('Property.id');
                    echo $this->Form->input('Property.nombre', array('label' => 'Nombre del predio', 'class' => 'form-control', 'required' => ''));
                    ?>
                </td>
                <td>
                    <?php echo $this->Form->input('Property.tipo_tenencia', array('label' => 'Tipo tenencia', 'class' => 'form-control', 'required' => '', 'empty' => '', 'options' => array('Propietario' => 'Propietario', 'Poseedor' => 'Poseedor', 'Ocupación' => 'Ocupación', 'Tenencia - comodato' => 'Tenencia - comodato', 'Tenencia - arrendamiento' => 'Tenencia - arrendamiento'))); ?>
                </td>
                <td><?php echo $this->Form->input('Property.oficina_matricula', array('label' => 'Oficina matrícula inmobiliaria', 'class' => 'form-control', 'required' => '')); ?></td>

            </tr>
            <tr>
                <td><?php echo $this->Form->input('Property.numero_matricula', array('label' => 'Número matrícula inmobiliria', 'class' => 'form-control', 'required' => '')); ?></td>
                <td><?php echo $this->Form->input('Property.cedula_catastral', array('label' => 'Código catastral', 'class' => 'form-control')); ?></td>
                <td>
                    <?php
                    echo $this->Ajax->observeField('PropertyDepartamentId', array(
                        'url' => array('action' => 'select', 'controller' => 'Properties'),
                        'frequency' => 0.2,
                        'update' => 'ciudades',
                            )
                    );
                    ?>
                    <?php echo $this->Form->input('Property.departament_id', array('label' => ' Departamento', 'required' => '', 'class' => 'form-control', 'empty' => 'Seleccione departamento', 'options' => $departaments)); ?>
                </td>
            </tr>
            <tr>
                <td>
                    <div id="ciudades">
                        <?php
                        echo $this->Form->input('Property.city_id', array(
                            'label' => __(' Municipio', true),
                            'empty' => __('Seleccione ciudad', true),
                            'class' => 'form-control',
                            'required' => ''
                                )
                        );
                        ?>
                    </div>
                </td>
                <td><?php echo $this->Form->input('Property.vereda', array('label' => 'Vereda', 'class' => 'form-control')); ?></td>
                <td><?php echo $this->Form->input('Property.corregimiento', array('label' => 'Corregimiento', 'class' => 'form-control')); ?></td>
            </tr>
            <tr>
                <td><?php echo $this->Form->input('Property.area_total_ha', array('label' => 'Área del predio (Ha)', 'class' => 'form-control')); ?></td>
                <td><?php echo $this->Form->input('Property.area_total_m', array('label' => 'Área del predio metros', 'class' => 'form-control')); ?></td>
                <td><?php echo $this->Form->input('Property.requiere_permisos_ambientales', array('label' => 'Requiere permisos ambientales', 'class' => 'form-control', 'required' => '', 'empty' => '', 'options' => array('1' => 'Si', '0' => 'No'))); ?></td>
            </tr>
        </tbody>
    </table>
    <br>
    <?php echo $this->Form->end(array('label' => "Guardar", 'class' => 'btn btn-default')); ?>
    <br>
</fieldset>
<?php echo $this->Html->link(' Volver', array('controller' => 'Properties', 'action' => 'index'), array('escape' => FALSE, 'update' => 'content', 'class' => 'btn btn-info fa fa-arrow-circle-left')); ?>