<script>
    $(document).ready(function () {
        $("#formulario").validate();
    });
    $(function () {
        $("#datepicker").datepicker({
            changeMonth: true,
            changeYear: true,
            yearRange: "2015:2017"
        });
    });
    $(function () {
        $("#datepicker1").datepicker({
            changeMonth: true,
            changeYear: true,
            yearRange: "2015:2017"
        });
    });
</script>
<?php echo $this->Form->create("Payment", array('novalidate' => '', 'id' => 'formulario', 'role' => "form", "class" => "form", 'enctype' => 'multipart/form-data', 'type' => 'file', 'url' => array("action" => "dates", $this->data['Payment']['id']))); ?>
<?php echo $this->Form->hidden('Payment.id'); ?>
<?php echo $this->Form->hidden('Payment.proyect_id'); ?>

<?php echo $this->Form->input('Payment.fecha_solicitud', array('label' => 'Fecha solicitud', 'class' => 'form-control', 'id' => 'datepicker', 'type' => 'text')); ?>
<?php echo $this->Form->input('Payment.fecha_desembolso', array('label' => 'Fecha desembolso', 'class' => 'form-control', 'id' => 'datepicker1', 'type' => 'text')); ?>
<table class="table table-striped table-bordered table-hover">
    <tbody>
    <td colspan="5"><center>
        <h3>INFORMACIÓN DEL PAGO</h3>
    </center></td>
<tr>
    <td>
        Valor:<br>
        <?php echo number_format($Payment['Evaluation']['cofinanciacion'], 2, ",", ".") ?>
    </td>
    <td>
        Fecha solicitud:<br>
        <?php echo $Payment['Payment']['fecha_solicitud'] ?>
    </td>
    <td>
        Fecha desembolso :<br>
        <?php echo $Payment['Payment']['fecha_desembolso'] ?>
    </td>
    <td>
        Usuario que ingreso la información:<br>
        <?php echo $Payment['User']['nombre'], " ", $Payment['User']['primer_apellido'] ?>
    </td>
</tr> 
<tr>
    <td>
        Banco:<br>
        <?php echo $Payment['Payment']['nombre_banco'] ?>
    </td>
    <td>
        Número cuenta:<br>
        <?php echo $Payment['Payment']['numero_cuenta'] ?>
    </td>
    <td colspan="2">
        Tipo cuenta:<br>
        <?php echo $Payment['Payment']['tipo_cuenta'] ?>
    </td>
</tr>
<tr>
    <td colspan="2">
        Asociación:<br>
        <?php echo $asociation['Asociation']['nombre'] . " - " . $asociation['Asociation']['nit'] ?>
    </td>
    <td colspan="2">
        Beneficiario:<br>
        <?php echo $beneficiary['Beneficiary']['primer_apellido'] . " - " . $beneficiary['Beneficiary']['segundo_apellido'] . " " . $beneficiary['Beneficiary']['nombres'] ?>
    </td>
</tr></tbody>
</table>
<?php echo $this->Form->end(array('label' => "GUARDAR", 'class' => 'btn btn-default')); ?>