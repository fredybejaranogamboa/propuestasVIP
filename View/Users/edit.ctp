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
<fieldset>
    <?php
    echo $this->Form->create("User", array('novalidate' => '', 'id' => 'formulario', 'role' => "form", "class" => "form", 'enctype' => 'multipart/form-data', 'type' => 'file', 'url' => array("action" => "edit", $this->data['User']['id'])));
    echo $this->Form->hidden("User.id");
    echo $this->Form->input("User.nombre", array('label' => 'Nombres', 'class' => 'form-control', 'required' => ''));
    echo $this->Form->input("User.primer_apellido", array('label' => 'Primer Apellido', 'class' => 'form-control', 'required' => ''));
    echo $this->Form->input("User.segundo_apellido", array('label' => 'Segundo Apellido', 'class' => 'form-control'));
    echo $this->Form->input("User.email", array('label' => 'Correo electrónico', 'class' => 'form-control', 'type'=>"email",'required' => ''));
    echo $this->Form->input("User.telefono", array('label' => 'Teléfono', 'class' => 'form-control'));
    echo $this->Form->input("User.cedula", array('label' => 'Cédula', 'class' => 'form-control', 'required' => ''));
    echo $this->Form->input("User.username", array('label' => 'Nombre De Usuario', 'class' => 'form-control', 'required' => ''));
    echo $this->Form->input("User.group_id", array('label' => 'Grupo', 'class' => 'form-control', 'required' => '', 'empty' => ''));
    echo $this->Form->input("User.branch_id", array('label' => 'Entidad', 'class' => 'form-control', 'required' => '', 'empty' => ''));
    echo $this->Form->input("User.tipo", array('label' => 'Tipo', 'class' => 'form-control', 'required' => '', 'empty' => '', 'options' => array('Asociativo' => 'Asociativo', 'Familiar' => 'Familiar', 'Territorial' => 'Territorial', 'Global' => 'Global')));
    ?>
    <?php echo $this->Form->end(array('label' => "Guardar", 'class' => 'btn btn-default')) ?>
</fieldset>