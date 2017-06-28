<script>
    $(document).ready(function () {
        $("#formulario").validate({
            rules: {
                'data[Item][nombre]': {
                    required: true
                },
                'data[Item][controlador]': {
                    required: true
                },
                'data[Item][accion]': {
                    required: true
                },
                'data[Item][menu_id]': {
                    required: true
                }
            }
        });
    });
</script>
<fieldset>
    <?php
    echo $this->Form->create("Item", array('novalidate' => '', 'id' => 'formulario', 'role' => "form", "class" => "form", 'enctype' => 'multipart/form-data', 'type' => 'file', 'url' => array("action" => "edit", $this->data['Item']['id'])));
    echo $this->Form->hidden("Item.id");
    echo $this->Form->input("Item.orden", array('class' => 'form-control'));
    echo $this->Form->input("Item.nombre", array('class' => 'form-control'));
    echo $this->Form->input("Item.alias", array('class' => 'form-control'));
    echo $this->Form->input("Item.controlador", array('class' => 'form-control'));
    echo $this->Form->input("Item.accion", array('class' => 'form-control'));
    echo $this->Form->input("Item.menu_id",array('class' => 'form-control') );
    echo $this->Form->end(array('label' => "Guardar", 'class' => 'btn btn-default'));
    ?>
</fieldset>