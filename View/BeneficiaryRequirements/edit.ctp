<script>
    $(function() {
        $("#formAspirantes").validate({
            submitHandler: function(form) {
                $(form).ajaxSubmit({
                    target: "#aspirantes",
                    beforeSubmit: function() {
                        $(".submit_button").hide();
                    }
                });
            }
        });
    }
    );
</script>
<fieldset><legend><?php echo $this->data['InitialRequirement']['texto'] ?></legend>
    <?php echo $this->Form->create("BeneficiaryRequirement", array("id" => "formAspirantes", "action" => "edit")); ?>
    <?php echo $this->Form->hidden('BeneficiaryRequirement.id'); ?>
    <?php echo $this->Form->input('BeneficiaryRequirement.id', array('label' => 'id')); ?>
    <?php echo $this->Form->input('BeneficiaryRequirement.calificacion', array('label' => 'calificación', 'class' => 'required', 'empty' => '', 'options' => array('Cumple' => 'Cumple', 'No cumple' => 'No cumple'))); ?>
    <?php echo $this->Form->input('BeneficiaryRequirement.concepto', array('label' => 'concepto', 'class' => 'required')); ?>
    <?php echo $this->Form->hidden('BeneficiaryRequirement.initial_requirement_id', array('label' => 'initial_requirement_id')); ?>
    <?php echo $this->Form->hidden('BeneficiaryRequirement.beneficiary_id', array('label' => 'beneficiary_id')); ?>
    <?php echo $this->Form->hidden('BeneficiaryRequirement.sincronizado', array('value' => 0)); ?>
    <table border="0" style="width: 40%">

        <tbody>
            <tr>
                <td>  <?php echo $this->Form->end(array('label' => "Guardar y continuar", 'class' => 'submitButton', 'div' => false)) ?></td>
                <td><br>
                    <?php echo $this->Ajax->link("Regresar al listado", array('controller' => 'BeneficiaryREquirements', "action" => "index", $this->data['BeneficiaryRequirement']['beneficiary_id']), array('update' => 'aspirantes', 'indicator' => 'loading', 'class' => 'acciones')) ?>

                </td>
            </tr>

        </tbody>
    </table>


</fieldset>
<br>