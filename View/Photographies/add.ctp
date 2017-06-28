<script>
    $(document).ready(function () {
        $("#formulario").validate({
            rules: {
                'data[Photography][comentario]': {
                    required: true
                },
                'data[Photography][archivo]': {
                    required: true
                }
            }
        });
    });
</script>
<fieldset>
    <?php echo $this->Form->create("Photography", array('novalidate' => '', 'id' => 'formulario', 'role' => "form", "class" => "form", 'enctype' => 'multipart/form-data', 'type' => 'file', 'url' => array("action" => "add", $visit_id))); ?>
    <?php echo $this->Form->hidden('Photography.visit_id', array('value' => $visit_id)); ?>
    <?php echo $this->Form->input('Photography.comentario', array('label' => 'Observaciones', 'class' => 'form-control')); ?>
    <hr> 
    <?php
    echo $this->Form->file("Photography.archivo", array('label' => 'Archivo', 'class' => 'form-control',
        'accept' => 'image/jpeg',
        'extension' => 'jpg'));
    ?>
    <hr> 
    <?php echo $this->Form->end(array('label' => "Guardar", 'class' => 'btn btn-default')) ?>
</fieldset>