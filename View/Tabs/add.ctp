<?php echo $this->Session->flash(); ?>
<?php

echo $this->Form->create('Tab');
echo $this->Form->input("Tab.titulo");
echo $this->Form->input("Tab.icono");
echo $this->Form->input("Tab.orden", array('label' => 'orden'));
echo $this->Ajax->submit('Submit', array('url' => array('controller' => 'Tabs', 'action' => 'add'), 'update' => 'content' ));
echo $this->Form->end();
?>