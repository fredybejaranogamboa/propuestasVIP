<script>
    $(document).ready(function () {
        $("#formulario").validate({
            rules: {
                'data[Point][grados_latitud]': {
                    range: [-4, 16],
                    required: true
                },
                'data[Point][minutos_latitud]': {
                    range: [0, 59],
                    required: true
                },
                'data[Point][segundos_latitud]': {
                    range: [0, 59.9999],
                    required: true
                },
                'data[Point][grados_longitud]': {
                    range: [66, 82],
                    required: true
                },
                'data[Point][minutos_longitud]': {
                    range: [0, 59],
                    required: true
                },
                'data[Point][segundos_longitud]': {
                    range: [0, 59.9999],
                    required: true
                },
                'data[Point][altitud]': {
                    range: [-400, 3500],
                    required: true
                }
            }
        });
    });

</script>
<?php echo $this->Form->create("Point", array('novalidate'=>'','id'=>'formulario','role'=>"form","class" => "form", 'enctype' => 'multipart/form-data', 'type' => 'file', 'url' => array("action" => "edit", $this->data['Point']['id']))); ?>

<fieldset>
    <?php echo $this->Form->hidden('Point.property_id'); ?>
    <?php echo $this->Form->hidden('Point.id'); ?>

    <?php echo $this->Form->input('Point.grados_latitud', array('label' => 'Grados Latitud', 'class' => 'form-control')); ?>
    <?php echo $this->Form->input('Point.minutos_latitud', array('label' => 'Minutos Latitud', 'class' => 'form-control')); ?>
    <?php echo $this->Form->input('Point.segundos_latitud', array('label' => 'Segundos Latitud', 'class' => 'form-control')); ?>

    <?php echo $this->Form->input('Point.grados_longitud', array('label' => 'Grados Longitud', 'class' => 'form-control')); ?>
    <?php echo $this->Form->input('Point.minutos_longitud', array('label' => 'Minutos Longitud', 'class' => 'form-control')); ?>
    <?php echo $this->Form->input('Point.segundos_longitud', array('label' => 'Segundos Longitud', 'class' => 'form-control')); ?>

    <?php echo $this->Form->input('Point.altitud', array('label' => 'Altitud', 'class' => 'form-control')); ?>

    <?php echo $this->Form->file('Point.fotografia', array('label' => 'Adjuntar fotografía', 'class' =>'form-control',
    'accept' => 'image/jpeg',
    'aria-required' => 'true',
    'extension' => 'jpg')); ?>

    <?php echo $this->Form->end(array('label' => 'Guardar','class' => 'btn btn-default'))?>
</fieldset>