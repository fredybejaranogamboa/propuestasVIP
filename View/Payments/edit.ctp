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
<fieldset>
    <?php echo $this->Form->create("Payment", array('novalidate' => '', 'id' => 'formulario', 'role' => "form", "class" => "form", 'enctype' => 'multipart/form-data', 'type' => 'file', 'url' => array("action" => "edit", $this->data['Payment']['id']))); ?>
    <h3>Datos Pago : <?php echo number_format($cofinanciacion['Evaluation']['cofinanciacion'], 2, ",", ".") ?></h3>
    <div>
        <?php echo $this->Form->hidden('Payment.id'); ?>
        <?php echo $this->Form->hidden('Payment.proyect_id'); ?>
        <?php echo $this->Form->hidden('Payment.user_id', array('value' => $user_id)); ?>
        <?php echo $this->Form->input('Payment.nombre_banco', array('label' => 'Nombre banco', 'class' => 'form-control', 'required' => '')); ?>
        <?php echo $this->Form->input('Payment.numero_cuenta', array('label' => 'Número cuenta', 'class' => 'form-control', 'required' => '')); ?>
        <?php echo $this->Form->input('Payment.tipo_cuenta', array('label' => 'Tipo cuenta', 'class' => 'form-control', 'required' => '', 'empty' => 'Tipo cuenta', 'options' => array('Corriente' => 'Corriente', 'Ahorros' => 'Ahorros'))); ?>
        <?php
        //creo el array de options para el select incluyendo los aspirantes principales
        //$optionsAsociations = array();
        //foreach ($asociations as $asociation) {
          //  $optionsAsociations[$asociation['Asociation']['id']] = $asociation['Asociation']['nombre'] . " - " . $asociation['Asociation']['nit'];
       // }
       // echo $this->Form->input('Payment.asociation_id', array('label' => 'Asociación', 'empty' => 'Seleccione una asociación', 'options' => $optionsAsociations, 'class' => 'form-control'));
        ?>  
        <?php
        //creo el array de options para el select incluyendo los aspirantes principales
        $optionsBeneficiaries = array();
        foreach ($beneficiaries as $beneficiary) {
            $optionsBeneficiaries[$beneficiary['Beneficiary']['id']] = $beneficiary['Beneficiary']['primer_apellido'] . " " . $beneficiary['Beneficiary']['segundo_apellido'] . " " . $beneficiary['Beneficiary']['nombres'];
        }
        echo $this->Form->input('Payment.beneficiary_id', array('label' => 'Representante', 'empty' => 'Seleccione un beneficiario', 'options' => $optionsBeneficiaries, 'class' => 'form-control'));
        ?>  
    </div>
    <br><br>
    <table>
        <tbody>
            <tr>
                <td>Poliza</td>
                <td><?php
                    echo $this->Form->file('Payment.poliza', array('label' => 'Poliza',
                        'class' => 'form-control',
                        'accept' => 'application/pdf',
                        'extension' => 'pdf'));
                    ?></td>
            </tr>
            <tr>
                <td>Acta aprobación poliza</td>
                <td><?php
                    echo $this->Form->file('Payment.acta_aprobacion_poliza', array('label' => 'Acta aprobación poliza',
                        'class' => 'form-control',
                        'accept' => 'application/pdf',
                        'extension' => 'pdf'));
                    ?></td>
            </tr>
            <tr>
                <td>Certificación bancaria</td>
                <td><?php
                    echo $this->Form->file('Payment.certificacion_bancaria', array('label' => 'Certificación bancaria',
                        'class' => 'form-control',
                        'accept' => 'application/pdf',
                        'extension' => 'pdf'));
                    ?></td>
            </tr>
            <tr>
                <td>Notificación</td>
                <td><?php
                    echo $this->Form->file('Payment.notificacion', array('label' => 'Notificación',
                        'class' => 'form-control',
                        'accept' => 'application/pdf',
                        'extension' => 'pdf'));
                    ?></td>
            </tr>
            <tr>
                <td>Poder</td>
                <td><?php
                    echo $this->Form->file('Payment.poder', array('label' => 'Poder',
                        'class' => 'form-control',
                        'accept' => 'application/pdf',
                        'extension' => 'pdf'));
                    ?></td>
            </tr>
            <tr>
                <td>F12 Revisión equipo técnico</td>
                <td><?php
                    echo $this->Form->file('Payment.f12', array('label' => 'F12 Revisión equipo técnico',
                        'class' => 'form-control',
                        'accept' => 'application/pdf',
                        'extension' => 'pdf'));
                    ?></td>
            </tr>
            <tr>
                <td>Certificación cuenta gobernación</td>
                <td><?php
                    echo $this->Form->file('Payment.cuenta_gobernacion', array('label' => 'Certificación cuenta gobernación',
                        'class' => 'form-control',
                        'accept' => 'application/pdf',
                        'extension' => 'pdf'));
                    ?></td>
            </tr>
            <tr>
                <td>CDP respaldo contrapartida</td>
                <td><?php
                    echo $this->Form->file('Payment.cdp_respaldo', array('label' => 'CDP respaldo contrapartida',
                        'class' => 'form-control',
                        'accept' => 'application/pdf',
                        'extension' => 'pdf'));
                    ?></td>
            </tr>
            <tr>
                <td>Poder representación asociaciones</td>
                <td><?php
                    echo $this->Form->file('Payment.poder_asociaciones', array('label' => 'Poder representación asociaciones',
                        'class' => 'form-control',
                        'accept' => 'application/pdf',
                        'extension' => 'pdf'));
                    ?></td>
            </tr>
        </tbody>
    </table>
    <br>
    <?php
    if ($this->data['Payment']['calificacion_final'] != 'Cumple') {
        echo $this->Form->end(array('label' => "Guardar", 'class' => 'btn btn-default'));
    } else {
        echo $this->Form->end();
    }
    ?>
</fieldset>