<script>
    
    $(document).ready(function() {
        
        
        jQuery("#formulario").validate({
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit({
                    target: "#conyuge"
                });
            }
        });  }
        
)

    $(function () {
        $("#datepicker").datepicker({
            changeMonth: true,
            changeYear: true,
            yearRange: "1909:2005"
        });
    });
</script>
<div id="conyuge">

    <fieldset>
        <?php echo $this->Form->create("Beneficiary", array("id" => "formulario", 'enctype' => 'multipart/form-data', 'type' => 'file','url'=>array(  "action" => "add_conyuge",$beneficiary_id ))); ?>
        <?php echo $this->Form->hidden('Beneficiary.sincronizado', array('value' => 0)); ?>
        <?php echo $this->Form->input('Beneficiary.tipo_identificacion', array('label' => 'Tipo identificación', 'class' => 'required', 'empty' => '', 'options' => array('C.C' => 'C.C', 'T.I' => 'T.I', 'NUI' => 'NUI'))); ?>
        <?php echo $this->Form->input('Beneficiary.numero_identificacion', array('label' => 'Número identificación', 'class' => 'required', 'type' => 'number')); ?>
        <?php echo $this->Form->input('Beneficiary.nombres', array('label' => 'Nombres', 'class' => '')); ?>
        <?php echo $this->Form->input('Beneficiary.primer_apellido', array('label' => 'Primer apellido', 'class' => '')); ?>
        <?php echo $this->Form->input('Beneficiary.segundo_apellido', array('label' => 'Segundo apellido', 'class' => '')); ?>
        <?php echo $this->Form->input('Beneficiary.genero', array('label' => 'Género', 'class' => '', 'empty' => '', 'options' => array('Masculino' => 'Masculino', 'Femenino' => 'Femenino'))); ?>
        <?php echo $this->Form->input('Beneficiary.tipo', array('label' => 'Tipo beneficiario', 'class' => '', 'empty' => '', 'options' => array('Campesino' => 'Campesino', 'Desplazado' => 'Desplazado', 'Indigena' => 'Indigena', 'Rom' => 'Rom', 'Negritudes' => 'Negritudes', 'Mujer cabeza de familia' => 'Mujer cabeza de familia'))); ?>
        <?php echo $this->Form->input('Beneficiary.fecha_nacimiento', array('label' => 'Fecha nacimiento', 'class' => 'calendario', 'type' => 'text')); ?>
        <?php echo $this->Form->input('Beneficiary.numero_resolucion', array('label' => 'Numero de la resolucion de adjudicación', 'class' => '')); ?>
        <?php echo $this->Form->input('Beneficiary.fecha_resolucion', array('label' => 'Fecha  la resolucion de adjudicación', 'class' => 'calendario', 'type' => 'text')); ?>
        <?php echo $this->Form->input('Beneficiary.telefono', array('label' => 'Teléfono', 'class' => '')); ?>
        <?php echo $this->Form->input('Beneficiary.direccion', array('label' => 'Dirección', 'class' => '')); ?>
        <?php echo $this->Form->hidden('Beneficiary.beneficiary_id', array('value' => $beneficiary_id)); ?>
        <?php echo $this->Form->end(array('label' => "Guardar", 'class' => 'submitButton')) ?>
    </fieldset>
</div>