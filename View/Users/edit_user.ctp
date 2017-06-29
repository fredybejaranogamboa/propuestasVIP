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
        $('#fondo').css({'background-image': 'url(css/images/ramdom/' + Math.floor(Math.random() * 23) + '.jpg)'});
    });

</script>


<div id="loading" style="display: none;">
    <?php 
    echo $this->Html->css('modal.css');
    echo $this->Html->image('loading.gif', array('border' => "0", 'align' => 'center')); ?>
</div>
<?php echo $this->Session->flash(); ?>

<div id="fondo">
    

            <?php
            echo $this->Form->create("User", array('novalidate' => '', 'id' => 'formulario', 'role' => "form", "class" => "form-inline", 'enctype' => 'multipart/form-data', 'type' => 'file', 'url' => array("action" => "edit_user", $this->data['User']['id'])));
            echo $this->Form->hidden("User.id");
            echo $this->Form->hidden("User.group_id");
            echo $this->Form->hidden("User.password");
            echo $this->Form->hidden("User.branch_id");
            echo $this->Form->input("User.nombre", array('label' => '', 'class'=>'form-control', 'placeholder' => 'Nombres'));
            echo $this->Form->input("User.primer_apellido", array('label' => '', 'class'=>'form-control', 'placeholder' => 'Primer apellido'));
            echo $this->Form->input("User.segundo_apellido", array('label' => '', 'class'=>'form-control', 'placeholder' => 'Segundo apellido'));
            echo $this->Form->input("User.email", array('label' => '', 'class' => 'form-control', 'type'=>"email",'required' => '', 'placeholder' => 'E-mail'));
            echo $this->Form->input("User.telefono", array('label' => '', 'class'=>'form-control', 'placeholder' => 'Teléfono'));
            echo $this->Form->input("User.password1", array('class'=>'form-control', 'value' => "", 'label' => '', 'type'=>"password", 'placeholder' => 'Contraseña'));
            echo $this->Form->input('User.password_confirm', array('class'=>'form-control', 'label' => '', 'type'=>"password", 'value' => "", 'placeholder' => 'Confirmar contraseña')); ?>
            <br>
            <?php
            echo $this->Form->end(    
                                    array('label' => "Guardar", 'controller' => 'Users', 'action' => 'edit_user', 
                                    'class' => 'btn btn-success',
                                    'update' => 'content', 'indicator' => 'loading')
                                  );
            ?>
        </div>



