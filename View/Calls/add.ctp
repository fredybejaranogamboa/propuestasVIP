<?php echo $this->Form->create("Call",array("class"=>"form",  "action"=>"add")); ?>
<?php echo $this->Form->input('Call.nombre',array('label'=>'Nombre','class' =>'required'    ));?>

<?php echo $this->Form->end("Guardar")?>
