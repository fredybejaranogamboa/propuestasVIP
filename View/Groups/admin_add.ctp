<?php echo $this->Session->flash(); ?>
<?php
echo $this->Form->create('Group');
echo $this->Form->input("Group.name", array('label'=>'Nombre'));
echo $this->Ajax->submit('Guardar', array('url' => array('controller' => 'Groups', 'action' => 'add'), 'update' => 'content', 'indicator'=>'loading'));
echo $this->Form->end();
?>
