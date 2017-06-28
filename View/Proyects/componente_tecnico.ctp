<div class="panel-heading">
    COMPONENTE TÉCNICO
</div>
<div class="panel-body">
    <div class="row">
        <div class="col-lg-6">
            <?php echo $this->Form->create("Proyect", array('novalidate' => '', 'id' => 'formulario', 'role' => "form", "class" => "form", 'enctype' => 'multipart/form-data', 'type' => 'file', 'url' => array("action" => "componente_tecnico", $this->data['Proyect']['id']))); ?>
            <?php echo $this->Form->hidden('Proyect.id'); ?>

            <?php echo $this->Form->input('Proyect.sistema_productivo', array('label'=>'Sistema productivo','class' => 'form-control')); ?>
            <?php echo $this->Form->input('Proyect.produccion', array('label'=>'Producción actual','class' => 'form-control')); ?>
            <?php echo $this->Form->input('Proyect.rendimiento', array('label'=>'Rendimiento actual','class' => 'form-control')); ?>
            <?php echo $this->Form->input('Proyect.costos', array('label'=>'Costos directos e indirectos','class' => 'form-control')); ?>
            <?php echo $this->Form->input('Proyect.infraestructura', array('label'=>'Infraestructura productiva existente','class' => 'form-control')); ?>

            <?php echo $this->Form->end(array('label' => "Guardar", 'class' => 'btn btn-default')) ?>
        </div>
    </div>
</div>