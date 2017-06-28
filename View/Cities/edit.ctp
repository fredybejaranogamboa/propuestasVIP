<script>
    $(document).ready(function () {
        $("#formulario").validate({
            rules: {
                'data[City][name]': {
                    required: true
                },
                'data[City][divipol]': {
                    required: true
                },
                'data[City][departament_id]': {
                    required: true
                }
            }
        });
    });
</script>
<fieldset>
    <?php
    echo $this->Form->create("City", array('novalidate' => '', 'id' => 'formulario', 'role' => "form", "class" => "form", 'enctype' => 'multipart/form-data', 'type' => 'file', 'url' => array("action" => "edit", $this->data['City']['id'])));
    echo $this->Form->hidden("City.id");
    echo $this->Form->input("City.name", array('label'=>'Nombre','class' => 'form-control'));
    echo $this->Form->input("City.divipol", array('class' => 'form-control'));
    echo $this->Form->input("City.departament_id", array('label'=>'Departamento','class' => 'form-control'));
    echo $this->Form->end(array('label' => "Guardar", 'class' => 'btn btn-default'));
    ?>
</fieldset>