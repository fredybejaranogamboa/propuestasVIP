<script>
    $(document).ready(function () {
        $("#formulario").validate({
            rules: {
                'data[User][email]': {
                    email: true
                }
            }
        });
    });
</script>
<div id="loading" style="display: none;">
    <?php echo $this->Html->image('loading.gif', array('border' => "0", 'align' => 'center')); ?>
</div>
<?php echo $this->Session->flash(); ?>
<div class="panel-heading">
    Datos usuario
</div>
<div class="panel-body">
    <div class="row">
        <div class="col-lg-6">

<?php
echo $this->Form->create("User", array('novalidate' => '', 'id' => 'formulario', 'role' => "form", "class" => "form", 'enctype' => 'multipart/form-data', 'type' => 'file', 'url' => array("action" => "edit", $this->data['User']['id'])));
echo $this->Form->hidden("User.id");
echo $this->Form->hidden("User.group_id");
echo $this->Form->hidden("User.password");
echo $this->Form->hidden("User.branch_id");
echo $this->Form->input("User.nombre", array('label' => 'Nombre', 'class'=>'form-control'));
echo $this->Form->input("User.primer_apellido", array('label' => 'Primer Apellido', 'class'=>'form-control'));
echo $this->Form->input("User.segundo_apellido", array('label' => 'Segundo Apellido', 'class'=>'form-control'));
echo $this->Form->input("User.email", array('label' => 'Correo electrónico', 'class' => 'form-control', 'type'=>"email",'required' => ''));
echo $this->Form->input("User.telefono", array('label' => 'Teléfono', 'class'=>'form-control'));
echo $this->Form->input("User.password1", array('class'=>'form-control', 'value' => "", 'label' => 'Contraseña', 'type'=>"password"));
echo $this->Form->input('User.password_confirm', array('class'=>'form-control', 'label' => 'Confirmar Contraseña', 'type'=>"password", 'value' => "")); ?>
            <br>
<?php
echo $this->Ajax->submit('Guardar', array('url' => array('controller' => 'Users', 'action' => 'edit_user'), 'update' => 'content', 'indicator' => 'loading', 'class'=>'btn btn-default'));
echo $this->Form->end();
//echo $this->Form->end(array('label' => "Guardar", 'class' => 'btn btn-default'))
?>
        </div>
    </div>
</div>



