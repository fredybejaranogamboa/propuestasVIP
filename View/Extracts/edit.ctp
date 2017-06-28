<script>
    $(document).ready(function () {
        $("#formulario").validate({
            rules: {
                'data[Extract][saldo]': {
                    required: true
                },
                'data[Extract][fecha]': {
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
    <?php echo $this->Form->create("Extract", array('novalidate' => '', 'id' => 'formulario', 'role' => "form", "class" => "form", 'enctype' => 'multipart/form-data', 'type' => 'file', 'url' => array("action" => "edit", $this->data['Extract']['id']))); ?>
    <?php echo $this->Form->hidden('Extract.id'); ?>
    <?php echo $this->Form->hidden('Extract.proyect_id'); ?>
    <?php echo $this->Form->input('Extract.fecha', array('label' => 'Fecha extracto', 'class' => 'form-control', 'required' => '', 'id' => 'datepicker', 'type' => 'text')); ?>
    <?php echo $this->Form->input('Extract.saldo', array('label' => 'Saldo', 'class' => 'form-control')); ?>
    <?php echo $this->Form->input('Extract.observaciones', array('label' => 'Observaciones', 'class' => 'form-control')); ?>
    <hr> 
    <?php
    echo $this->Form->file("Extract.archivo", array('label' => 'Archivo soporte plan de inversión', 'class' => 'form-control',
        'accept' => 'application/pdf',
        'extension' => 'pdf'));
    ?>
    <hr> 
    <?php echo $this->Form->end(array('label' => "Guardar", 'class' => 'btn btn-default')) ?>
</fieldset>