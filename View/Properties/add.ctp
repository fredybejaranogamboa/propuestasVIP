<fieldset>
    <?php echo $this->Form->create("Property", array('class' => 'form', "action" => "add/" . $proyect_id)); ?>
    <fieldset><legend>I. Control Operativo </legend>
        <?php echo $this->Form->hidden('Property.sincronizado', array('value' => 0)); ?>
        <?php echo $this->Form->input('PropertyControl.formulario', array('label' => '0. Número de Formulario', 'class' => 'required', 'type' => 'number')); ?>
        <?php echo $this->Form->input('PropertyControl.nombre_aliado', array('label' => '1.1 Nombre del Aliado estratégico', 'class' => 'required')); ?>
        <?php echo $this->Form->input('PropertyControl.nombre_encuestador', array('label' => '1.2 Nombre del encuestador', 'class' => 'required')); ?>
        <?php echo $this->Form->input('PropertyControl.documento_encuestador', array('label' => '1.3 Documento de identidad, Número de cédula', 'class' => 'required', 'type' => 'number')); ?>
        <?php echo $this->Form->input('PropertyControl.fecha_entrevista', array('type' => 'text', 'empty' => '', 'label' => '1.4 Fecha de entrevista', 'class' => 'calendario')); ?>
        <?php echo $this->Form->input('PropertyControl.numero_visitas', array('label' => '1.5  Número de entrevistas', 'class' => 'required', 'type' => 'number')); ?>
    </fieldset>
    <fieldset><legend>II. Identificación </legend>
        <?php echo $this->Form->input('Property.nombre', array('label' => '2.1 Nombre del predio', 'class' => 'required')); ?>
        <?php echo $this->Form->hidden('Property.proyect_id', array('value' => $proyect_id)); ?>
        <?php echo $this->Form->input('Property.matricula', array('label' => '2.2 Número de Matrícula', 'class' => 'required')); ?>
        <?php echo $this->Form->input('Property.cedula_catastral', array('label' => '2.3 Número de Cédula Catastral', 'class' => 'required')); ?>
        <?php echo $this->Form->input('Property.encuestado', array('label' => '2.4 Nombre del encuestado', 'class' => 'required')); ?>
        <?php echo $this->Form->input('Property.documento', array('label' => '2.5 Documento de identidad', 'class' => 'required')); ?>
        <?php
        echo $this->Ajax->observeField('PropertyDepartamentId', array(
            'url' => array('action' => 'select'),
            'frequency' => 0.2,
            'update' => 'ciudades',
                )
        );
        ?>
        <?php echo $this->Form->input('Property.departament_id', array('label' => '2.6.1 Departamento', 'empty' => 'Seleccione departamento', 'class' => 'required')); ?>
        <div id="ciudades">
            <?php
            echo $this->Form->input('Property.city_id', array(
                'label' => __('2.6.1 Municipio', true),
                'empty' => __('Seleccione ciudad', true),
                    )
            );
            ?>
        </div>
        <?php echo $this->Form->input('Property.corregimiento', array('label' => '2.6.2 Corregimiento', 'class' => 'required')); ?>
        <?php echo $this->Form->input('Property.vereda', array('label' => '2.6.3 Vereda', 'class' => 'required',)); ?>
        <?php echo $this->Form->input('Property.origen', array('label' => '2.7 Origen del predio', 'empty' => '', 'class' => 'required', 'options' => array('FNA' => 'FNA (Fondo Nacional del Ahorro)', 'DNE' => 'DNE (Dirección Nacional de Estupefacientes)', 'Baldíos' => 'Baldíos', 'Acuicultura' => 'Acuicultura', 'Compra directa' => 'Compra directa'))); ?>
        <?php echo $this->Form->end(array('label' => "Guardar", 'class' => 'submit_button')) ?>
    </fieldset>
</fieldset>
<table width="100%" border="0"  CellSpacing=10  align="center" >
    <tbody>
        <tr>          
            <td><?php echo $this->Ajax->link($this->Html->image('regresar.gif', array('width' => '30', 'heigth' => '30', 'alt' => 'Regresar', 'title' => 'Regresar')), array('controller' => 'Properties', 'action' => 'index'), array('update' => 'content', 'indicator' => 'loading', 'escape' => false)); ?></td>
        </tr>
    </tbody>
</table>