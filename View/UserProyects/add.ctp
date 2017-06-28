<script>
    $(document).ready(function () {
        $("#formulario").validate({
            rules: {
                'data[UserProyect][codigo]': {
                    required: true
                },
                'data[UserProyect][convocatoria]': {
                    required: true
                }
            }
        });
    });
</script>
<fieldset>
    <?php
    echo $this->Form->create('UserProyect', array('novalidate' => '', 'id' => 'formulario', 'role' => "form", "class" => "form", 'enctype' => 'multipart/form-data', 'type' => 'file', 'url' => array("action" => "add", $user_id)));
    echo $this->Form->hidden("UserProyect.user_id", array('value' => $user_id));
    echo $this->Form->input("UserProyect.codigo", array('label' => 'Ingrese Código Proyecto', 'class' => 'form-control', 'required' => ''));

    foreach ($convocatorias as $convocatoria) {
        $options[$convocatoria['Call']['id']] = $convocatoria['Call']['nombre'];
    }

    echo $this->Form->input('UserProyect.convocatoria', array('label' => 'Convocatoria', 'options' => $options, 'empty' => '', 'class' => 'form-control'));

    echo $this->Form->end(array('label' => "Asignar", 'class' => 'btn btn-default'));
    ?>
</fieldset>