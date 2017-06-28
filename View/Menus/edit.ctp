<script>
    $(document).ready(function () {
        $("#formulario").validate({
            rules: {
                'data[Menu][nombre]': {
                    required: true
                },
                'data[Menu][icono]': {
                    required: true
                },
                'data[Menu][orden]': {
                    required: true,
                    digits: true,
                    range: [0, 100]
                }
            }
        });
    });
</script>
<fieldset>
    <?php
    echo $this->Form->create("Menu", array('novalidate' => '', 'id' => 'formulario', 'role' => "form", "class" => "form", 'enctype' => 'multipart/form-data', 'type' => 'file', 'url' => array("action" => "edit", $this->data['Menu']['id'])));
    echo $this->Form->hidden("Menu.id");
    echo $this->Form->input("Menu.nombre", array('class' => 'form-control'));
    echo $this->Form->input("Menu.icono", array('class' => 'form-control'));
    echo $this->Form->input("Menu.orden", array('class' => 'form-control'));
    echo $this->Form->end(array('label' => "Guardar", 'class' => 'btn btn-default'));
    ?>
</fieldset>