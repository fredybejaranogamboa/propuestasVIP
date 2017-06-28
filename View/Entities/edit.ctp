<script>
    $(document).ready(function () {
        $("#formulario").validate({
            rules: {
                'data[Entity][name]': {
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
                echo $this->Form->create('Entity', array('novalidate' => '', 'id' => 'formulario', 'role' => "form", "class" => "form", 'enctype' => 'multipart/form-data', 'type' => 'file', 'url' => array("action" => "edit", $this->data['Entity']['id'])));
                echo $this->Form->hidden("Entity.id", array('value' => $this->data['Entity']['id']));
                echo $this->Form->input("Entity.name", array('label' => 'Nombre', 'required' => '', 'class' => 'form-control'));
                echo $this->Form->end(array('label' => "Guardar", 'class' => 'btn btn-default'));
                ?>
            </div>
        </div>
    </div>
</div>