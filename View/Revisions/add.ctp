<script>
    $(document).ready(function () {
        $("#formulario").validate();
    });
</script>
<fieldset>
    <?php echo $this->Form->create("Revision", array('novalidate'=>'','id'=>'formulario','role'=>"form","class" => "form", 'enctype' => 'multipart/form-data', 'type' => 'file', 'url' => array("action" => "add", $evaluation_id))); ?>
    <h3>Datos Revisión</h3>
    <?php echo $this->Form->hidden('Revision.evaluation_id', array('value' => $evaluation_id)); ?>
    <?php echo $this->Form->hidden('Revision.user_id', array('value' => $user_id)); ?>
    <?php echo $this->Form->hidden('Revision.fecha', array('value'=>$fecha)); ?>
    <?php echo $this->Form->input('Revision.calificacion', array('label' => 'Calificación', 'required' => '', 'class'=>'form-control', 'empty' => '', 'options' =>array(
    'Cumple' => 'Cumple',
    'No Cumple' => 'No Cumple'
    ))); ?>
    <br><br>
    <?php echo $this->Form->end(array('label' => "Guardar", 'class' => 'btn btn-default')) ?>
</fieldset>