<script>
    $(function () {
        $("#datepicker").datepicker({
            changeMonth: true,
            changeYear: true,
            yearRange: "1990:2017"
        });
    });
    $(function () {
        $("#datepicker2").datepicker({
            changeMonth: true,
            changeYear: true,
            yearRange: "1990:2017"
        });
    });
</script>
<fieldset>
    <?php echo $this->Form->create("Asociation", array('novalidate' => '', 'id' => 'formulario', 'role' => "form", "class" => "form", 'enctype' => 'multipart/form-data', 'type' => 'file', 'url' => array("action" => "edit", $this->data['Asociation']['id']))); ?>
    <h3>Datos asociación</h3>
    <div>
        <?php echo $this->Form->hidden('Asociation.proyect_id'); ?>
        <?php echo $this->Form->hidden('Asociation.id'); ?>
        <?php echo $this->Form->input('Asociation.nombre', array('label' => 'Nombre', 'required' => '', 'class' => 'form-control')); ?>
        <?php echo $this->Form->input('Asociation.nit', array('label' => 'NIT', 'class' => 'form-control', 'required' => '')); ?>
        <?php
        echo $this->Form->input('Asociation.tipo', array('label' => 'Tipo', 'required' => '', 'class' => 'form-control', 'empty' => '', 'options' => array(
                'Asociación' =>'Asociación',                
                'Coperativa' => 'Coperativa',
                'JAC' => 'JAC'
        )));
        ?>
    <?php
    echo $this->Ajax->observeField('AsociationDepartamentId', array(
        'url' => array('action' => 'select', 'controller' => 'Asociations'),
        'frequency' => 0.2,
        'update' => 'ciudades',
            )
    );
    ?>

    <?php echo $this->Form->input('Asociation.departament_id', array('label' => ' Departamento', 'required' => '', 'class' => 'form-control', 'empty' => 'Seleccione departamento', 'options' => $departaments, 'selected' => $departament_id)); ?>
    <div id="ciudades">
        <?php
        echo $this->Form->input('Asociation.city_id', array(
            'label' => __(' Municipio', true),
            'empty' => __('Seleccione ciudad', true),
            'class' => 'form-control',
            'required' => ''
                )
        );
        ?>
    </div>   
        <?php echo $this->Form->input('Asociation.vereda', array('label'=>'Vereda', 'class'=>'form-control')); ?>
    </div>
    <br><br>
    <h3>Datos asociados</h3>
    <div>
        <?php echo $this->Form->input('Asociation.total_socios', array('label' => 'Total socios', 'class' => 'form-control')); ?>
        <?php echo $this->Form->input('Asociation.mujeres', array('label' => 'Total mujeres', 'class' => 'form-control')); ?>
        <?php echo $this->Form->input('Asociation.hombres', array('label' => 'Total hombres', 'class' => 'form-control')); ?>
        <?php echo $this->Form->input('Asociation.jovenes', array('label' => 'Total jóvenes rurales', 'class' => 'form-control')); ?>
        <?php echo $this->Form->input('Asociation.adulto_mayor', array('label' => 'Total adulto mayor', 'class' => 'form-control')); ?>
        <br>
        <?php echo $this->Form->input('Asociation.afros', array('label' => 'Afrocolombianos', 'class' => 'form-control')); ?>
        <?php echo $this->Form->input('Asociation.raizal', array('label' => 'Raizales', 'class' => 'form-control')); ?>
        <?php echo $this->Form->input('Asociation.indigenas', array('label' => 'Indígenas', 'class' => 'form-control')); ?>
        <?php echo $this->Form->input('Asociation.campesinos', array('label' => 'Campesinos', 'class' => 'form-control')); ?>
        <?php echo $this->Form->input('Asociation.victimas', array('label' => 'Victimas', 'class' => 'form-control')); ?>
    </div>
    <br><br>
    <h3>No. Personas Impactadas: (Directos y Indirectos)</h3>
    <div>
        <?php echo $this->Form->input('Asociation.directos', array('label' => 'Directos', 'class' => 'form-control')); ?>
        <?php echo $this->Form->input('Asociation.indirectos', array('label' => 'Indirectos', 'class' => 'form-control')); ?>
    </div>
    <?php echo $this->Form->input('Asociation.tiempo_experiencia', array('label'=>'Tiempo experiencia en meses', 'class'=>'form-control')); ?>        
    <?php
        echo $this->Form->input('Asociation.relacion_predio', array('label' => 'Relación jurídica con el predio: (propietario, poseedor, tenedor y ocupante)', 'required' => '', 'class' => 'form-control', 'empty' => '', 'options' => array(
                'Propietario' =>'Propietario',                
                'Poseedor' => 'Poseedor',
                'Tenedor' => 'Tenedor',
                'Ocupante' => 'Ocupante'
        )));
    ?>
    <?php echo $this->Form->input('Asociation.fecha_censo', array('label' => 'Censo (Ha sido censado y en que fecha):', 'class' => 'form-control', 'id' => 'datepicker', 'type' => 'text')); ?>
    <br><br>
    <h3>Apoyo/Incentivos Ha recibido apoyo o incentivos del estado para la producción agropecuaria</h3>
    <?php echo $this->Form->input('Asociation.apoyo_tipo', array('label' => 'Tipo apoyo', 'class' => 'form-control')); ?>
    <?php echo $this->Form->input('Asociation.apoyo_institucion', array('label' => 'Institución', 'class' => 'form-control')); ?>
    <?php echo $this->Form->input('Asociation.apoyo_fecha', array('label' => 'Fecha en que se recibió el apoyo', 'class' => 'form-control', 'id' => 'datepicker2', 'type' => 'text')); ?>
    <br><br>
    <h3>Crédito</h3>
    <?php
        echo $this->Form->input('Asociation.credito_tipo', array('label' => 'Tipo de crédito', 'required' => '', 'class' => 'form-control', 'empty' => '', 'options' => array(
                'Productivo' =>'Productivo',                
                'Vivienda' => 'Vivienda',
                'Consumo' => 'Consumo',
                'Otro' => 'Otro'
        )));
    ?>
    <?php echo $this->Form->input('Asociation.credito_otro', array('label' => 'Otro tipo de crédito', 'class' => 'form-control')); ?>
    <?php echo $this->Form->input('Asociation.credito_valor', array('label' => 'Valor crédito', 'class' => 'form-control')); ?>
    <?php echo $this->Form->input('Asociation.credito_plazo', array('label' => 'Plazo crédito', 'class' => 'form-control')); ?>
    <br><br>
    <?php echo $this->Form->input('Asociation.observacion', array('label' => 'Observación', 'class' => 'form-control')); ?>
    <br>
    <?php if ($permitir) echo $this->Form->end(array('label' => "Guardar", 'class' => 'btn btn-default')) ?>
</fieldset>