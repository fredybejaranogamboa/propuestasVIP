<?php echo $this->Form->create("City",array("action"=>"add")); ?>
<?php echo $this->Form->input('City.name',array('label'=>'Nombre','class' =>'required', ));?>
<?php echo $this->Form->input('City.departament_id',array('label'=>'Departamento','class' =>'required', ));?>
<?php echo $this->Form->input('City.divipol',array('label'=>'divipol','class' =>'required', ));?>
<?php echo $this->Form->end("Guardar")?>
