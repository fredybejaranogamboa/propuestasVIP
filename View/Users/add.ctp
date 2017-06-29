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
    $(function () {
        $('#fondo').css({'background-image': 'url(css/images/ramdom/' + Math.floor(Math.random() * 22) + '.jpg)'});
    });
</script>
<div id="loading" style="display: none;">
    <?php 
    echo $this->Html->css('modal.css');
    echo $this->Html->image('loading.gif', array('border' => "0", 'align' => 'center')); 
    ?>
</div>
<?php echo $this->Session->flash(); ?>

<div id="fondo">
    <?php


    echo $this->Form->create("User", array('novalidate' => '', 'id' => 'formulario', 'role' => "form", "class" => "form-inline", 'enctype' => 'multipart/form-data', 'type' => 'file', 'url' => array("action" => "add")));

    echo $this->Form->input("User.nombre", array('label' => '', 'class' => 'form-control', 'required' => '', 'placeholder' => 'Nombres'));
    echo $this->Form->input("User.primer_apellido", array('label' => '', 'class' => 'form-control', 'required' => '', 'placeholder' => 'Primer apellido'));
    echo $this->Form->input("User.segundo_apellido", array('label' => '', 'class' => 'form-control', 'placeholder' => 'Segundo apellido'));
    echo $this->Form->input("User.email", array('label' => '', 'class' => 'form-control', 'type'=>"email",'required' => '', 'placeholder' => 'E-mail'));
    echo $this->Form->input("User.telefono", array('label' => '', 'class' => 'form-control', 'placeholder' => 'Telefono'));
    echo $this->Form->input("User.cedula", array('label' => '', 'class' => 'form-control', 'required' => '', 'placeholder' => 'Cédula'));
    echo $this->Form->input("User.username", array('label' => '', 'class' => 'form-control', 'required' => '', 'placeholder' => 'Nombre de usuario'));
    echo $this->Form->input("User.group_id", array('label' => '', 'class' => 'form-control', 'required' => '', 'empty' => 'Seleccione grupo'));
    echo $this->Form->input("User.branch_id", array('label' => '', 'class' => 'form-control', 'required' => '', 'empty' => 'Seleccione entidad', 'align' => 'center'));
    echo $this->Form->input("User.tipo", array('label' => '', 'class' => 'form-control', 'required' => '', 'empty' => 'Seleccione un tipo', 'options' => array('Asociativo' => 'Asociativo', 'Familiar' => 'Familiar', 'Territorial' => 'Territorial', 'Global' => 'Global')));
    ?>
    <?php 
    echo $this->Form->end(array('label' => "Guardar", 'class' => 'btn btn-success'));

    ?>

</div>