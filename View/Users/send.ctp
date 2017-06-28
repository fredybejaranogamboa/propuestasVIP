<?php

echo $this->Form->create('User', array('url' => array('controller' => 'users', 'action' => 'send'), 'class'=>'form-signin'));?>
<p>Por favor ingrese la dirección de correo electrónico registrada en el sistema, allí se enviará su usuario y una nueva contraseña</p>
<?php echo $this->Form->input("User.correo", array('label'=>'', 'class'=>"form-control", 'placeholder'=>"Correo", 'required'=>"", 'autofocus'=>"", 'type'=>"email"));
?><br>

<?php
//echo $this->Ajax->submit('Guardar', array('url' => array('controller' => 'Users', 'action' => 'send'), 'update' => 'content','class'=>'btn btn-lg btn-primary btn-block'));
echo $this->Form->end(array('label'=> "ENVIAR", 'class'=>"btn btn-lg btn-primary btn-block"));
?>
<br>
    <?php echo $this->Html->link(
    'REGRESAR',
    array('controller' => 'Users', 'action' => 'login'),
    array('class' => 'glyphicon glyphicon-step-backward')
);?>