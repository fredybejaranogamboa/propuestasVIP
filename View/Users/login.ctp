<?php
echo $this->Form->create('User', array('url' => array('controller' => 'users', 'action' => 'login'), 'class' => 'form-signin'));
?>

<h3 class="form-signin-heading">Aplicativo recepción de propuestas Vicepresidencia de integración productiva</h3>
<hr class="colorgraph"><br>
<?php echo $this->Form->input('User.username', array('label' => '', 'type' => "text", 'class' => "form-control", 'placeholder' => "Usuario", 'required' => "", 'autofocus' => "")); ?>
<?php echo $this->Form->input('User.password', array('label' => '', 'type' => "password", 'class' => "form-control", 'placeholder' => "Contraseña", 'required' => "")); ?>
<?php
echo $this->Html->link(
        '¿Olvidó su usuario o contraseña?', array('controller' => 'Users', 'action' => 'send'), array('update' => 'content', 'class' => 'btn btn-lg btn-primary btn-block')
);
?>
<?php
$aleatorio = rand(1111, 9999999);
echo $this->Html->link(
        '  Documento Guía', "../files/guia.pdf", array('target' => 'blank', 'indicator' => 'loading', 'class' => 'btn btn-lg btn-primary btn-block', 'download' => "guia-" . $aleatorio . ".pdf"));
?>
<?php echo $this->Form->end(array('label' => "INGRESAR", 'class' => "btn btn-lg btn-primary btn-block")) ?>


