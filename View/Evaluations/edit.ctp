<script>
    $(document).ready(function () {
        $("#formulario").validate({
            rules: {
                'data[Evaluation][contrapartida]': {
                    range: [0, 10000000000]
                },
                'data[Evaluation][cofinanciacion]': {
                    range: [0, 10000000000]
                },
                'data[Evaluation][otras_fuentes]': {
                    range: [0, 10000000000]
                }
            }
        });
    });
    $(function () {
        $('#entero').keyup(function () {
            if ($(this).val().indexOf('.') != -1) {
                if ($(this).val().split(".")[1].length > 0) {
                    if (isNaN(parseFloat(this.value)))
                        return;
                    this.value = parseFloat(this.value).toFixed(0);
                }
            }
            return this; //for chaining
        });
    });
</script>
<fieldset>
    <?php echo $this->Form->create("Evaluation", array('novalidate' => '', 'id' => 'formulario', 'role' => "form", "class" => "form", 'enctype' => 'multipart/form-data', 'type' => 'file', 'url' => array("action" => "edit", $this->data['Evaluation']['id']))); ?>
    <h3>Datos estructuración del proyecto</h3>
    <div>
        <?php echo $this->Form->hidden('Evaluation.id'); ?>
        <?php echo $this->Form->hidden('Evaluation.proyect_id'); ?>
        <?php echo $this->Form->hidden('Evaluation.user_id', array('value' => $user_id)); ?>
        <?php echo $this->Form->hidden('Evaluation.fecha', array('value' => $fecha)); ?>
        <?php echo $this->Form->input('Evaluation.contrapartida', array('id' => 'entero', 'label' => 'Valor contrapartida', 'class' => 'form-control', 'required' => '', 'type' => 'number')); ?>
        <?php echo $this->Form->input('Evaluation.cofinanciacion', array('id' => 'entero', 'label' => 'Valor cofinanciación', 'class' => 'form-control', 'required' => '', 'type' => 'number')); ?>
        <?php echo $this->Form->input('Evaluation.otras_fuentes', array('id' => 'entero', 'label' => 'Valor otras fuentes', 'class' => 'form-control', 'required' => '', 'type' => 'number')); ?>
        <?php echo $this->Form->input('Evaluation.cofinanciador', array('label' => 'Cofinanciador', 'class' => 'form-control')); ?>
    </div>
    <br><br>
    <?php echo $this->Form->input('Evaluation.observaciones', array('label' => 'Observaciones', 'class' => 'form-control')); ?>
    <br>
    <?php
    echo $this->Form->end(array('label' => "Guardar", 'class' => 'btn btn-default'));
    ?>
</fieldset>