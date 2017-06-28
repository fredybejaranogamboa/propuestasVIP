<script>
    $(document).ready(function () {
        $("#formulario").validate({
            rules: {
                'data[Asociation][email]': {
                    email: true
                }
            }
        });
    });
    $(function () {
        $("#datepicker").datepicker({
            changeMonth: true,
            changeYear: true,
            yearRange: "1990:2017"
        });
    });
</script>
<fieldset>
    <?php echo $this->Form->create("Asociation", array('novalidate' => '', 'id' => 'formulario', 'role' => "form", "class" => "form", 'enctype' => 'multipart/form-data', 'type' => 'file', 'url' => array("action" => "representante", $this->data['Asociation']['id']))); ?>
    <div>
        <?php echo $this->Form->hidden('Asociation.proyect_id'); ?>
        <?php echo $this->Form->hidden('Asociation.id'); ?>
       
    <h3>Datos representante legal</h3>
    <div>
        <?php echo $this->Form->input('Asociation.cedula_rep', array('label' => 'Cédula', 'class' => 'form-control', 'type' => 'number')); ?>
        <?php echo $this->Form->input('Asociation.nombre_rep', array('label' => 'Nombres', 'class' => 'form-control')); ?>
        <?php echo $this->Form->input('Asociation.primer_apellido_rep', array('label' => 'Primer apellido', 'class' => 'form-control')); ?>
        <?php echo $this->Form->input('Asociation.segundo_apellido_rep', array('label' => 'Segundo apellido', 'class' => 'form-control')); ?>
    </div>
    <?php echo $this->Form->input('Asociation.observacion', array('label' => 'Observación', 'class' => 'form-control')); ?>
    <br>
    <?php if ($permitir) echo $this->Form->end(array('label' => "Guardar", 'class' => 'btn btn-default')) ?>
</fieldset>