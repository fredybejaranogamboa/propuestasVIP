<script>
    $(document).ready(function () {
        $("#formulario").validate({
            rules: {
                'data[Departament][name]': {
                    required: true
                },
                'data[Departament][codigo]': {
                    required: true
                }
            }
        });
    });
</script>
<fieldset>
    <?php
    echo $this->Form->create("Departament", array('novalidate' => '', 'id' => 'formulario', 'role' => "form", "class" => "form", 'enctype' => 'multipart/form-data', 'type' => 'file', 'url' => array("action" => "edit", $this->data['Departament']['id'])));
    echo $this->Form->hidden("Departament.id");
    echo $this->Form->input("Departament.name", array('label'=>'Nombre','class' => 'form-control'));
    echo $this->Form->input("Departament.code", array('label'=>'Código','class' => 'form-control'));
    echo $this->Form->end(array('label' => "Guardar", 'class' => 'btn btn-default'));
    ?>
</fieldset>