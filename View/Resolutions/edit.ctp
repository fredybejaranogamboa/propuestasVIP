<script>
    $(document).ready(function () {
        $("#formulario").validate({
            rules: {
                'data[Resolution][fecha]': {
                    required: true
                },
                'data[Resolution][numero]': {
                    required: true,
                    range: [0, 9999]
                },
                'data[Resolution][numero_acta]': {
                    range: [0, 9999]
                },
                'data[Resolution][tipo]': {
                    required: true
                },
                'data[Resolution][reviso]': {
                    required: true
                },
                'data[Resolution][proyecto]': {
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
    $(function () {
        $("#datepicker1").datepicker({
            changeMonth: true,
            changeYear: true,
            yearRange: "2015:2017"
        });
    });
    $(function () {
        $("#datepicker2").datepicker({
            changeMonth: true,
            changeYear: true,
            yearRange: "2015:2017"
        });
    });
</script>

<fieldset>
    <?php echo $this->Form->create("Resolution", array('novalidate' => '', 'id' => 'formulario', 'role' => "form", "class" => "form", 'enctype' => 'multipart/form-data', 'type' => 'file', 'url' => array("action" => "edit", $this->data['Resolution']['id']))); ?>
    <?php echo $this->Form->hidden('Resolution.id'); ?>
    <?php echo $this->Form->hidden('Resolution.proyect_id'); ?>
    <?php echo $this->Form->input('Resolution.fecha', array('label' => 'Fecha resolución', 'class' => 'form-control', 'required' => '', 'id' => 'datepicker', 'type' => 'text')); ?>
    <?php echo $this->Form->input('Resolution.numero', array('label' => 'Número resolución', 'class' => 'form-control', 'required' => '', 'type' => 'number')); ?>
    <?php
    if ($cont > 0 and $this->data['Resolution']['tipo'] != 'ADJUDICACIÓN') {
        echo $this->Form->input('Resolution.tipo', array('class' => 'form-control', 'label' => 'Tipo de resolución', 'empty' => 'Seleccione un tipo...', 'options' => array('MODIFICATORIA O ACLARATORIA' => 'MODIFICATORIA O ACLARATORIA', 'REVOCATORIA' => 'REVOCATORIA')));
    } else {
        echo $this->Form->input('Resolution.tipo', array('class' => 'form-control', 'label' => 'Tipo de resolución', 'empty' => 'Seleccione un tipo...', 'options' => array('ADJUDICACIÓN' => 'ADJUDICACIÓN', 'MODIFICATORIA O ACLARATORIA' => 'MODIFICATORIA O ACLARATORIA', 'REVOCATORIA' => 'REVOCATORIA')));
    }
    ?>
    <?php echo $this->Form->input('Resolution.reviso', array('label' => 'Nombre de quien revisó la resolución', 'class' => 'form-control')); ?>
    <?php echo $this->Form->input('Resolution.proyecto', array('label' => 'Nombre de la persona que proyectó la resolución', 'class' => 'form-control')); ?>
    <?php echo $this->Form->input('Resolution.comentario', array('label' => 'Comentario sobre la resolución expedida', 'class' => 'form-control')); ?>
    <?php
    echo $this->Form->file("Resolution.archivo", array('label' => 'Archivo de resolución escaneado', 'class' => 'form-control',
        'accept' => 'application/pdf',
        'extension' => 'pdf'));
    ?>
    <br>
    <?php if ($this->data['Resolution']['tipo'] == 'ADJUDICACIÓN'): ?>
        <h3>Datos Acta Comité Técnico Territorial</h3>
        <?php echo $this->Form->input('Resolution.fecha_acta', array('label' => 'Fecha acta', 'class' => 'form-control', 'id' => 'datepicker1', 'type' => 'text')); ?>
        <?php echo $this->Form->input('Resolution.numero_acta', array('label' => 'Número acta', 'class' => 'form-control', 'type' => 'number')); ?>
        <br>
        <h3>Datos convenio interadministrativo</h3>
        <?php echo $this->Form->input('Resolution.fecha_convenio', array('label' => 'Fecha', 'class' => 'form-control', 'id' => 'datepicker2', 'type' => 'text')); ?>
        <?php echo $this->Form->input('Resolution.numero_convenio', array('label' => 'Número', 'class' => 'form-control', 'type' => 'number')); ?>
    <?php endif; ?>


    <?php if ($permitir) echo $this->Form->end(array('label' => "Guardar", 'class' => 'btn btn-default')) ?>
</fieldset>