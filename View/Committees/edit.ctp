<script>
    $(document).ready(function () {
        $("#formulario").validate({
            rules: {
                'data[Committee][valor]': {
                    required: true
                },
                'data[Committee][fecha]': {
                    required: true
                }
            }
        });
    });
    $(function () {
        $("#datepicker").datepicker({
            changeMonth: true,
            changeYear: true,
            yearRange: "2014:2017"
        });
    });
</script>

<fieldset>
    <?php echo $this->Form->create("Committee", array('novalidate' => '', 'id' => 'formulario', 'role' => "form", "class" => "form", 'enctype' => 'multipart/form-data', 'type' => 'file', 'url' => array("action" => "edit", $this->data['Committee']['id']))); ?>
    <?php echo $this->Form->hidden('Committee.id'); ?>
    <?php echo $this->Form->hidden('Committee.proyect_id'); ?>
    <?php echo $this->Form->input('Committee.fecha', array('label' => 'Fecha comité', 'class' => 'form-control', 'required' => '', 'id' => 'datepicker', 'type' => 'text')); ?>
    <?php echo $this->Form->input('Committee.valor', array('label' => 'Valor', 'class' => 'form-control')); ?>
    <?php echo $this->Form->input('Committee.observaciones', array('label' => 'Observaciones', 'class' => 'form-control')); ?>
    <hr> 
    <?php
    echo '<b>Archivo soporte comité de compras </b>'.$this->Form->file("Committee.soporte", array('label' => 'Archivo soporte comité de compras', 'class' => 'form-control',
        'accept' => 'application/pdf',
        'extension' => 'pdf'));
    ?>
    <hr> 
    <?php
    echo '<b>Archivo cotizaciones </b>'.$this->Form->file("Committee.cotizacion", array('label' => 'Archivo cotizaciones', 'class' => 'form-control',
        'accept' => 'application/pdf',
        'extension' => 'pdf'));
    ?>
    <hr> 
    <?php
    echo '<b>Archivo facturas </b>'.$this->Form->file("Committee.factura", array('label' => 'Archivo facturas', 'class' => 'form-control',
        'accept' => 'application/pdf',
        'extension' => 'pdf'));
    ?>
    <hr> 
    <?php echo $this->Form->end(array('label' => "Guardar", 'class' => 'btn btn-default')) ?>
</fieldset>