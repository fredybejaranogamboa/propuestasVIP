<script>
    $(document).ready(function () {
        $("#formulario").validate({
            rules: {
                'data[Action][name]': {
                    required: true
                }
            }
        });
    });
</script>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Controladores
            </div>
            <div class="dataTable_wrapper">
                <?php
                echo $this->Form->create('Action', array('novalidate' => '', 'id' => 'formulario', 'role' => "form", "class" => "form", 'enctype' => 'multipart/form-data', 'type' => 'file', 'url' => array("action" => "add")));
                echo $this->Form->hidden("Action.id");
                echo $this->Form->input("Action.name", array('label' => 'Nombre', 'required' => '', 'class' => 'form-control'));
                echo $this->Form->input("Action.entity_id", array('label' => 'Controlador', 'required' => '', 'empty' => 'Seleccione un controlador...', 'class' => 'form-control'));
                echo $this->Form->end(array('label' => "Guardar", 'class' => 'btn btn-default'));
                ?>
            </div>
        </div>
    </div>
</div>
