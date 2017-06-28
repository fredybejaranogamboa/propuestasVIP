<script>
    $(document).ready(function () {
        $("#formulario").validate({
            rules: {
                'data[Visit][fecha]': {
                    required: true
                },
                'data[Visit][porcentaje_ejecucion]': {
                    required: true,
                    digits: true,
                    range: [1, 100]
                },
                'data[Visit][observaciones]': {
                    required: true
                }
            }
        });
    });
    $(function () {
        $("#datepicker").datepicker({
            changeMonth: true,
            changeYear: true,
            yearRange: "2014:2017"
        });
    });
</script>

<fieldset>
    <?php echo $this->Form->create("Visit", array('novalidate' => '', 'id' => 'formulario', 'role' => "form", "class" => "form", 'enctype' => 'multipart/form-data', 'type' => 'file', 'url' => array("action" => "add", $proyect_id))); ?>
    <?php echo $this->Form->hidden('Visit.proyect_id', array('value' => $proyect_id)); ?>
    <?php echo $this->Form->input('Visit.fecha', array('label' => 'Fecha visita', 'class' => 'form-control', 'required' => '', 'id' => 'datepicker', 'type' => 'text')); ?>
    <?php echo $this->Form->input('Visit.porcentaje_ejecucion', array('label' => 'Porcentaje ejecución %', 'class' => 'form-control')); ?>
    <?php echo $this->Form->input('Visit.observaciones', array('label' => 'Observaciones generales del proyecto', 'class' => 'form-control')); ?>
    <?php echo $this->Form->input('Visit.problemas_ambientales', array('label' => 'Problemas ambientales', 'class' => 'form-control')); ?>
    <?php echo $this->Form->input('Visit.problemas_juridicos', array('label' => 'Problemas jurídicos', 'class' => 'form-control')); ?>
    <?php echo $this->Form->input('Visit.problemas_sociales', array('label' => 'Problemas sociales', 'class' => 'form-control')); ?>
    <?php echo $this->Form->input('Visit.problemas_comercializacion', array('label' => 'Problemas comercialización', 'class' => 'form-control')); ?>
    <?php echo $this->Form->input('Visit.recomendaciones', array('label' => 'Recomendaciones generales del proyecto', 'class' => 'form-control')); ?>
    <hr> 
    <?php
    echo '<b>Archivo soporte visita seguimiento </b>'.$this->Form->file("Visit.archivo", array('label' => 'Archivo soporte visita seguimiento', 'class' => 'form-control',
        'accept' => 'application/pdf',
        'extension' => 'pdf'));
    ?>
    <hr> 
    <?php echo $this->Form->end(array('label' => "Guardar", 'class' => 'btn btn-default')) ?>
</fieldset>