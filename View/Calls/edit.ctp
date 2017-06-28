<?php echo $this->Form->create("Call",array("class"=>"form",  "action"=>"edit/".$this->data['Call']['id'])); ?>
<?php echo $this->Form->input('Call.id',array('label'=>'id','class' =>''    ));?>
<?php echo $this->Form->input('Call.nombre',array('label'=>'Nombre','class' =>'required'    ));?>

<?php echo $this->Form->end("Guardar")?>
