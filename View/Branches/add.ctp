<script>
    $(document).ready(function () {
        $("#formulario").validate({
            rules: {
                'data[Branch][email]': {
                    required: true,
                    email: true
                },
                'data[Branch][nombre]': {
                    required: true
                },
                'data[Branch][codigo]': {
                    required: true
                },
                'data[Branch][director]': {
                    required: true
                },
                'data[Branch][capital]': {
                    required: true
                }
            }
        });
    });
</script>
<fieldset>
    <?php echo $this->Form->create("Branch", array('novalidate' => '', 'id' => 'formulario', 'role' => "form", "class" => "form", 'enctype' => 'multipart/form-data', 'type' => 'file', 'url' => array("action" => "add"))); ?>
    <?php echo $this->Form->input('Branch.nombre', array('label' => 'Nombre', 'class' => 'form-control')); ?>
    <?php echo $this->Form->input('Branch.codigo', array('label' => 'Código', 'class' => 'form-control')); ?>
    <?php echo $this->Form->input('Branch.director', array('label' => 'Director', 'class' => 'form-control')); ?>
    <?php echo $this->Form->input('Branch.direccion', array('label' => 'Dirección', 'class' => 'form-control')); ?>
    <?php echo $this->Form->input('Branch.telefono', array('label' => 'Teléfono', 'class' => 'form-control')); ?>
    <?php echo $this->Form->input('Branch.email', array('label' => 'Correo electrónico', 'class' => 'form-control')); ?>
    <?php echo $this->Form->input('Branch.capital', array('label' => 'Capital', 'class' => 'form-control')); ?>
    <?php echo $this->Form->end(array("label" => "Guardar", "class" => "btn btn-default")) ?>
</fieldset>
