<script>
    $(document).ready(function () {
        $("#formulario").validate();
    });
</script>
<fieldset>
    <?php echo $this->Form->create("Evaluation", array('novalidate' => '', 'id' => 'formulario', 'role' => "form", "class" => "form", 'enctype' => 'multipart/form-data', 'type' => 'file', 'url' => array("action" => "concepto_final", $this->data['Evaluation']['id']))); ?>
    <h3>Datos Evaluación</h3>
    <div>
        <?php echo $this->Form->hidden('Evaluation.id'); ?>
        <?php echo $this->Form->hidden('Evaluation.proyect_id'); ?>
        <?php echo $this->Form->hidden('Evaluation.user_concepto_final', array('value' => $user_id)); ?>
        <?php echo $this->Form->hidden('Evaluation.fecha_concepto_final', array('value' => $fecha)); ?>
    </div>
    <br><br>
    <?php echo $this->Form->input('Evaluation.observacion_concepto_final', array('label' => 'Observaciones del concepto final', 'class' => 'form-control', 'required' => '')); ?>
    <?php
    echo $this->Form->input('Evaluation.calificacion_concepto_final', array('label' => 'Calificación', 'required' => '', 'class' => 'form-control', 'empty' => '', 'options' => array(
            'Cumple' => 'Cumple',
            'No Cumple' => 'No Cumple'
    )));
    ?>
    <br>
    <table border="0">
        <tbody>
            <tr>
                <td>FORMATO F13</td>
                <td><?php
                    echo $this->Form->file('Evaluation.f13', array('label' => 'F13',
                        'class' => 'form-control',
                        'accept' => 'application/pdf',
                        'aria-required' => 'true',
                        'extension' => 'pdf'));
                    ?></td>
            </tr>
            <tr>
                <td>FORMATO F29</td>
                <td><?php
                    echo $this->Form->file('Evaluation.f29', array('label' => 'F29',
                        'class' => 'form-control',
                        'accept' => 'application/pdf',
                        'aria-required' => 'true',
                        'extension' => 'pdf'));
                    ?></td>
            </tr>
        </tbody>
    </table>

    <?php
    echo $this->Form->end(array('label' => "Guardar", 'class' => 'btn btn-default'));
    ?>
</fieldset>