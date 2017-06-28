<script>
    $(document).ready(function () {
        $("#formulario").validate({
            rules: {
                'data[Agreement][valor_incoder]': {
                    required: true
                },
                'data[Agreement][valor_suscriptor]': {
                    required: true
                },
                'data[Agreement][numero]': {
                    required: true
                },
                'data[Agreement][fecha]': {
                    required: true
                },
                'data[Agreement][suscriptor]': {
                    required: true
                }
            }
        });
    });
    $(function () {
        $("#datepicker").datepicker({
            changeMonth: true,
            changeYear: true,
            yearRange: "2015:2017"
        });
    });
</script>
<fieldset>
    <?php echo $this->Form->create("Agreement", array("class" => "form", "id" => "formulario", 'enctype' => 'multipart/form-data', 'type' => 'file', 'url' => array("action" => "add"))); ?>
    <?php echo $this->Form->input('Agreement.valor_incoder', array('label' => 'Valor INCODER', 'class' => 'form-control')); ?>
    <?php echo $this->Form->input('Agreement.valor_suscriptor', array('label' => 'Valor suscriptor', 'class' => 'form-control')); ?>
    <?php echo $this->Form->input('Agreement.numero', array('label' => 'Número', 'class' => 'form-control')); ?>
    <?php echo $this->Form->input('Agreement.fecha', array('label' => 'Fecha suscripción', 'class' => 'form-control', 'id' => 'datepicker', 'type' => 'text')); ?>
    <?php echo $this->Form->input('Agreement.suscriptor', array('label' => 'Suscriptor', 'class' => 'form-control')); ?>
    <br>
    <?php
    echo $this->Form->file('Agreement.archivo', array('label' => 'Archivo soporte',
        'class' => 'form-control',
        'accept' => 'application/pdf',
        'aria-required' => 'true',
        'required' => 'true',
        'extension' => 'pdf'));
    ?>
    <br><br>
    <?php echo $this->Form->input('Agreement.comentario', array('label' => 'comentario', 'class' => 'form-control')); ?>
    <?php echo $this->Form->end(array('label' => "Guardar", 'class' => 'btn btn-default')) ?>
</fieldset>