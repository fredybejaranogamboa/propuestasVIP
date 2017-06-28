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
    <?php echo $this->Form->create("Evaluation", array('novalidate' => '', 'id' => 'formulario', 'role' => "form", "class" => "form", 'enctype' => 'multipart/form-data', 'type' => 'file', 'url' => array("action" => "add", $proyect_id))); ?>
    <h3>Datos Evaluación</h3>
    <div>
        <?php echo $this->Form->hidden('Evaluation.proyect_id', array('value' => $proyect_id)); ?>
        <?php echo $this->Form->hidden('Evaluation.user_id', array('value' => $user_id)); ?>
        <?php echo $this->Form->hidden('Evaluation.fecha', array('value' => $fecha)); ?>
        <?php echo $this->Form->input('Evaluation.contrapartida', array('id' => 'entero', 'label' => 'Valor contrapartida', 'class' => 'form-control', 'required' => '', 'type' => 'number')); ?>
        <?php echo $this->Form->input('Evaluation.cofinanciacion', array('id' => 'entero', 'label' => 'Valor cofinanciación', 'class' => 'form-control', 'required' => '', 'type' => 'number')); ?>
        <?php echo $this->Form->input('Evaluation.otras_fuentes', array('id' => 'entero', 'label' => 'Valor otras fuentes', 'class' => 'form-control', 'required' => '', 'type' => 'number')); ?>
        <?php echo $this->Form->input('Evaluation.cofinanciador', array('label' => 'Cofinanciador', 'class' => 'form-control')); ?>
    </div>
    <br><br>
    <table border="0">
        <tbody>
            <tr>
                <td>Plan de negocios</td>
                <td><?php
                    echo $this->Form->file('Evaluation.f10', array('label' => 'Plan de negocios',
                        'class' => 'form-control'));
                    ?></td>
            </tr>
            <tr>
                <td>F11-GI-PPDRET / ANEXO TÉCNICO PLAN DE NEGOCIOS</td>
                <td><?php
                    echo $this->Form->file('Evaluation.f11', array('label' => 'F11-GI-PPDRET ANEXO TÉCNICO PLAN DE NEGOCIOS',
                        'class' => 'form-control',
                        'accept' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                        'aria-required' => 'true',
                        'extension' => 'xlsx'));
                    ?></td>
            </tr>
            <tr>
                <td>Estudios</td>
                <td><?php
                    echo $this->Form->file('Evaluation.estudios', array('label' => 'estudios',
                        'class' => 'form-control',
                        'accept' => 'application/pdf',
                        'aria-required' => 'true',
                        'extension' => 'pdf'));
                    ?></td>
            </tr>
            <tr>
                <td>Diseños</td>
                <td><?php
                    echo $this->Form->file('Evaluation.disenos', array('label' => 'disenos',
                        'class' => 'form-control',
                        'accept' => 'application/pdf',
                        'aria-required' => 'true',
                        'extension' => 'pdf'));
                    ?></td>
            </tr>
            <tr>
                <td>Licencias</td>
                <td><?php
                    echo $this->Form->file('Evaluation.licencias', array('label' => 'licencias',
                        'class' => 'form-control',
                        'accept' => 'application/pdf',
                        'aria-required' => 'true',
                        'extension' => 'pdf'));
                    ?></td>
            </tr>
            <tr>
                <td>Permisos ambientales</td>
                <td><?php
                    echo $this->Form->file('Evaluation.permisos_ambientales', array('label' => 'permisos_ambientales',
                        'class' => 'form-control',
                        'accept' => 'application/pdf',
                        'aria-required' => 'true',
                        'extension' => 'pdf'));
                    ?></td>
            </tr>
            <tr>
                <td>F9-GI-PPDRET / F27-GI-PPDRET Certificación cumplimiento de requisitos de beneficiario</td>
                <td><?php
                    echo $this->Form->file('Evaluation.f27', array('label' => 'Certificación cumplimiento de requisitos de beneficiario F9-GI-PPDRET / F27-GI-PPDRET',
                        'class' => 'form-control',
                        'accept' => 'application/pdf',
                        'aria-required' => 'true',
                        'extension' => 'pdf'));
                    ?></td>
            </tr>
            <tr>
                <td>F22-GI-PPDRET Verificación de aspectos obligatorios para evaluación</td>
                <td><?php
                    echo $this->Form->file('Evaluation.f22', array('label' => 'Verificación de aspectos obligatorios para evaluación F22-GI-PPDRET',
                        'class' => 'form-control',
                        'accept' => 'application/pdf',
                        'aria-required' => 'true',
                        'extension' => 'pdf'));
                    ?></td>
            </tr>
            <tr>
                <td>F30-GI-PPDRET Concepto técnico sobre estudios, diseños y otros</td>
                <td><?php
                    echo $this->Form->file('Evaluation.f30', array('label' => 'Concepto técnico sobre estudios, diseños y otros',
                        'class' => 'form-control',
                        'accept' => 'application/pdf',
                        'aria-required' => 'true',
                        'extension' => 'pdf'));
                    ?></td>
            </tr>
        </tbody>
    </table>
    <br><br>
    <?php echo $this->Form->input('Evaluation.observaciones', array('label' => 'Observaciones', 'class' => 'form-control')); ?>
    <br>
    <?php echo $this->Form->end(array('label' => "Guardar", 'class' => 'btn btn-default')) ?>
</fieldset>