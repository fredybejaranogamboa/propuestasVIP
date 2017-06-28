<script>

    $(document).ready(function() {
        jQuery("#fmr").validate({
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit({
                    target: "#familiares",
                    beforeSubmit: function() {
                        $(".submit_button").hide();

                    }
                });
            }
        });
    }

    )
</script>
<div id="familiares">
    <fieldset>
        <?php echo $this->Form->create("Family", array('id' => 'fmr', "action" => "add/$beneficiary_id")); ?>
        <legend>3.1 Composición de la familia: </legend>
        <?php echo $this->Form->hidden('Family.beneficiary_id', array('empty' => '', 'label' => '', 'value' => $beneficiary_id, 'type' => 'text')); ?>
        <?php echo $this->Form->input('Family.tipo_identificacion', array('empty' => '', 'options' => array('C.C' => 'C.C', 'T.I' => 'T.I', 'NUI' => 'NUI'), 'label' => 'Tipo de identificación', 'class' => 'required')); ?>
        <?php echo $this->Form->input('Family.numero_identificacion', array('empty' => '', 'label' => 'Número de identificación', 'class' => 'required', 'type' => 'number')); ?>
        <?php echo $this->Form->input('Family.nombres', array('empty' => '', 'label' => 'Nombres', 'class' => 'required')); ?>
        <?php echo $this->Form->input('Family.primer_apellido', array('empty' => '', 'label' => '3.1.1 Primer Apelllido', 'class' => 'required')); ?>
        <?php echo $this->Form->input('Family.segundo_apellido', array('empty' => '', 'label' => '3.1.1 Segundo Apellido', 'class' => '')); ?>
        <?php echo $this->Form->input('Family.genero', array('empty' => '', 'label' => '3.1.2 Género', 'class' => 'required', 'options' => array('Hombre' => 'Hombre', 'Mujer' => 'Mujer',))); ?>
        <?php echo $this->Form->input('Family.edad', array('empty' => '', 'label' => '3.1.3 Edad', 'type' => 'number')); ?>
        <?php echo $this->Form->input('Family.parentesco', array('empty' => '', 'label' => '3.1.4 Parentesco', 'class' => 'required', 'options' => array('Padre' => 'Padre', 'Madre' => 'Madre', 'Abuelo(a)' => 'Abuelo(a)', 'Hijo(a)' => 'Hijo(a)', 'Hermano(a)' => 'Hermano(a)', 'Nieto(a)' => 'Nieto(a)', 'Tio(a)' => 'Tio(a)', 'Sobrino(a)' => 'Sobrino(a)', 'Ahijado(a)' => 'Ahijado(a)', 'Cuñado(a)' => 'Cuñado(a)', 'Primo(a)' => 'Primo(a)', 'Otro' => 'Otro',))); ?>
        <?php echo $this->Form->hidden('Family.sincronizado', array('value' => 0, 'type' => 'text')); ?>
        <?php echo $this->Form->end(array('label' => "Guardar", 'class' => 'submit_button')) ?>

    </fieldset>
</div>
<table width="100%" border="0"  CellSpacing=10  align="center" >
    <tbody>
        <tr>          
            <td><?php echo $this->Ajax->link($this->Html->image('regresar.gif', array('width' => '30', 'heigth' => '30', 'alt' => 'Regresar', 'title' => 'Regresar')), array('controller' => 'Familys', 'action' => 'index', $beneficiary_id), array('update' => 'content', 'indicator' => 'loading', 'escape' => false)); ?></td>
        </tr>
    </tbody>
</table>