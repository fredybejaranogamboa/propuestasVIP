<script>
    $(document).ready(function () {
        $("#formulario").validate({
            rules: {
                'data[Certification][cdp]': {
                    required: true,
                    digits: true,
                    range: [0, 999999]
                },
                'data[Certification][valor]': {
                    required: true,
                    digits: true,
                    range: [0, 10000000000]
                },
                'data[Certification][poblacion]': {
                    required: true
                }
            }
        });
    });
</script>
<table class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th>Monto total</th>
            <th>Banco</th>
            <th>Número cuenta</th>
            <th>Observación calificación</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><?php echo number_format($evaluacion['Evaluation']['cofinanciacion'], 2, ",", ".") ?></td>
            <td><?php echo $pago['Payment']['nombre_banco']; ?></td>
            <td><?php echo $pago['Payment']['numero_cuenta']; ?></td>
            <td><?php echo $pago['Payment']['observacion_calificacion']; ?></td>
        </tr>
    </tbody>
</table>
<br><br>
<fieldset>
    <?php echo $this->Form->create("Certification", array('novalidate' => '', 'id' => 'formulario', 'role' => "form", "class" => "form", 'enctype' => 'multipart/form-data', 'type' => 'file', 'url' => array("action" => "edit", $this->data['Certification']['id']))); ?>
    <h3>Datos Certificación</h3>
    <?php echo $this->Form->hidden('Certification.id'); ?>
    <?php echo $this->Form->hidden('Certification.payment_id'); ?>
    <?php echo $this->Form->hidden('Certification.user_id', array('value' => $user_id)); ?>
    <?php echo $this->Form->input('Certification.cdp', array('label' => 'CDP', 'class' => 'form-control', 'required' => '', 'type' => 'number')); ?>
    <?php echo $this->Form->input('Certification.rp', array('label' => 'RP', 'class' => 'form-control', 'required' => '', 'type' => 'number')); ?>
    <?php echo $this->Form->input('Certification.valor', array('label' => 'Valor', 'class' => 'form-control', 'required' => '', 'type' => 'number')); ?>
    <?php echo $this->Form->input('Certification.poblacion', array('class' => 'form-control', 'label' => 'Población', 'empty' => 'Seleccione un tipo...', 'options' => array('PDRET' => 'PDRET', 'Victimas' => 'Victimas', 'Contrato plan' => 'Contrato plan'))); ?>
    <?php echo $this->Form->input('Certification.supervisor', array('class' => 'form-control', 'label' => 'Supervisor')); ?>
    <?php echo $this->Form->input('Certification.dependencia', array('class' => 'form-control', 'empty' => 'Seleccione una dependencia...', 'options' => array('Subgerencia de Gestión y Desarrollo Productivo' => 'Subgerencia de Gestión y Desarrollo Productivo', 'Dirección Técnica de Convocatorias' => 'Dirección Técnica de Convocatorias'), 'label' => 'Dependencia')); ?>
    <br>
    <?php echo $this->Form->end(array('label' => "Guardar", 'class' => 'btn btn-default')) ?>
</fieldset>