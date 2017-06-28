<script>
    $(document).ready(function () {
        $("#formulario").validate();
    });
</script>
<fieldset>
    <?php echo $this->Form->create("Observation", array('novalidate'=>'','id'=>'formulario','role'=>"form","class" => "form", 'enctype' => 'multipart/form-data', 'type' => 'file', 'url' => array("action" => "edit", $this->data['Observation']['id']))); ?>
    <h3>Datos Observación</h3>
    <?php echo $this->Form->hidden('Observation.evaluation_id'); ?>
    <?php echo $this->Form->hidden('Observation.id'); ?>
    <?php echo $this->Form->hidden('Observation.user_id', array('value' => $user_id)); ?>
    <?php echo $this->Form->hidden('Observation.fecha', array('value'=>$fecha)); ?>
    <?php echo $this->Form->input('Observation.observacion', array('label' => 'Observación', 'required' => '', 'class'=>'form-control')); ?>
    <br>
    <?php echo $this->Form->end(array('label' => "Guardar", 'class' => 'btn btn-default')) ?>
</fieldset>