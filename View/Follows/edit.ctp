<script>
    $(document).ready(function () {
        $("#formulario").validate({
            rules: {
                'data[Follow][fecha]': {
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
    <?php echo $this->Form->create("Follow", array('novalidate' => '', 'id' => 'formulario', 'role' => "form", "class" => "form", 'enctype' => 'multipart/form-data', 'type' => 'file', 'url' => array("action" => "edit", $this->data['Follow']['id']))); ?>
    <?php echo $this->Form->hidden('Follow.proyect_id'); ?>
    <?php echo $this->Form->hidden('Follow.id'); ?>
    <?php echo $this->Form->input('Follow.fecha', array('label' => 'Fecha plan de inversión', 'class' => 'form-control', 'required' => '', 'id' => 'datepicker', 'type' => 'text')); ?>
    <?php
    echo $this->Form->input('Follow.tipo', array('label' => 'Tipo modificación', 'empty' => '','class' => 'form-control',
        'options' => array(
            'Sustancial' => 'Sustancial',
            'No sustancial' => 'No sustancial'
            )));
    ?>
    <?php echo $this->Form->input('Follow.observaciones', array('label' => 'Observaciones', 'class' => 'form-control')); ?>
    <hr> 
    <?php
    echo $this->Form->file('Follow.archivo', array('label' => 'Archivo soporte plan de inversión', 
        'class' => 'form-control',
        'accept' => 'application/pdf',
        'extension' => 'pdf'
    ));
    ?>
    <hr> 
    <?php echo $this->Form->end(array('label' => "Guardar", 'class' => 'btn btn-default')) ?>
</fieldset>