<script>
    $(document).ready(function () {
        $('.form').validate();
        selectDiv();
        $('#tipo').change(function () {
            selectDiv();
        });
    })

    $(function () {
        $("#datepicker").datepicker({
            changeMonth: true,
            changeYear: true,
            yearRange: "1909:2005"
        });
    });

    function selectDiv() {
        if ($('#tipo option:selected').val() === '') {
            $('#campesino').hide("fast");
            $('#victima').hide("fast");
            $('#camp_docs').hide("fast");
        } else if ($('#tipo option:selected').val() === 'Victima') {
            $('#campesino').hide("fast");
            $('#victima').show("fast");
            $('#camp_docs').hide("fast");
        } else {
            $('#campesino').show("fast");
            $('#victima').hide("fast");
            $('#camp_docs').show("fast");
        }

    }
</script>
<fieldset>
    <?php echo $this->Form->create("Beneficiary", array('novalidate' => '', 'id' => 'formulario', 'role' => "form", "class" => "form", 'enctype' => 'multipart/form-data', 'type' => 'file', 'url' => array("action" => "edit", $this->data['Beneficiary']['id'], $this->data['Beneficiary']['beneficiary_id']))); ?>
    <?php echo $this->Form->hidden('Beneficiary.id'); ?>
    <?php echo $this->Form->hidden('Beneficiary.proyect_id'); ?>
    <?php echo $this->Form->hidden('Beneficiary.beneficiary_id'); ?>
    <?php echo $this->Form->input('Beneficiary.tipo_identificacion', array('label' => 'Tipo identificación', 'class' => 'form-control', 'required' => '', 'empty' => '', 'options' => array('C.C' => 'C.C', 'T.I' => 'T.I'))); ?>
    <?php echo $this->Form->input('Beneficiary.numero_identificacion', array('label' => 'Número identificación', 'class' => 'form-control', 'required' => '', 'type' => 'number')); ?>
    <?php echo $this->Form->input('Beneficiary.personas_a_cargo', array('label' => 'Personas a cargo', 'class' => 'form-control', 'type' => 'number')); ?>
    <?php echo $this->Form->input('Beneficiary.nombres', array('label' => 'Nombres', 'class' => 'form-control', 'required' => '')); ?>
    <?php echo $this->Form->input('Beneficiary.primer_apellido', array('label' => 'Primer apellido', 'class' => 'form-control', 'required' => '')); ?>
    <?php echo $this->Form->input('Beneficiary.segundo_apellido', array('label' => 'Segundo apellido', 'class' => 'form-control')); ?>
    <?php echo $this->Form->input('Beneficiary.genero', array('label' => 'Género', 'class' => 'form-control', 'empty' => '', 'options' => array('Masculino' => 'Masculino', 'Femenino' => 'Femenino'))); ?>
    <?php echo $this->Form->input('Beneficiary.tipo', array('label' => 'Tipo beneficiario', 'class' => 'form-control', 'required' => '', 'empty' => '', 'id' => 'tipo', 'options' => array(
    'INDIGENA' => 'INDIGENA',
    'AFROCOLOMBIANO' => 'AFROCOLOMBIANO',
    'VICTIMA' => 'VICTIMA',
    'CAMPESINO' => 'CAMPESINO',
    'RAIZAL' => 'RAIZAL',
    'DISCAPACITADO' => 'DISCAPACITADO',
    'OTRO' => 'OTRO',
    ))); ?>
    <?php //echo $this->Form->input('Beneficiary.grupo', array('label' => 'Grupo beneficiario', 'class' => 'form-control', 'empty' => '', 'id' => 'grupo', 'options' => array('Indigena' => 'Indigena', 'Rom' => 'Rom', 'Negritudes' => 'Negritudes', 'Mujer cabeza de familia' => 'Mujer cabeza de familia', 'Raizal' => 'Raizal'))); ?>
    <?php echo $this->Form->input('Beneficiary.nivel_escolaridad', array('label' => 'Nivel escolaridad', 'class' => 'form-control', 'empty' => '', 'options' => array(
    'NINGUNO' => 'NINGUNO', 
    'PRIMARIA' => 'PRIMARIA',
    'SECUNDARIA' => 'SECUNDARIA',
    'TECNICA PROFESIONAL' => 'TECNICA PROFESIONAL'			

    ))); ?>
    <?php echo $this->Form->input('Beneficiary.fecha_nacimiento', array('label' => 'Fecha nacimiento', 'class' => 'form-control', 'required' => '', 'id' => 'datepicker', 'type' => 'text')); ?>
    <?php echo $this->Form->input('Beneficiary.telefono', array('label' => 'Teléfono', 'class' => 'form-control')); ?>
    <?php echo $this->Form->input('Beneficiary.direccion', array('label' => 'Dirección de notificación', 'class' => 'form-control')); ?>

    <?php
    //creo el array de options para el select incluyendo los aspirantes principales
    $optionsProperties = array();
    foreach ($properties as $property) {
        $optionsProperties[$property['Property']['id']] = $property['Property']['nombre'] . " " . $property['Property']['oficina_matricula'] . "-" . -$property['Property']['numero_matricula'];
    }
    echo $this->Form->input('Beneficiary.property_id', array('label' => 'Predio al que pertenece', 'empty' => 'Seleccione un predio', 'options' => $optionsProperties, 'class' => 'form-control'));
    ?>  
    <div id="campesino">
        <?php echo $this->Form->input('Beneficiary.sisben_area', array('label' => 'Área SISBEN', 'class' => 'form-control', 'options' => array('2' => '2', '3' => '3'), 'empty' => '0')); ?>
        <?php echo $this->Form->input('Beneficiary.sisben_puntaje', array('label' => 'Puntaje SISBEN', 'class' => 'form-control')); //maximo 50?> 
    </div>
    <div id="victima">
        <?php echo $this->Form->input('Beneficiary.rup', array('label' => 'Esta inscrito en el RUV', 'options' => array('Si' => 'Si', 'No' => 'No'), 'empty' => '', 'class' => 'form-control', 'required' => '')); ?>
    </div>
    <?php
    echo $this->Ajax->observeField('BeneficiaryDepartamentId', array(
        'url' => array('action' => 'select', 'controller' => 'Beneficiaries'),
        'frequency' => 0.2,
        'update' => 'ciudades',
            )
    );
    ?>
    <?php echo $this->Form->input('Beneficiary.departament_id', array('label' => ' Departamento', 'required' => '', 'class' => 'form-control', 'empty' => 'Seleccione departamento', 'options' => $departaments, 'selected' => $departament_id)); ?>
    <div id="ciudades">
        <?php
        echo $this->Form->input('Beneficiary.city_id', array(
            'label' => __(' Municipio', true),
            'empty' => __('Seleccione ciudad', true),
            'class' => 'form-control',
            'required' => ''
                )
        );
        ?>
    </div>

    <table border="0">
        <tbody>
            <tr>
                <td>Adjuntar documento de identidad</td>
                <td><?php echo $this->Form->file('Beneficiary.cedula', array('label' => 'Adjuntar cédula', 'class' => 'form-control')); ?></td>
            </tr>
            <tr>
                <td>Adjuntar certificado policía</td>
                <td><?php echo $this->Form->file('Beneficiary.policia', array('label' => 'Adjuntar policia', 'class' => 'form-control')); ?></td>
            </tr>
            <tr>
                <td>Adjuntar certificado contraloría</td>
                <td><?php echo $this->Form->file('Beneficiary.contraloria', array('label' => 'Adjuntar contraloría', 'class' => 'form-control')); ?></td>
            </tr>
            <tr>
                <td>Adjuntar certificado procuraduría</td>
                <td><?php echo $this->Form->file('Beneficiary.procuraduria', array('label' => 'Adjuntar procuraduría', 'class' => 'form-control')); ?></td>
            </tr>
            <tr id="camp_docs">
                <td>Adjuntar certificado SISBEN</td>
                <td><?php echo $this->Form->file('Beneficiary.sisben', array('label' => 'Adjuntar sisben', 'class' => 'form-control')); ?></td>
            </tr>
            <tr>
                <td>Adjuntar F1-GI-PPDRET / F26-GI-PPDRET</td>
                <td><?php echo $this->Form->file('Beneficiary.f26', array('label' => 'Adjuntar f26', 'class' => 'form-control')); ?></td>
            </tr>
        </tbody>
    </table>
    <?php if ($permitir) echo $this->Form->end(array('label' => "Guardar", 'class' => 'btn btn-default')) ?>
</fieldset>