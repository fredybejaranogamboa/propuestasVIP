<script>
    $(document).ready(function () {
        $("#formulario").validate();
    });
    $(".selectpicker").selectpicker().selectpicker("render");
    $(function () {
        $("#datepicker").datepicker({
            changeMonth: true,
            changeYear: true,
            yearRange: "2016:2017"
        });
    });
</script>

<div class="panel-heading">
    Datos Proyecto
</div>
<div class="panel-body">
    <div class="row">
        <div class="col-lg-6">
            <?php echo $this->Form->create("Proyect", array('novalidate' => '', 'id' => 'formulario', 'role' => "form", "class" => "form", 'enctype' => 'multipart/form-data', 'type' => 'file', 'url' => array("action" => "add"))); ?>

            <?php echo $this->Form->input('Proyect.codigo', array('required' => '', 'class' => 'form-control')); ?>
            <?php echo $this->Form->input('Proyect.nombre', array('required' => '', 'class' => 'form-control')); ?>
            <?php echo $this->Form->input('Proyect.fecha_radicacion', array('label' => 'Fecha radicación', 'class' => 'form-control', 'required' => '', 'id' => 'datepicker', 'type' => 'text')); ?>
            <?php echo $this->Form->input('Proyect.objetivo', array('required' => '', 'class' => 'form-control')); ?>
            <h3>INFORMACION GENERAL DE LA ZONA DONDE SE IMPLEMENTARA EL PROYECTO</h3>            
            <?php echo $this->Form->input('Proyect.fuentes_hidricas', array('required' => '', 'class' => 'form-control')); ?>
            <?php echo $this->Form->input('Proyect.macroeconomica', array('label'=>' Información Macroeconómica de la Región: (Municipio y Departamento):','required' => '', 'class' => 'form-control')); ?>
            <?php echo $this->Form->input('Proyect.geografia', array('label'=>' Geografía del municipio (Breve descripción Temperatura-°C; m.s.n.m.; distancia referencia; vías de comunicación):','required' => '', 'class' => 'form-control')); ?>
            <?php echo $this->Form->input('Proyect.economia', array('label'=>' Economía del Municipio (Breve descripción de las actividades económicas del Municipio):','required' => '', 'class' => 'form-control')); ?>
            <?php echo $this->Form->input('Proyect.valor_solicitado', array('required' => '', 'class' => 'form-control')); ?>
            <?php echo $this->Form->input('Proyect.tipo', array('label' => 'Tipo', 'class' => 'form-control', 'required' => '', 'empty' => 'Seleccione un tipo', 'options' => array('A' => 'Asociativo', 'T' => 'Territorial', 'N' => 'Estrategico nacional'))); ?>
            <?php echo $this->Form->input('Proyect.estado', array('label' => 'Estado', 'class' => 'form-control', 'required' => '', 'empty' => 'Seleccione un estado', 'options' => array(
                'Radicación' => 'Radicación', 
                'Estructuración' => 'Estructuración', 
                'Evaluación' => 'Evaluación', 
                'Cofinanciación' => 'Cofinanciación', 
                'Seguimiento y control' => 'Seguimiento y control', 
                'Liquidación' => 'Liquidación'
                ))); ?>            
            <?php echo $this->Form->input('Proyect.call_id', array('label' => 'Convocatoria', 'required' => '', 'empty' => 'Seleccione una convocatoria', 'class' => 'form-control')); ?>
            <?php //echo $this->Form->input('Proyect.departament_id', array('label' => 'Departamento', 'required' => '', 'empty' => 'Seleccione departamento', 'class' => 'form-control selectpicker', "data-live-search"=>"true")); ?>
            <?php echo $this->Form->input('Proyect.asociation_id', array('label' => 'Asociación', 'required' => '', 'empty' => 'Seleccione asociación', 'class' => 'form-control selectpicker', "data-live-search"=>"true")); ?>
            <?php //echo $this->Form->input('Proyect.branch_id', array('label' => 'Territorial - organización', 'required' => '', 'empty' => 'Seleccione territorial u organización', 'class' => 'form-control')); ?>
            <?php //echo $this->Form->input('Proyect.agreement_id', array('label' => 'Convenio', 'empty' => 'Seleccione acuerdo', 'class' => 'form-control')); ?>
            <br>
            <?php
            echo "Documento Anexo";
            echo $this->Form->file('Proyect.archivo_propuesta', array('label' => 'Adjuntar archivo propuesta',
                'class' => 'form-control',
                'accept' => 'application/pdf',
                'extension' => 'pdf'
            ));
            ?>
            <br>
            <?php echo $this->Form->end(array('label' => "Guardar", 'class' => 'btn btn-default')) ?>
        </div>
    </div>
</div>